<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AccountUpdateRequest;

class AccountController extends Controller
{
    public function __construct() { $this->middleware('auth'); }

    public function edit()
    {
        $user = Auth::user();
        return view('mypage.account_edit_view', compact('user'));
    }

    public function update(AccountUpdateRequest $request)
    {
        $user = Auth::user();
        $validated = $request->validated();

        $user->name       = $validated['name'];
        $user->email      = $validated['email'];
        $user->name_kanji = $validated['name_kanji'];
        $user->name_kana  = $validated['name_kana'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('mypage.index')->with('success', 'アカウント情報を更新しました。');
    }
}
