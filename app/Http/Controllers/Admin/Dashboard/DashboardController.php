<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Repositories\Admin\DashboardRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    protected $admin;
    public function __construct(DashboardRepository $admin)
    {
        $this->admin = $admin;
    }

    public function index(): View
    {
        $recentOrders = $this->admin->recentOrders();
        $recentBids = $this->admin->recentBid();
        return view('admin.dashboard.index', compact('recentOrders', 'recentBids'));
    }
}
