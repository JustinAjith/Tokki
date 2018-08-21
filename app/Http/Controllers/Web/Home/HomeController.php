<?php

namespace App\Http\Controllers\Web\Home;

use App\Repositories\Web\HomeRepository;
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
//        return session()->get('_token');
        return view('web.home.index');
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
