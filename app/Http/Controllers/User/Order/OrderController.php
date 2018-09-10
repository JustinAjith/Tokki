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

    public function index(Request $request)
    {
        if(\request()->ajax()) {
            return $this->order->orderDataTable($request);
        }
        return view('user.order.index');
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
}
