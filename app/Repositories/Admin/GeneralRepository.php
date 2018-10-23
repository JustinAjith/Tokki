<?php
namespace App\Repositories\Admin;

use App\Message;
use App\Notification;
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
        $notification = $this->notification->where('admin_user_id', '!=', null)->limit(3)->orderBy('id', 'DESC')->get();
        $unread = $this->notification->where(['admin_id'=>null, 'admin_status'=>1])->count();
        return response()->json(['notification'=>$notification, 'unread'=>$unread]);
    }

    public function getAllNotification()
    {
        return $this->notification->where('admin_id', null)->orderBy('id', 'DESC')->paginate(20);
    }

    public function readNotification()
    {
        $this->notification->where(['admin_id'=>null, 'admin_status'=>1])->update(['admin_status'=>0]);
        return ['success'=>true];
    }

    public function getMessage()
    {
        $messages = $this->message::with('user')->where('admin_id', '!=', null)->limit(3)->orderBy('id', 'DESC')->get();
        $unread = $this->message->where('admin_status', 1)->where( 'admin_id', '!=', null)->count();
        return response()->json(['messages'=>$messages, 'unread'=>$unread]);
    }

    public function readMessage()
    {
        $this->message::where('admin_status', 1)->where( 'admin_id', '!=', null)->update(['admin_status'=>0]);
        return ['success'=>true];
    }
}