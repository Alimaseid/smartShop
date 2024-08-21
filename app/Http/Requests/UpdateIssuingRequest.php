<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIssuingRequest extends FormRequest
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
            "date" => 'required|date',
            "issuing_no" => 'required|unique:issuings,issuing_no,'.$this->issuing->id,
            "from"=>'required',
            "requested_by" => 'required',
            "product_list" => 'required'
        ];
    }
}
