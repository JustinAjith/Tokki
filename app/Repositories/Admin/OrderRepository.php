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

    public function userOrder(Request $request, $product)
    {
        $columns = array(
            0 => 'name',
            1 => 'street',
            2 => 'city',
            3 => 'mobile',
            4 => 'telephone',
            5 => 'delivery_places',
            6 => 'status',
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
                    ->orWhere('telephone', 'like', "%{$search}%")
                    ->orWhere('delivery_places', 'like', "%{$search}%")
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
                $nestedData['telephone'] = $r->telephone;
                $nestedData['delivery_places'] = $r->delivery_places;
                $nestedData['status'] = $r->status == "Complete" ? "<span class=\"badge badge-primary\">Complete</span>" : ($r->status == "Accept" ? "<span class=\"badge badge-success\">Accept</span>" : ($r->status == "Pending" ? "<span class=\"badge badge-secondary\">Pending</span>" : ($r->status == "Reject" ? "<span class=\"badge badge-danger\">Reject</span>" : "")));
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