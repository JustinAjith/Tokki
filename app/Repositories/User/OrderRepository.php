<?php
namespace App\Repositories\User;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderRepository
{
    protected $order;
    public function __construct(Order $order=null)
    {
        $this->order = $order ?? new Order();
    }

    public function orderDataTable(Request $request)
    {
        $columns = array(
            0 => 'price',
            1 => 'name',
            2 => 'name',
            3 => 'date',
            4 => 'status',
            5 => 'action',
        );
        $userId = Auth::user()->id;
        $totalDatas = $this->order::where('user_id',$userId)->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))) {
            $posts = $this->order::with('product')->where('user_id',$userId)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $totalDatas;
        } else {
            $search = $request->input('search.value');

            $filteredData = $this->order::with('product')->where(function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })->where(function ($query) use ($search) {
                $query->where('heading', 'like', "%{$search}%")
                    ->orWhere('qty', 'like', "%{$search}%")
                    ->orWhere('date', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%");
            });

            $posts = $filteredData->offset($start)->limit($limit)->orderBy($order, $dir)->get();
            $totalFiltered = $filteredData->count();
        }

        $data = array();

        if($posts){
            foreach($posts as $r) {
                $nestedData['price'] = $r->product->display_image;
                $nestedData['name'] = $r->product->heading;
                $nestedData['qty'] = $r->qty;
                $nestedData['date'] = $r->created_at;
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
}