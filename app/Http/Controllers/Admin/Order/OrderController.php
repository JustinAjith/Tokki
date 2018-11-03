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
        $orders = $this->order->index();
        return view('admin.order.index', compact('orders'));
    }
    public function show($order)
    {
        $order = $this->order->show($order);
        if($order) {
            return view('admin.order.show', compact('order'));
        } else {
            return redirect()->back()->with('autherror', 'autherror');
        }
    }

    public function productOrder(Request $request, $product)
    {
        if(\request()->ajax()) {
            return $this->order->userOrder($request, $product);
        }
        return view('admin.order.order', compact('product'));
    }

    public function deleteShow()
    {
        $orders = $this->order->deleteShow();
        return view('admin.order.index', compact('orders'));
    }

    public function delete($order)
    {
        $this->order->delete($order);
        return ['success'=>true];
    }
}
