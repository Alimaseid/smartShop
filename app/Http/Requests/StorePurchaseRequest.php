<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseRequest extends FormRequest
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
            'vendor_id' => 'required',
            // 'requisition_id' => 'required',
            'invoice_no' => 'required|unique:purchases,invoice_no',
            // 'total' => 'required',
            'tax' => 'required',
            'product_list' => 'required'
        ];
    }
}
