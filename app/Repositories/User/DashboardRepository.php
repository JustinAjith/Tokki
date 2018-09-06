<?php

namespace App\Http\Controllers\User;

use App\Order;
use Illuminate\Support\Facades\Auth;

class DashboardRepository
{
    protected $order;

    public function __construct(Order $order=null)
    {
        $this->order = $order ?? new Order();
    }

    public function getOrders()
    {
        $orders = $this->order->product()->where('user_id', Auth::user()->id)->limit(5)->orderBy('id', 'DESC')->get();
        return true;
    }
}