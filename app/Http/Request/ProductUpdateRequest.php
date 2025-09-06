<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * 商品更新の入力検証
 * 画像の差し替え/削除指定に対応
 */
class ProductUpdateRequest extends FormRequest
{
    public function authorize(): bool { return auth()->check(); }

    public function rules(): array
    {
        return [
            'name'         => ['required','string','max:255'],
            'description'  => ['nullable','string'],
            'price'        => ['required','integer','min:0'],
            'stock'        => ['required','integer','min:0'],
            'image'        => ['nullable','image','mimes:jpg,jpeg,png,webp','max:5120'],
            'company_name' => ['nullable','string','max:255'],
            'remove_image' => ['nullable','boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name'=>'商品名','description'=>'商品説明','price'=>'価格',
            'stock'=>'在庫','image'=>'画像','company_name'=>'会社名',
            'remove_image'=>'画像の削除',
        ];
    }
}
