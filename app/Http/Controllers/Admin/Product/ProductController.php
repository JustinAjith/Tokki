<?php

namespace App\Http\Controllers\Admin\Product;

use App\Product;
use App\Repositories\Admin\ProductRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    protected $product;
    public function __construct(ProductRepository $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(20);
        return view('admin.product.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    public function status($status, Product $product)
    {
        $this->product->status($product, $status);
        return ['success'=>true];
    }
}