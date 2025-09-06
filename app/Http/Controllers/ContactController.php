<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ContactSubmitRequest;

/**
 * お問い合わせ（公開）
 * 主要ルート: GET/POST /inquiry
 * ※ 現状は保存・メール送信を行わず完了メッセージのみ返却
 */
class ContactController extends Controller
{
    /** フォーム表示 */
    public function showForm()
    {
        return view('inquiry.form_view');
    }

    /** 送信処理（検証のみ） */
    public function submitForm(ContactSubmitRequest $request)
    {
        // $validated = $request->validated(); // 将来的に保存や送信を行う場合に使用

        if (Auth::check()) {
            return redirect()->route('product.list')->with('success', 'お問い合わせを送信しました。');
        }
        return redirect()->route('login')->with('success', 'お問い合わせを送信しました。ログインしてください。');
    }
}
