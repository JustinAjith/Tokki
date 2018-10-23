<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;

class Payment extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['user_id', 'description', 'income', 'outgoing', 'date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
