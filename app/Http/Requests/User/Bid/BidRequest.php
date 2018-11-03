<?php

namespace App\Http\Requests\User\Bid;

use Illuminate\Foundation\Http\FormRequest;

class BidRequest extends FormRequest
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
            'bid' => 'required|numeric',
            'receipt_id' => 'required',
            'amount' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'receipt_file' => 'required',
            'date' => 'required|date|before:tomorrow',
        ];
    }
}
