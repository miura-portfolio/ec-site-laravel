<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * 購入処理の入力検証
 * quantity: 1以上の整数、ptoken: 二重送信防止用UUID
 */
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
