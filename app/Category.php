<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    use Notifiable;

    protected $fillable = ['name'];

    public function subCategory()
    {
        return $this->hasMany(SubCategory::class);
    }
}
