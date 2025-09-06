<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * ログインの入力検証
 * 検証項目: email, password
 */
class LoginRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'email'    => ['required','email'],
            'password' => ['required','string'],
        ];
    }

    public function attributes(): array
    {
        return ['email'=>'メールアドレス','password'=>'パスワード'];
    }
}
