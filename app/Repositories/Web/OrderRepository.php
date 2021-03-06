<?php

namespace App\Repositories\Web;

use App\Http\Requests\Web\OrderRequest;
use App\Http\Resources\Product\ProductResourceCollection;
use App\Notification;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderRepository
{
    protected $order;
    protected $product;
    protected $notification;
    protected $user;
    public function __construct(Order $order = null, Product $product = null, Notification $notification = null, User $user = null)
    {
        $this->order = $order ?? new Order();
        $this->product = $product ?? new Product();
        $this->notification = $notification ?? new Notification();
        $this->user = $user ?? new User();
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
        $order->bid_value = $product->bid_value; // In future we have to change variable like this : $product->bid_value * $request->qty
        $order->date = date('Y-m-d');
        $order->save();
        $this->productQty($product, $request->qty);
        $this->userBid($product); // Here also we have to change bid value : $product->bid_value * $request->qty
        $this->orderNotification($product);
        return ['success'=>true];
    }

    // Update Product QTy
    public function productQty($product, $qty)
    {
        $qtyBalance = $product->qty - $qty;
        $product->update(['qty'=>$qtyBalance]);
        return ['success'=>true];
    }

    // User Bid Update
    public function userBid($product)
    {
        $user = $this->user->find($product->user_id);
        $bid = $user->bid - $product->bid_value;
        $user->update(['bid'=>$bid]);
        return ['success'=>true];
    }

    // Order Notification
    public function orderNotification($product)
    {
        $notification = $this->notification;
        $notification->message = 'New Order';
        $notification->title = 'Response.';
        $notification->user_id = $product->user_id;
        $notification->admin_user_id = $product->user_id;
        $notification->user_status = 1;
        $notification->admin_status = 1;
        $notification->save();
        return ['success'=>true];
    }

    public function orderHistory($product)
    {
        return $this->order::where(['status'=>'Complete', 'product_id'=>$product])->orwhere('status', 'Accept')->orderBy('date', 'DESC')->get();
    }

    public function relatedProduct($subCategory)
    {
        $products = DB::table('products')->select('products.*', 'users.bid')
            ->join('users', function($join){
                $join->on('users.id', '=', 'products.user_id');
                $join->on('users.bid', '>=', 'products.bid_value');
            })->where('products.sub_category_id', '=', $subCategory)->where('products.qty', '>', 0)->where('products.status', '=', 'Accept')->where('products.deleted_at', '=', null)->limit(6)->get();
        $newProduct = ProductResourceCollection::collection($products);
        return $newProduct;
    }
}