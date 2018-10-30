<?php
namespace App\Repositories\Admin;

use App\Http\Requests\Admin\User\UserStoreRequest;
use App\Mail\NewAccount;
use App\Mail\PasswordReset;
use App\Notification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserRepository
{
    protected $user;
    public function __construct(User $user = null)
    {
        $this->user = $user ?? new User();
    }

    public function userDataTable(Request $request)
    {
        $columns = array(
            0 => 'code',
            1 => 'name',
            2 => 'email',
            3 => 'mobile',
            4 => 'land_line',
            5 => 'action',
        );
        $totalDatas = $this->user->all()->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))) {
            $posts = $this->user
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $totalDatas;
        } else {
            $search = $request->input('search.value');

            $filteredData = $this->user::where('name', 'like', "%{$search}%")
                ->orWhere('code', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('mobile', 'like', "%{$search}%")
                ->orWhere('land_line', 'like', "%{$search}%");

            $posts = $filteredData->offset($start)->limit($limit)->orderBy($order, $dir)->get();
            $totalFiltered = $filteredData->count();
        }

        $data = array();

        if($posts){
            foreach($posts as $r) {
                $nestedData['code'] = $r->code;
                $nestedData['name'] = $r->name;
                $nestedData['email'] = $r->email;
                $nestedData['mobile'] = $r->mobile;
                $nestedData['land_line'] = $r->land_line;
                $nestedData['action'] = '
                    <a href="/admin/users/show/'.$r->id.'" class="btn btn-sm btn-outline-success"><i class="fa fa-eye"></i> View</a>
                    <button type="button" class="btn btn-sm btn-danger delete-user" value="'.$r->id.'"><i class="fa fa-trash"></i> Remove</button>
                ';
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalDatas),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        echo json_encode($json_data);
    }

    public function store(UserStoreRequest $request)
    {
        $lastUser = $this->user->orderBy('id', 'DESC')->first();
        if(!$lastUser) {
            $last_code = 0;
        } else {
            $last_code = preg_replace('/[^0-9.]/', '', $lastUser->code);
        }
        $code = sprintf('%04d', intval($last_code)+1);

        $request->merge(['password'=>Hash::make($request->password)]);
        $user = $this->user->fill($request->toArray());
        $user->setAttribute('code', 'TK'.$code);
        $user->setAttribute('bid', $request->bid);
        $user->setAttribute('total_bid', $request->bid);
        $user->save();
        Mail::send(new NewAccount($request));
        return ['success'=>true];
    }

    public function resetPassword(Request $request)
    {
        $user = $this->user->find($request->user_id);
        $user->update(['password'=>Hash::make($request->password)]);
        Mail::send(new PasswordReset($request, $user));
        return ['success'=>true];
    }

    public function offerBid(Request $request)
    {
        $user = $this->user->find($request->user_id);
        $finalBid = $user->bid + $request->bid;
        $user->update(['bid'=>$finalBid, 'total_bid'=>$finalBid]);

        $notification = new Notification();
        $notification->message = 'Congratulations! You have received a Loyalty bonus of '.$request->bid.' Bid.';
        $notification->title = 'Offer Bid.';
        $notification->user_id = $request->user_id;
        $notification->admin_id = Auth::user()->id;
        $notification->admin_status = 0;
        $notification->save();

        return ['success'=>true];
    }
}