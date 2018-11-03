<?php

namespace App\Repositories\Web;

use App\Http\Resources\Product\ProductResourceCollection;
use App\Product;
use App\User;
use Illuminate\Support\Facades\DB;

class HomeRepository
{
    protected $product;
    protected $user;
    public function __construct(Product $product, User $user)
    {
        $this->product = $product;
        $this->user = $user;
    }

    public function selectProducts()
    {
        $products = DB::table('products')->select('products.*', 'users.bid')
            ->join('users', function($join){
                $join->on('users.id', '=', 'products.user_id');
                $join->on('users.bid', '>=', 'products.bid_value');
            })->where('products.qty', '>', 0)->where('products.status', '=', 'Accept')->where('products.deleted_at', '=', null);
        return $products;
    }

    public function newProduct()
    {
        $products = $this->selectProducts()->orderBy('products.id', 'DESC')->limit(6)->get();
        $newProduct = ProductResourceCollection::collection($products);
        return $newProduct;
    }

    public  function recentOffer()
    {
        $products = $this->selectProducts()->where('discount', '>', 0)->orderBy('products.updated_at', 'DESC')->limit(6)->get();
        $newProduct = ProductResourceCollection::collection($products);
        return $newProduct;
    }

    public  function loveProduct()
    {
        $products = $this->selectProducts()->where('products.category_id', 1)->orderBy('products.id', 'DESC')->limit(6)->get();
        $loveProduct = ProductResourceCollection::collection($products);
        return $loveProduct;
    }
}