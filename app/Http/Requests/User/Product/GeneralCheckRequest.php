<?php

namespace App\Http\Requests\User\Product;

use Illuminate\Foundation\Http\FormRequest;

class GeneralCheckRequest extends FormRequest
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
            'price' => 'required',
            'discount' => 'required',
            'discount_type' => 'required'
        ];
    }
}
