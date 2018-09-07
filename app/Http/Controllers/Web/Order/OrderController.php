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

    public function show($category, Product $product)
    {
        $product = DB::table('products')->select('products.*')->where('products.id', $product->id)
                    ->join('users', 'users.bid', '>=', 'products.bid_value')
                    ->where('products.status', '=', 'Accept')->first();
        if($product) {
            return view('web.order.show', compact('product'));
        } else {
            return redirect()->back();
        }
    }

    public function store(OrderRequest $request, Product $product)
    {
        $this->order->store($request, $product);
        return ['success'=>true];
    }
}
