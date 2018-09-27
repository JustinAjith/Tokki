<?php

namespace App\Http\Controllers\Admin\Order;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('product')->orderBy('id', 'DESC')->paginate(20);
        return view('admin/order/index', compact('orders'));
    }
    public function show(Order $order)
    {
        return view('admin/order/show', compact('order'));
    }
}
