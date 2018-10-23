<?php

namespace App\Http\Controllers\Admin;

use App\Message;
use App\Notification;
use App\Repositories\Admin\GeneralRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        return view('admin.notification.index', compact('notifications'));
    }

    public function readNotification()
    {
        return $this->user->readNotification();
    }

    public function removeNotification(Notification $notification)
    {
        $notification->delete();
        return ['success'=>true];
    }

    public function getMessage(): JsonResponse
    {
        return $this->user->getMessage();
    }

    public function readMessage()
    {
        return $this->user->readMessage();
    }

    public function removeMessage(Message $message)
    {
        $message->delete();
        return ['success'=>true];
    }
}
