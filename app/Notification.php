<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Notification extends Model
{
    use Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'message', 'title', 'user_id', 'admin_id', 'user_status', 'admin_status'
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
