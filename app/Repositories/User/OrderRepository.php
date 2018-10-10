<?php
namespace App\Repositories\User;

use App\Bid;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderRepository
{
    protected $order;
    public function __construct(Order $order=null)
    {
        $this->order = $order ?? new Order();
    }

    public function orderStatus(Request $request, $status, Order $order)
    {
        $comment = $request->comment ? $request->comment : null;
        $order->update(['status'=>$status, 'comment'=>$comment]);
        if($status == 'Reject') {
            $user = User::find(Auth::user()->id);
            $user->update(['bid'=>$user->bid + $order->bid_value]);

            $product = Product::find($order->product_id);
            $product->update(['qty'=>$product->qty + $order->qty]);
        }
        return ['success'=>true];
    }

    public function recentOrders()
    {
        return $this->order->with('product')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->take(5)->get();
    }

    public function recentBid()
    {
        return Bid::where('user_id',Auth::user()->id)->orderBy('id', 'DESC')->take(5)->get();
    }

    public function userOrder(Request $request, $product)
    {
        $user = Auth::user()->id;
        $columns = array(
            0 => 'name',
            1 => 'street',
            2 => 'city',
            3 => 'mobile',
            4 => 'telephone',
            5 => 'delivery_places',
            6 => 'status',
        );
        $totalDatas = $this->order::where(['product_id'=>$product, 'user_id'=>$user])->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))) {
            $posts = $this->order::where(['product_id'=>$product, 'user_id'=>$user])
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = $totalDatas;
        } else {
            $search = $request->input('search.value');

            $filteredData = $this->order::where(function($q) use ($user, $product) {
                $q->where(['product_id'=>$product, 'user_id'=>$user]);
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