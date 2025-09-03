<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ContactSubmitRequest;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('inquiry.form_view');
    }

    public function submitForm(ContactSubmitRequest $request)
    {
        // $validated = $request->validated(); // 必要なら保存や送信処理

        if (Auth::check()) {
            return redirect()->route('product.list')->with('success', 'お問い合わせを送信しました。');
        }
        return redirect()->route('login')->with('success', 'お問い合わせを送信しました。ログインしてください。');
    }
}
