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
        $products = DB::table('products')->select('products.*')->join('users', 'users.bid', '>=', 'products.bid_value')->where('products.status', '=', 'Accept')->where('products.deleted_at', '=', null)->orderBy('products.id', 'DESC');
        return $products;
    }

    public function newProduct()
    {
        $products = $this->selectProducts()->limit(4)->get();
        $newProduct = ProductResourceCollection::collection($products);
        return $newProduct;
    }

    public  function lastDeal()
    {

    }
}