<?php

namespace App\Http\Controllers\User\Order;

use App\Order;
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
        $orders = Order::with('product')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(20);
        return view('user.order.index', compact('orders'));
    }

    public function show($order)
    {
        $order = Order::with('product')->where('id', $order)->first();
        if($order->user_id == Auth::user()->id) {
            return view('user.order.show', compact('order'));
        } else {
            return redirect()->back()->with('autherror', 'autherror');
        }
    }

    public function status(): View
    {
        return view('user.order.status');
    }

    public function orderStatus(Request $request, $status, Order $order)
    {
        return $this->order->orderStatus($request, $status, $order);
    }

    public function delete(Order $order)
    {
        $order->delete();
        return ['success'=>true];
    }
}
