<?php
namespace App\Repositories\User;

use App\Bid;
use App\BidRang;
use App\Http\Requests\User\Bid\BidRequest;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidRepository
{
    protected $bid;
    protected $notification;
    protected $bidRang;
    public function __construct(Bid $bid = null, Notification $notification = null, BidRang $bidRang = null)
    {
        $this->bid = $bid ?? new Bid();
        $this->notification = $notification ?? new Notification();
        $this->bidRang = $bidRang ?? new BidRang();
    }

    public function bidDataTable(Request $request)
    {
        $columns = array(
            0 => 'receipt_id',
            1 => 'bid',
            2 => 'date',
            3 => 'status',
            4 => 'action',
        );
        $userId = Auth::user()->id;
        $totalDatas = $this->bid->where('user_id',$userId)->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))) {
            $posts = $this->bid->where('user_id',$userId)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = $totalDatas;
        } else {
            $search = $request->input('search.value');

            $filteredData = $this->bid::where(function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })->where(function ($query) use ($search) {
                $query->where('receipt_id', 'like', "%{$search}%")
                    ->orWhere('bid', 'like', "%{$search}%")
                    ->orWhere('date', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%");
            });

            $posts = $filteredData->offset($start)->limit($limit)->orderBy($order, $dir)->get();
            $totalFiltered = $filteredData->count();
        }

        $data = array();

        if($posts){
            foreach($posts as $r) {
                $nestedData['receipt_id'] = $r->receipt_id;
                $nestedData['bid'] = $r->bid;
                $nestedData['date'] = $r->date;
                $nestedData['status'] = $r->status == "Accept" ? "<span class=\"badge badge-success\">Accept</span>" : ($r->status == "Pending" ? "<span class=\"badge badge-secondary\">Pending</span>" : ($r->status == "Reject" ? "<span class=\"badge badge-danger\">Reject</span>" : ""));
                $nestedData['action'] = '
                    <a href="/bid/show/'.$r->id.'" class="btn btn-sm btn-outline-success"><i class="fa fa-eye"></i> View</a>
                    <button type="button" class="btn btn-sm btn-danger delete-bid" value="'.$r->id.'"><i class="fa fa-trash"></i> Remove</button>
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

    public function store(BidRequest $request)
    {
        $userId = Auth::user()->id;
        $receipt = $request->file('receipt_file');
        $ext = $receipt->getClientOriginalExtension();
        $name = rand(00000000, 99999999).'_'.$userId.'.'.$ext;
        $request->merge(['user_id'=>$userId, 'receipt'=>$name]);
        $data = $this->bid->fill($request->toArray());
        $data->save();
        $receipt->move('images/bid_receipt', $name);

        // Add New Notification
        $notification = $this->notification;
        $notification->message = Auth::user()->name.' send request for Bid.';
        $notification->title = 'Bid Request';
        $notification->admin_user_id = $userId;
        $notification->user_status = 0;
        $notification->save();

        return ['success'=>true];
    }

    public function bidRang(Request $request)
    {
        $columns = array(
            0 => 'from',
            1 => 'to',
            2 => 'bid',
        );
        $totalDatas = $this->bidRang->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))) {
            $posts = $this->bidRang->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = $totalDatas;
        } else {
            $search = $request->input('search.value');

            $filteredData = $this->bidRang::where('from', 'like', "%{$search}%")
                ->orWhere('to', 'like', "%{$search}%")
                ->orWhere('bid', 'like', "%{$search}%");

            $posts = $filteredData->offset($start)->limit($limit)->orderBy($order, $dir)->get();
            $totalFiltered = $filteredData->count();
        }

        $data = array();

        if($posts){
            foreach($posts as $r) {
                $nestedData['rang'] = $r->from.' - '.$r->to;
                $nestedData['bid'] = $r->bid;
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
}