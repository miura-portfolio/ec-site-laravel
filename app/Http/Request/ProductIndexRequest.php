<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * 商品一覧の検索条件バリデーション
 * 任意: name / 価格帯(min/max)
 */
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
