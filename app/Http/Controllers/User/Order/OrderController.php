<?php

namespace App\Http\Controllers\User\Order;

use App\Repositories\User\OrderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class OrderController extends Controller
{
    protected $order;
    public function __construct(OrderRepository $order)
    {
        $this->order = $order;
    }

    public function index(): View
    {
        return view('user.order.index');
    }

    public function status(): View
    {
        return view('user.order.status');
    }
}
