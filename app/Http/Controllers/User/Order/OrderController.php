<?php

namespace App\Http\Controllers\User\Order;

use App\Order;
use App\Product;
use App\Repositories\User\OrderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    protected $order;
    public function __construct(OrderRepository $order)
    {
        $this->order = $order;
    }

    public function index()
    {
        $orders = Order::with('product')->where(['user_id'=>Auth::user()->id, 'delete_status'=>0])
                ->whereHas('product', function($q){
                    $q->where('deleted_at', null);
                })->orderBy('id', 'DESC')->paginate(20);
        return view('user.order.index', compact('orders'));
    }

    public function show($order)
    {
        $order = Order::with('product')->where(['id'=>$order, 'delete_status'=>0])
                ->whereHas('product', function($q){
                    $q->where('deleted_at', null);
                })->first();
        if($order && $order->user_id == Auth::user()->id) {
            return view('user.order.show', compact('order'));
        } else {
            return redirect()->back()->with('autherror', 'autherror');
        }
    }

    public function status(): View
    {
        $recentOrders = $this->order->recentOrders();
        $recentBids = $this->order->recentBid();
        return view('user.order.status', compact('recentOrders', 'recentBids'));
    }

    public function orderStatus(Request $request, $status, Order $order)
    {
        return $this->order->orderStatus($request, $status, $order);
    }

    public function delete(Order $order)
    {
        $order->update(['delete_status'=>1]);
        return ['success'=>true];
    }

    public function productOrder(Request $request, $product)
    {
        if(\request()->ajax()) {
            return $this->order->userOrder($request, $product);
        }
        return view('user.order.order', compact('product'));
    }

    public function customerReview(Order $order)
    {
        return $this->order->customerReview($order);
    }
}
