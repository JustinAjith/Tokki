<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Admin\GeneralRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return view('admin.notification.index', compact('notifications'));
    }

    public function readNotification()
    {
        return $this->user->readNotification();
    }
}
