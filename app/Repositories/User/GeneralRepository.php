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
        $notifications = $this->notification->where(['user_id'=>$userId, 'user_status'=>1])->get();
        foreach($notifications as $notification){
            $notification->update(['user_status'=>0]);
        }
        return ['success'=>true];
    }
}