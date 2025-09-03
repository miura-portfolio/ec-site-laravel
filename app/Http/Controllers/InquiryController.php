<?php
namespace App\Http\Controllers;

use App\Http\Requests\InquirySendRequest;

class InquiryController extends Controller
{
    public function showForm()
    {
        return view('inquiry.form_view');
    }

    public function send(InquirySendRequest $request)
    {
        // $validated = $request->validated(); // 送信処理なし
        return redirect()->route('inquiry.form')->with('success', 'お問い合わせを送信しました。ありがとうございます。');
    }
}
