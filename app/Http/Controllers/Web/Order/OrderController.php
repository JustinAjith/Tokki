<?php

namespace App\Http\Controllers\Web\Order;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function show($category, Product $product)
    {
        return view('web.order.show', compact('product'));
    }
}
