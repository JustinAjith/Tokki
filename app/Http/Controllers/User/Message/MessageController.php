<?php

namespace App\Http\Controllers\User\Message;

use App\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $unread = $this->unReadMessage();
        $messages = Message::where(['user_id'=>Auth::user()->id, 'admin_id'=>null])->orderBy('id', 'DESC')->paginate(15);
        return view('user.message.index', compact('unread', 'messages'));
    }

    public function compose()
    {
        $unread = $this->unReadMessage();
        return view('user.message.compose', compact('unread'));
    }

    public function store(Request $request)
    {
        $message = new Message();
        $message->message = $request->message;
        $message->user_id = Auth::user()->id;
        $message->admin_id = 1;
        $message->user_status = 0;
        $message->save();
        return ['success'=>true];
    }

    public function unReadMessage()
    {
        $userId = Auth::user()->id;
        return Message::where(['user_id'=>$userId, 'user_status'=>1, 'admin_id'=>null])->count();
    }

    public function send()
    {
        $unread = $this->unReadMessage();
        $messages = Message::where('user_id', Auth::user()->id)->where('admin_id', '!=', null)->orderBy('id', 'DESC')->paginate(15);
        return view('user.message.send', compact('unread', 'messages'));
    }
}
