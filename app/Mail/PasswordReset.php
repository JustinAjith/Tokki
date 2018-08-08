<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordReset extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        $password = $request->password;
        $user = User::where('id', $request->user_id)->first();
        $adminEmail = env('ADMIN_EMAIL');
        return $this->view('email.password_reset', ['password'=>$password])->to($user->email)->from($adminEmail)->subject('Password reset');
    }
}
