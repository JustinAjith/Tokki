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

    public function show($category, Product $product): View
    {
        $product = DB::table('products')->select('products.*', 'users.bid')
            ->join('users', function($join){
                $join->on('users.id', '=', 'products.user_id');
                $join->on('users.bid', '>=', 'products.bid_value');
            })->where('products.id', $product->id)->where('products.status', '=', 'Accept')->where('products.deleted_at', '=', null)->first();
        if($product) {
            return view('web.order.show', compact('product'));
        } else {
            return view('web.order.error');
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
}
