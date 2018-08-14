<?php

namespace App\Http\Controllers\User\Product;

use App\Http\Requests\User\Product\Create\ProductRequest;
use App\Product;
use App\Repositories\User\ProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        $products = $this->product->getProducts();
        return view('user.product.index', compact('products'));
    }

    public function create(): View
    {
        return view('user.product.create');
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        $this->product->store($request);
        return redirect()->back()->with('success', 'success');
    }

    public function show(Product $product)
    {
        if(Auth::user()->id == $product->user_id) {
            return view('user.product.show', compact('product'));
        } else {
            return redirect()->back()->with('autherror', 'autherror');
        }
    }
}
