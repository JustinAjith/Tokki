<?php
namespace App\Repositories\Admin;

use App\Notification;
use Illuminate\Support\Facades\Auth;

class GeneralRepository
{
    protected $notification;
    public function __construct(Notification $notification = null)
    {
        $this->notification = $notification ?? new Notification();
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
        $notifications = $this->notification->where(['admin_id'=>null, 'admin_status'=>1])->get();
        foreach($notifications as $notification){
            $notification->update(['admin_status'=>0]);
        }
        return ['success'=>true];
    }
}