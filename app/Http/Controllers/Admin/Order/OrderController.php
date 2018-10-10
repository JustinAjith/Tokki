<?php

namespace App\Http\Controllers\Admin\Order;

use App\Order;
use App\Repositories\Admin\OrderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    protected $order;

    public function __construct(OrderRepository $order)
    {
        $this->order = $order;
    }

    public function index()
    {
        $orders = Order::with('product')->orderBy('id', 'DESC')->paginate(20);
        return view('admin/order/index', compact('orders'));
    }
    public function show(Order $order)
    {
        return view('admin/order/show', compact('order'));
    }

    public function productOrder(Request $request, $product)
    {
        if(\request()->ajax()) {
            return $this->order->userOrder($request, $product);
        }
        return view('admin.order.order', compact('product'));
    }
}
