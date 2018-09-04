<?php

namespace App\Http\Controllers\Web\Order;

use App\Product;
use App\Repositories\Web\OrderRepository;
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

    public function show($category, Product $product): View
    {
        return view('web.order.show', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $this->order->store($request, $product);
        return ['success'=>true];
    }
}
