<?php
namespace App\Http\Controllers;

use App\Http\Requests\InquirySendRequest;

/**
 * ※ 現状は未使用。/inquiry のルーティングは ContactController に集約。
 *   互換のため残置しているが、運用では削除またはContactControllerに統合推奨。
 */
class InquiryController extends Controller
{
    public function showForm()
    {
        return view('inquiry.form_view');
    }

    public function send(InquirySendRequest $request)
    {
        // $validated = $request->validated();
        return redirect()
            ->route('inquiry.form')
            ->with('success', 'お問い合わせを送信しました。ありがとうございます。');
    }
}
