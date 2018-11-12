<?php

namespace App\Http\Controllers\Web\Home;

use App\Category;
use App\Repositories\Web\HomeRepository;
use App\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    protected $home;
    public function __construct(HomeRepository $home)
    {
        $this->home = $home;
    }

    public function index()
    {
        $sliders = Slider::where('status', 'yes')->get();
        $categories = Category::with('subCategory')->get();
        return view('web.home.index', compact('sliders', 'categories'));
    }

    public function newProduct()
    {
        $newProduct = $this->home->newProduct();
        return response()->json($newProduct);
    }

    public function recentOffer()
    {
        $lastDeal = $this->home->recentOffer();
        return response()->json($lastDeal);
    }

    public function loveProduct()
    {
        $loveProduct = $this->home->loveProduct();
        return response()->json($loveProduct);
    }

    public function moreProduct()
    {
        $moreProduct = $this->home->moreProduct();
        return response()->json($moreProduct);
    }
}
