<?php

namespace App\Http\Requests\User\Product\Edit;

use Illuminate\Foundation\Http\FormRequest;

class SpecialFeaturesRequest extends FormRequest
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
            'features.*' => 'required',
            'features_description.*' => 'required'
        ];
    }
}
