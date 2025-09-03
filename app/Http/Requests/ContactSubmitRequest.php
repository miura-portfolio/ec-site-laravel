<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactSubmitRequest extends FormRequest
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
