<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "date"=>'required',
            "rf_number"=>'required|unique:transfer_items,rf_number',
            "location_from"=>'required',
            "location_to"=>'required',
            "transferred_by"=>'required',
            "received_by"=>'required',
            'product_list'=>'required',
        ];
    }
}
