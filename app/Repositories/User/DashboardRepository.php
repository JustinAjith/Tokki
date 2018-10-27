<?php

namespace App\Repositories\User;

use App\Bid;
use App\Message;
use App\Order;
use Illuminate\Support\Facades\Auth;

class DashboardRepository
{
    protected $order;

    public function __construct(Order $order=null)
    {
        $this->order = $order ?? new Order();
    }

    public function recentOrders()
    {
        return $this->order->with('product')->where(['user_id'=>Auth::user()->id, 'delete_status'=>0])->orderBy('id', 'DESC')->take(5)->get();
    }

    public function recentBid()
    {
        return Bid::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->take(5)->get();
    }

    public function recentMessage()
    {
        return Message::where(['user_id'=>Auth::user()->id, 'admin_id'=>null])->orderBy('id', 'DESC')->take(5)->get();
    }
}