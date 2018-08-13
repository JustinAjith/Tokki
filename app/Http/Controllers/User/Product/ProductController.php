<?php

namespace App\Http\Controllers\User\Product;

use App\Http\Requests\User\Product\Create\ProductRequest;
use App\Repositories\User\ProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ProductController extends Controller
{
    protected $product;
    public function __construct(ProductRepository $product)
    {
        $this->product = $product;
    }

    public function index(): View
    {
        return view('user.product.index');
    }

    public function create(): View
    {
        return view('user.product.create');
    }

    public function store(ProductRequest $request)
    {
        return $request->all();
    }
}
