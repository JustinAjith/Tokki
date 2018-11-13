<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Repositories\User\DashboardRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    protected $user;

    public function __construct(DashboardRepository $user)
    {
        $this->user = $user;
    }

    public function index(): View
    {
        $recentOrders = $this->user->recentOrders();
        $recentBids = $this->user->recentBid();
        return view('user.dashboard.index', compact('recentOrders', 'recentBids'));
    }

    public function recentMessage()
    {
        $messages = $this->user->recentMessage();
        return response()->json(['messages'=>$messages]);
    }

    public function meidaCount()
    {
        $sales = $this->user->sales();
        $products = $this->user->products();
        $salesRevenue = $this->user->salesRevenue();
        return response()->json(['sales'=>$sales, 'products'=>$products, 'salesRevenue'=>$salesRevenue]);
    }
}
