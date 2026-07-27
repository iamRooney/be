<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'company_id' => 'required|exists:companies,id',

            'category_id' => 'required|exists:categories,id',

            'name' => 'required|string|max:255',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'short_description' => 'nullable|string',

            'description' => 'nullable|string',

            'starting_price' => 'nullable|numeric|min:0',

            'service_area' => 'nullable|string|max:255',

            'experience' => 'nullable|string|max:255',

            'availability' => 'nullable|string|max:255',

            'featured' => 'nullable|boolean',

            'status' => 'required|in:pending,approved,rejected',

        ];
    }
}
