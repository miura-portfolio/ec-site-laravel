<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductIndexRequest extends FormRequest
{
    public function authorize(): bool { return auth()->check(); }

    public function rules(): array
    {
        return [
            'name'      => ['nullable','string','max:255'],
            'min_price' => ['nullable','integer','min:0'],
            'max_price' => ['nullable','integer','min:0'],
        ];
    }
}
