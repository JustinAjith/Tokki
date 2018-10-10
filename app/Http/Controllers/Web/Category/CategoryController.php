<?php

namespace App\Http\Controllers\Web\Category;

use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index($ref_id)
    {
        $sub_category = SubCategory::where('ref_id', $ref_id)->first();
        $products = $this->productGet($sub_category)->orderBy('products.id', 'DESC')->paginate(40);
        $categories = Category::find($sub_category->category_id)->subCategory;
        return view('web.category.index', compact('products', 'categories', 'sub_category'));
    }

    public function filter($ref_id, $sort, $filter)
    {
        $sub_category = SubCategory::where('ref_id', $ref_id)->first();
        $categories = Category::find($sub_category->category_id)->subCategory;
        if($sort == 'order-by') {
            $products = $this->productGet($sub_category)->orderBy('products.id', $filter)->paginate(40);
        } elseif($sort == 'discount') {
            $products = $this->productGet($sub_category)->where('products.discount_type', $filter)->where('products.discount', '>', 0)->orderBy('products.id', 'DESC')->paginate(40);
        }
        elseif($sort == 'place') {
            $count = $this->productGet($sub_category)->count();
            if($count == 0) {
                $products = array();
            } else {
                $products = $this->productGet($sub_category)->where('products.delivery_places', 'LIKE', '%'.$filter.'%')->orWhere('products.delivery_places', 'LIKE', '%'.'All Srilanka'.'%')->orderBy('products.id', 'DESC')->paginate(40);
            }
        }
        return view('web.category.index', compact('products', 'categories', 'sub_category'));
    }

    public function productGet($sub_category)
    {
        return DB::table('products')->select('products.*')->join('users', 'users.bid', '>=', 'products.bid_value')->where('sub_category_id', $sub_category->id)->where('products.status', '=', 'Accept')->where('products.deleted_at', '=', null);
    }

    public function bestSell()
    {
        $products = DB::table('orders')->select('products.*')
                    ->join('products', 'products.id', '=', 'orders.product_id')
                    ->join('users', 'users.bid', '>=', 'products.bid_value')
                    ->where('orders.status', '=', 'Complete')
                    ->where('orders.deleted_at', '=', null)
                    ->orderBy('orders.id', 'DESC')->paginate(40);
        $heading = 'Best Sell';
        return view('web.category.product', compact('products', 'heading'));
    }

    public function popularCategories()
    {
        $products = DB::table('products')->select('products.*')->join('users', 'users.bid', '>=', 'products.bid_value')->where('products.status', '=', 'Accept')->where('products.deleted_at', '=', null)->orWhere('category_id', [1, 2])->orderBy('products.id', 'DESC')->paginate(40);
        $heading = 'Popular Categories';
        return view('web.category.product', compact('products', 'heading'));
    }

    public function specialOffers()
    {
        $products = DB::table('products')->select('products.*')->join('users', 'users.bid', '>=', 'products.bid_value')->where('products.status', '=', 'Accept')->where('products.deleted_at', '=', null)->where('products.discount', '>', 0)->orderBy('products.id', 'DESC')->paginate(40);
        $heading = 'Special Offers';
        return view('web.category.product', compact('products', 'heading'));
    }
}
