<?php

namespace App\Repositories\Web;

use App\Http\Requests\Web\OrderRequest;
use App\Order;
use App\Product;
use Illuminate\Http\Request;

class OrderRepository
{
    protected $order;

    public function __construct(Order $order = null)
    {
        $this->order = $order ?? new Order();
    }

    public function store(OrderRequest $request, Product $product)
    {
        $order = $this->order;
        $order->user_id = $product->user_id;
        $order->product_id = $product->id;
        $order->name = $request->name;
        $order->street = $request->street;
        $order->city = $request->city;
        $order->mobile = $request->mobile;
        $order->telephone = $request->telephone;
        $order->discount_type = $product->discount_type;
        $order->discount = $product->discount;
        $order->price = $product->price;
        $order->qty = $request->qty;
        $order->delivery_places = $request->delivery_places;
        $order->features = json_encode($request->features);
        $order->features_description = json_encode($request->features_description);
        $order->bid_value = $product->bid_value;
        $order->save();
        $this->adminNotification();
        $this->userNotification();
        return ['success'=>true];
    }

    // Order Notification to Admin
    public function adminNotification()
    {
        return true;
    }

    // Order Notification to User
    public function userNotification()
    {
        return true;
    }
}