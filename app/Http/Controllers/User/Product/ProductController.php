<?php

namespace App\Http\Controllers\User\Product;

use App\Category;
use App\Http\Requests\User\Product\Create\ProductRequest;
use App\Http\Requests\User\Product\Edit\GeneralDetailRequest;
use App\Http\Requests\User\Product\Edit\PriceRequest;
use App\Http\Requests\User\Product\Edit\ProductDetailRequest;
use App\Http\Requests\User\Product\Edit\ProductImageRequest;
use App\Http\Requests\User\Product\Edit\SpecialFeaturesRequest;
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
        $categories = Category::with('subCategory')->get();
        return view('user.product.create', compact('categories'));
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

    // Remove Product
    public function delete(Product $product)
    {
        if(Auth::user()->id == $product->user_id) {
            $this->product->delete($product);
            return ['success'=>true];
        }
    }

    public function edit($type, Product $product)
    {
        if(Auth::user()->id == $product->user_id) {
            return view('user.product.edit', compact('type', 'product'));
        } else {
            return redirect()->back()->with('autherror', 'autherror');
        }
    }

    // Update Product General Details
    public function generalDetails(GeneralDetailRequest $request, Product $product)
    {
        $this->product->generalDetails($request, $product);
        return redirect()->route('user.product.show', $product)->with('success', 'success');
    }

    // Update Product Details
    public function productDetails(ProductDetailRequest $request, Product $product)
    {
        $this->product->productDetails($request, $product);
        return redirect()->route('user.product.show', $product)->with('success', 'success');
    }

    // Remove Product Images
    public function productImageDelete($image, Product $product)
    {
        $this->product->productImageDelete($image, $product);
        return ['success'=>true];
    }

    // Update Product Images
    public function productImage(ProductImageRequest $request, Product $product)
    {
        $this->product->productImage($request, $product);
        return redirect()->route('user.product.show', $product)->with('success', 'success');
    }

    // Update Product Special Features
    public function productSpecialFeatures(SpecialFeaturesRequest $request, Product $product)
    {
        $this->product->productSpecialFeatures($request, $product);
        return redirect()->route('user.product.show', $product)->with('success', 'success');
    }

    // Update Product Price and Discount
    public function productPrice(PriceRequest $request, Product $product)
    {
        $this->product->productPrice($request, $product);
        return redirect()->back()->with('success', 'success');
    }
}
