<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'       => ['required','string'],
            'name_kanji' => ['required','string'],
            'name_kana'  => ['required','string'],
            'email'      => ['required','email', Rule::unique('users','email')],
            'password'   => ['required','confirmed'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name'       => '名前',
            'name_kanji' => '氏名（漢字）',
            'name_kana'  => '氏名（カナ）',
            'email'      => 'メールアドレス',
            'password'   => 'パスワード',
        ];
    }
}
