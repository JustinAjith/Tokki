<?php

namespace App\Http\Requests\User\Product\Edit;

use Illuminate\Foundation\Http\FormRequest;

class ProductImageRequest extends FormRequest
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
        if($this->input('image') && $this->input('display_image')) {
            return [
                'image.*' => 'required',
                'display_image' => 'required',
            ];
        }

        elseif($this->input('image')) {
            return [
                'image.*' => 'required',
            ];
        }

        elseif($this->input('display_image')) {
            return [
                'display_image' => 'required',
            ];
        }
    }
}
