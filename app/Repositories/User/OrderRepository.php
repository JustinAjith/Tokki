<?php
namespace App\Repositories\User;

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
}