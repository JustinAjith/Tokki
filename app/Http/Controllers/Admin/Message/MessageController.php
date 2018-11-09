<?php

namespace App\Http\Controllers\Admin\Message;

use App\Contact;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $unread = $this->unReadMessage();
        $messages = Message::with('user')->where('admin_id', '!=', null)->orderBy('id', 'DESC')->paginate(22);
        return view('admin.message.index', compact('unread', 'messages'));
    }

    public function compose(User $user)
    {
        $unread = $this->unReadMessage();
        return view('admin.message.compose', compact('unread', 'user'));
    }

    public function store(Request $request)
    {
        $message = new Message();
        $message->message = $request->message;
        $message->user_id = $request->user_id;
        $message->admin_status = 0;
        $message->save();
        return ['success'=>true];
    }

    public function unReadMessage()
    {
        return Message::where('admin_status', 1)->where('admin_id', '!=', null)->count();
    }

    public function send()
    {
        $unread = $this->unReadMessage();
        $messages = Message::where('admin_id', null)->orderBy('id', 'DESC')->paginate(22);
        return view('admin.message.send', compact('unread', 'messages'));
    }

    public function userMessage(User $user)
    {
        $unread = $this->unReadMessage();
        $messages = Message::with('user')->where('admin_id', '!=', null)->where('user_id', $user->id)->orderBy('id', 'DESC')->paginate(22);
        return view('admin.message.index', compact('unread', 'messages', 'user'));
    }

    public function userSend(User $user)
    {
        $unread = $this->unReadMessage();
        $messages = Message::where(['admin_id'=>null, 'user_id'=>$user->id])->orderBy('id', 'DESC')->paginate(22);
        return view('admin.message.send', compact('unread', 'messages', 'user'));
    }

    public function contact()
    {
        $unread = $this->unReadMessage();
        $contacts = Contact::paginate(22);
        return view('admin.message.contact', compact('unread', 'contacts'));
    }
}
