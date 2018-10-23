<?php
namespace App\Repositories\User;

use App\Message;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralRepository
{
    protected $notification;
    protected $message;
    public function __construct(Notification $notification = null, Message $message = null)
    {
        $this->notification = $notification ?? new Notification();
        $this->message = $message ?? new Message();
    }

    public function getNotification()
    {
        $userId = Auth::user()->id;
        $notification = $this->notification->where('user_id', $userId)->limit(3)->orderBy('id', 'DESC')->get();
        $unread = $this->notification->where(['user_id'=>$userId, 'user_status'=>1])->count();
        return response()->json(['notification'=>$notification, 'unread'=>$unread]);
    }

    public function getAllNotification()
    {
        $userId = Auth::user()->id;
        return $this->notification->where('user_id', $userId)->orderBy('id', 'DESC')->paginate(20);
    }

    public function readNotification()
    {
        $userId = Auth::user()->id;
        $this->notification->where(['user_id'=>$userId, 'user_status'=>1])->update(['user_status'=>0]);
        return ['success'=>true];
    }

    public function getMessage()
    {
        $userId = Auth::user()->id;
        $messages = $this->message->where(['user_id'=>$userId, 'admin_id'=>null])->limit(3)->orderBy('id', 'DESC')->get();
        $unread = $this->message->where(['user_id'=>$userId, 'user_status'=>1, 'admin_id'=>null])->count();
        return response()->json(['messages'=>$messages, 'unread'=>$unread]);
    }

    public function readMessage()
    {
        $userId = Auth::user()->id;
        $this->message->where(['user_id'=>$userId, 'user_status'=>1, 'admin_id'=>null])->update(['user_status'=>0]);
        return ['success'=>true];
    }
}