<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * アカウント情報の更新用バリデーション（要認証）
 * メールは本人IDを除外して一意制約
 */
class AccountUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $userId = $this->user()?->id;

        return [
            'name'       => ['required','string','max:255'],
            'email'      => ['required','email','max:255', Rule::unique('users','email')->ignore($userId)],
            'name_kanji' => ['required','string','max:255'],
            'name_kana'  => ['required','string','max:255','regex:/^[ァ-ヶー\s]+$/u'],
            'password'   => ['nullable','string','min:8','confirmed'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name'       => '名前',
            'email'      => 'メールアドレス',
            'name_kanji' => '氏名（漢字）',
            'name_kana'  => '氏名（カナ）',
            'password'   => 'パスワード',
        ];
    }

    public function messages(): array
    {
        return [
            'name_kana.regex' => 'カナは全角カタカナで入力してください。',
        ];
    }
}
