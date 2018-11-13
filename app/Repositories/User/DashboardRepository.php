<?php

namespace App\Repositories\User;

use App\Bid;
use App\Message;
use App\Order;
use App\Product;
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
        return $this->order->with('product')->where(['user_id'=>Auth::user()->id, 'delete_status'=>0])->whereHas('product', function($q){
                    $q->where('deleted_at', null);
                })->orderBy('id', 'DESC')->take(5)->get();
    }

    public function recentBid()
    {
        return Bid::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->take(5)->get();
    }

    public function recentMessage()
    {
        return Message::where(['user_id'=>Auth::user()->id, 'admin_id'=>null])->orderBy('id', 'DESC')->take(5)->get();
    }

    public function sales()
    {
        return $this->order->where(['user_id'=>Auth::user()->id, 'status'=>'Complete'])->count();
    }

    public function products()
    {
        return Product::where('user_id', Auth::user()->id)->count();
    }

    public function salesRevenue()
    {
        $orders = $this->order->select('price')->where(['user_id'=>Auth::user()->id, 'status'=>'Complete']);
        $price = $orders->sum('price');
        return number_format($price, 2);
    }
}