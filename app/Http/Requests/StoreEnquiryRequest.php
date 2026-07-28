<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEnquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_id' => ['required', 'exists:companies,id'],
            'product_id' => ['nullable', 'required_without:service_id', 'exists:products,id'],
            'service_id' => ['nullable', 'required_without:product_id', 'exists:services,id'],
            'message' => ['required', 'string', 'max:2000'],
            'priority' => ['nullable', Rule::in(['low', 'medium', 'high'])],
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required_without' => 'Please specify a product_id or a service_id.',
            'service_id.required_without' => 'Please specify a product_id or a service_id.',
        ];
    }
}
