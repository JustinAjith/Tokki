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

    public function lastDeal()
    {
        $lastDeal = $this->home->lastDeal();
        return response()->json($lastDeal);
    }
}
