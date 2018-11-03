<?php
namespace App\Repositories\User;

use App\Bid;
use App\Order;
use App\Payment;
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
        if($status == 'Complete') {
            if($order->discount_type == 'LKR') {
                $amount = ($order->price * $order->qty) - ($order->discount * $order->qty);
            } elseif($order->discount_type == '%') {
                $amount = ((1 - $order->discount/100) * $order->price) * $order->qty;
            }
            $payment = new Payment();
            $payment->user_id = Auth::user()->id;
            $payment->description = 'Sell order';
            $payment->income = $amount;
            $payment->date = date('Y-m-d');
            $payment->save();
        }
        return ['success'=>true];
    }

    public function recentOrders()
    {
        return $this->order->with('product')->where(['user_id'=>Auth::user()->id, 'delete_status'=>0])
                ->whereHas('product', function($q){
                    $q->where('deleted_at', null);
                })->orderBy('id', 'DESC')->take(5)->get();
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
            4 => 'date',
            5 => 'status',
            6 => 'action',
        );
        $totalDatas = $this->order::where(['product_id'=>$product, 'user_id'=>$user, 'delete_status'=>0])->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))) {
            $posts = $this->order::where(['product_id'=>$product, 'user_id'=>$user, 'delete_status'=>0])
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = $totalDatas;
        } else {
            $search = $request->input('search.value');

            $filteredData = $this->order::where(function($q) use ($user, $product) {
                $q->where(['product_id'=>$product, 'user_id'=>$user, 'delete_status'=>0]);
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
                $nestedData['street'] = $r->status == "Complete" ? $r->street : '<center> - </center>';;
                $nestedData['city'] = $r->city;
                $nestedData['mobile'] = $r->status == "Complete" ? $r->mobile : '<center> - </center>';
                $nestedData['date'] = $r->date;
                $nestedData['status'] = $r->status == "Complete" ? "<span class=\"badge badge-primary\">Complete</span>" : ($r->status == "Accept" ? "<span class=\"badge badge-success\">Accept</span>" : ($r->status == "Pending" ? "<span class=\"badge badge-secondary\">Pending</span>" : ($r->status == "Reject" ? "<span class=\"badge badge-danger\">Reject</span>" : "")));
                $nestedData['action'] = '
                    <a href="/orders/show/' . $r->id . '" class="btn btn-sm btn-outline-success"><i class="fa fa-eye"></i> View</a>
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

    public function customerReview(Order $order)
    {
        $customer = $this->order->where(['mobile'=>$order->mobile, 'telephone'=>$order->telephone, 'status'=>'Complete'])->count();
        return response()->json($customer);
    }
}