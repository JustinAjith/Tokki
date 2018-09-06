<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
        $rule = [
            'street' => 'required',
            'city' => 'required',
            'delivery_places' => 'required',
            'qty' => 'required',
            'name' => 'required',
            'mobile' => 'required',
            'telephone' => 'required',
        ];

        if($this->input('features')) {
            $rule['features.*'] = 'required';
            $rule['features_description.*'] = 'required';
        }

        return $rule;
    }
}
