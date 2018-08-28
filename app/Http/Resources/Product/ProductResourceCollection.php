<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResourceCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->heading,
            'discount_type' => $this->discount_type,
            'discount' => $this->discount,
            'price' => $this->discount_type == '%' ? number_format((1 - $this->discount/100) * $this->price, 2) : number_format($this->price - $this->discount, 2),
            'qty' => $this->qty,
            'image' => $this->display_image,
            'link' => 'item/'.str_replace(' ', '-', $this->heading).'/'.$this->id,
        ];
    }
}
