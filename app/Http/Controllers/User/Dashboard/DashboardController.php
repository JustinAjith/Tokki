<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\User\DashboardRepository;
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
        return view('user.dashboard.index');
    }

    public function getOrders(): JsonResponse
    {
        return $this->user->getOrders();
    }
}
