<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * 会員登録の入力検証
 * 検証項目: 氏名・氏名カナ・メール唯一・パスワード(確認あり)
 */
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
