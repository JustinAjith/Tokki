<?php

namespace App\Http\Controllers\User\Order;

use App\Repositories\User\OrderRepository;
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
        return view('user.order.index');
    }

    public function status()
    {
        return view('user.order.status');
    }
}
