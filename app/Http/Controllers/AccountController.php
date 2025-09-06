<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AccountUpdateRequest;

/**
 * アカウント情報の閲覧・更新（要認証）
 * 主要ルート: GET /account/edit, PUT /account/update
 */
class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /** アカウント編集画面 */
    public function edit()
    {
        $user = Auth::user();
        return view('mypage.account_edit_view', compact('user'));
    }

    /** アカウント更新処理（FormRequestで検証済） */
    public function update(AccountUpdateRequest $request)
    {
        $user = Auth::user();
        $v = $request->validated();

        $user->name       = $v['name'];
        $user->email      = $v['email'];
        $user->name_kanji = $v['name_kanji'];
        $user->name_kana  = $v['name_kana'];

        if (!empty($v['password'])) {
            $user->password = Hash::make($v['password']);
        }

        $user->save();

        return redirect()
            ->route('mypage.index')
            ->with('success', 'アカウント情報を更新しました。');
    }
}
