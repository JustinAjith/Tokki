<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Message extends Model
{
    use Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'message', 'sender', 'receiver', 'receiver_status'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function admins()
    {
        return $this->belongsTo(Admin::class);
    }
}
