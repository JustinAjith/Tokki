<?php

namespace App\Http\Controllers\User\Product;

use App\Http\Requests\User\Product\DetailCheckRequest;
use App\Http\Requests\User\Product\GeneralCheckRequest;
use App\Repositories\User\ProductRepository;
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

    public function index()
    {
        return view('user.product.index');
    }

    public function create(): View
    {
        return view('user.product.create');
    }

    public function generalProductCheck(GeneralCheckRequest $request)
    {
        return ['success'=>true];
    }

    public function productDetailCheck(DetailCheckRequest $request)
    {
        return ['success'=>true];
    }

    public function store(Request $request)
    {
        return $request->all();
    }
}
