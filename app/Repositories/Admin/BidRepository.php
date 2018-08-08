<?php

namespace App\Repositories\Admin;

use App\Bid;
use App\Notification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidRepository
{
    protected $bid;
    protected $user;
    protected $notification;

    public function __construct(Bid $bid = null, User $user = null, Notification $notification = null)
    {
        $this->bid = $bid ?? new Bid();
        $this->user = $user ?? new User();
        $this->notification = $notification ?? new Notification();
    }

    public function bidDataTable(Request $request)
    {
        $columns = array(
            0 => 'user_id',
            1 => 'receipt_id',
            2 => 'bid',
            3 => 'date',
            4 => 'status',
            5 => 'created',
            6 => 'action',
        );
        $totalDatas = $this->bid->all()->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $posts = $this->bid::with('user')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $totalDatas;
        } else {
            $search = $request->input('search.value');

            $filteredData = $this->bid::with('user')->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhere('receipt_id', 'like', "%{$search}%")
                ->orWhere('bid', 'like', "%{$search}%")
                ->orWhere('date', 'like', "%{$search}%")
                ->orWhere('created', 'like', "%{$search}%")
                ->orWhere('status', 'like', "%{$search}%");

            $posts = $filteredData->offset($start)->limit($limit)->orderBy($order, $dir)->get();
            $totalFiltered = $filteredData->count();
        }

        $data = array();

        if ($posts) {
            foreach ($posts as $r) {
                $nestedData['user_id'] = $r->user->name;
                $nestedData['receipt_id'] = $r->receipt_id;
                $nestedData['bid'] = $r->bid;
                $nestedData['date'] = $r->date;
                $nestedData['status'] = $r->status == "Accept" ? "<span class=\"badge badge-success\">Accept</span>" : ($r->status == "Pending" ? "<span class=\"badge badge-secondary\">Pending</span>" : ($r->status == "Reject" ? "<span class=\"badge badge-danger\">Reject</span>" : ""));
                $nestedData['created'] = $r->created_at->toDateString();
                $nestedData['action'] = '
                    <a href="/admin/bid/show/' . $r->id . '" class="btn btn-sm btn-outline-success"><i class="fa fa-eye"></i> View</a>
                    <button type="button" class="btn btn-sm btn-danger delete-bid" value="' . $r->id . '"><i class="fa fa-trash"></i> Remove</button>
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

    public function bidAccept(Bid $bid)
    {
        if($bid->status != 'Accept'){
            // Update Bid Status
            $bid->update(['status'=>'Accept']);
            // Update User Bid Value
            $user = $this->user->find($bid->user_id);
            $finalBid = ($user->total_bid - $user->bid) + $bid->bid;
            $user->update(['bid'=>0, 'total_bid'=>$finalBid]);
            // Add New Notification
            $notification = $this->notification;
            $notification->message = 'Your bid request accept by Tokki.';
            $notification->title = 'Response.';
            $notification->user_id = $bid->user_id;
            $notification->admin_id = Auth::user()->id;
            $notification->admin_status = 0;
            $notification->save();
            return ['success'=>'success'];
        } else {
            return ['error'=>'error'];
        }
    }

    public function bidReject(Bid $bid)
    {
        if($bid->status != 'Reject'){
            // Update Bid Status
            $bid->update(['status'=>'Reject']);
            // Add New Notification
            $notification = $this->notification;
            $notification->message = 'Your bid request reject by Tokki.';
            $notification->title = 'Response.';
            $notification->user_id = $bid->id;
            $notification->admin_id = Auth::user()->id;
            $notification->admin_status = 0;
            $notification->save();
            return ['success'=>'success'];
        } else {
            return ['error'=>'error'];
        }
    }
}