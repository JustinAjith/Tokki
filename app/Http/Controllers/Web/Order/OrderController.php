<?php

namespace App\Http\Controllers\Web\Order;

use App\Http\Requests\Web\OrderRequest;
use App\Product;
use App\Repositories\Web\OrderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OrderController extends Controller
{
    protected $order;

    public function __construct(OrderRepository $order)
    {
        $this->order = $order;
    }

    public function show($category, $product)
    {
        $product = DB::table('products')->select('products.*', 'users.bid', 'users.name')
            ->join('users', function($join){
                $join->on('users.id', '=', 'products.user_id');
                $join->on('users.bid', '>=', 'products.bid_value');
            })->where('products.id', $product)->where('products.qty', '>', 0)->where('products.status', '=', 'Accept')->where('products.deleted_at', '=', null)->first();
        if(isset($product)) {
            return view('web.order.show', compact('product'));
        } else {
            $products = DB::table('products')->select('products.*', 'users.bid')
                ->join('users', function($join){
                    $join->on('users.id', '=', 'products.user_id');
                    $join->on('users.bid', '>=', 'products.bid_value');
                })->where('products.qty', '>', 0)->where('products.status', '=', 'Accept')->where('products.deleted_at', '=', null)->inRandomOrder()->take(6)->get();
            return view('web.order.error', compact('products'));
        }
    }

    public function store(OrderRequest $request, Product $product)
    {
        $this->order->store($request, $product);
        return ['success'=>true];
    }

    public function success()
    {
        return view('web.order.success');
    }

    public function orderHistory($product)
    {
        $orders = $this->order->orderHistory($product);
        return response()->json(['orders'=>$orders]);
    }

    public function relatedProduct($subCategory)
    {
        $relatedProduct = $this->order->relatedProduct($subCategory);
        return response()->json($relatedProduct);
    }
}
