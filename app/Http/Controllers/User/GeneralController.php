<?php

namespace App\Http\Controllers\User;

use App\Repositories\User\GeneralRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
    protected $user;
    public function __construct(GeneralRepository $user)
    {
        $this->user = $user;
    }

    public function getNotification()
    {
        return $this->user->getNotification();
    }

    public function getAllNotification()
    {
        $notifications = $this->user->getAllNotification();
        return view('user.notification.index', compact('notifications'));
    }

    public function readNotification()
    {
        return $this->user->readNotification();
    }
}
