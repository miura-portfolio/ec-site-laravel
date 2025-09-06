<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * 旧問い合わせ用（互換維持）
 * ※ 実運用では ContactSubmitRequest を使用
 */
class InquirySendRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'    => ['required','string','max:255'],
            'email'   => ['required','email','max:255'],
            'message' => ['required','string','max:5000'],
        ];
    }

    public function attributes(): array
    {
        return ['name'=>'名前','email'=>'メールアドレス','message'=>'お問い合わせ内容'];
    }
}
