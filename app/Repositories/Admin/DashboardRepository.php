<?php
namespace App\Repositories\Admin;

use App\Bid;
use App\Order;

class DashboardRepository
{
    protected $order;
    protected $bid;

    public function __construct(Order $order = null, Bid $bid = null)
    {
        $this->order = $order;
        $this->bid = $bid;
    }

    public function recentOrders()
    {
        return $this->order->with('product')->whereHas('product', function($q){
                    $q->where('deleted_at', null);
                })->orderBy('id', 'DESC')->take(5)->get();
    }

    public function recentBid()
    {
        return $this->bid->orderBy('id', 'DESC')->take(5)->get();
    }
}