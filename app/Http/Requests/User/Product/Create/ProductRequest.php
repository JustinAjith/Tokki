<?php

namespace App\Http\Requests\User\Product\Create;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category' => 'required',
            'sub_category' => 'required',
            'heading' => 'required',
            'key_word' => 'required',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'discount_type' => 'required',
            'qty' => 'required|numeric',
            'delivery_places.*' => 'required',
            'image.*' => 'required',
            'display_image' => 'required',
            'title.*' => 'required',
            'description.*' => 'required'
        ];
    }
}
