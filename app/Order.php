<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;

class Order extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['user_id', 'product_id', 'name', 'street', 'city', 'mobile', 'telephone', 'discount_type', 'discount', 'price', 'qty', 'delivery_places', 'features', 'features_description', 'bid_value', 'comment', 'status', 'date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
