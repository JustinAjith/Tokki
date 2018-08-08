<?php

namespace App\Http\Controllers\User;

use App\Repositories\User\GeneralRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GeneralController extends Controller
{
    protected $user;
    public function __construct(GeneralRepository $user)
    {
        $this->user = $user;
    }

    public function getNotification(): JsonResponse
    {
        return $this->user->getNotification();
    }

    public function getAllNotification(): View
    {
        $notifications = $this->user->getAllNotification();
        return view('user.notification.index', compact('notifications'));
    }

    public function readNotification()
    {
        return $this->user->readNotification();
    }
}
