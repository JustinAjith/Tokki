<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;

class Product extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id', 'code', 'category', 'sub_category', 'mini_category', 'heading', 'key_word', 'discount_type', 'discount', 'price', 'qty', 'delivery_places', 'delivery_duration', 'image', 'display_image', 'title', 'description', 'features', 'features_description', 'status', 'bid_value',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->belongsTo(Order::class);
    }
}
