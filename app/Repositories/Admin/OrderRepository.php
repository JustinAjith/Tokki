<?php
namespace App\Repositories\Admin;

use App\Order;
use Illuminate\Http\Request;

class OrderRepository
{
    protected $order;
    public function __construct(Order $order = null)
    {
        $this->order = $order ?? new Order();
    }

    public function index()
    {
        return $this->getOrder()->where('delete_status', 0)->orderBy('id', 'DESC')->paginate(20);
    }

    public function show($order)
    {
        return $this->getOrder()->where('id', $order)->first();
    }

    public function deleteShow()
    {
        return $this->getOrder()->where('delete_status', 1)->orderBy('id', 'DESC')->paginate(20);
    }

    public function getOrder()
    {
        return $this->order::with('product')->whereHas('product', function($q){
            $q->where('deleted_at', null);
        });
    }

    public function userOrder(Request $request, $product)
    {
        $columns = array(
            0 => 'name',
            1 => 'street',
            2 => 'city',
            3 => 'mobile',
            4 => 'date',
            5 => 'status',
            6 => 'action',
        );
        $totalDatas = $this->order::where('product_id', $product)->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))) {
            $posts = $this->order::where('product_id', $product)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = $totalDatas;
        } else {
            $search = $request->input('search.value');

            $filteredData = $this->order::where(function($q) use ($product) {
                $q->where('product_id', $product);
            })->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('street', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%")
                    ->orWhere('mobile', 'like', "%{$search}%")
                    ->orWhere('date', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%");
            });

            $posts = $filteredData->offset($start)->limit($limit)->orderBy($order, $dir)->get();
            $totalFiltered = $filteredData->count();
        }

        $data = array();

        if($posts){
            foreach($posts as $r) {
                $nestedData['name'] = $r->name;
                $nestedData['street'] = $r->street;
                $nestedData['city'] = $r->city;
                $nestedData['mobile'] = $r->mobile;
                $nestedData['date'] = $r->date;
                $nestedData['status'] = $r->status == "Complete" ? "<span class=\"badge badge-primary\">Complete</span>" : ($r->status == "Accept" ? "<span class=\"badge badge-success\">Accept</span>" : ($r->status == "Pending" ? "<span class=\"badge badge-secondary\">Pending</span>" : ($r->status == "Reject" ? "<span class=\"badge badge-danger\">Reject</span>" : "")));
                $nestedData['action'] = '
                    <a href="/admin/order/show/' . $r->id . '" class="btn btn-sm btn-outline-success"><i class="fa fa-eye"></i> View</a>
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

    public function delete($order)
    {
        $order = $this->order->find($order);
        $order->forceDelete();
        return ['success'=>true];
    }
}