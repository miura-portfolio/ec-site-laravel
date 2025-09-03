<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    public function authorize(): bool { return auth()->check(); }

    public function rules(): array
    {
        return [
            'quantity' => ['required','integer','min:1'],
            'ptoken'   => ['required','string'],
        ];
    }

    public function attributes(): array
    {
        return ['quantity'=>'購入個数','ptoken'=>'購入トークン'];
    }
}
