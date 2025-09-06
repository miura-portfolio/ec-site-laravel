<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

/**
 * 認証（ログイン／登録／ログアウト）
 * 主要ルート: /login, /register, POST /logout
 */
class AuthController extends Controller
{
    /** ログイン画面 */
    public function showLoginForm()
    {
        return view('auth.login_view');
    }

    /** ログイン処理 */
    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('product.list'); // intended を使う場合は変更可
        }
        return back()->withErrors([
            'login_error' => 'メールアドレスもしくはパスワードが間違っています',
        ]);
    }

    /** 登録画面 */
    public function showRegisterForm()
    {
        return view('auth.register_view');
    }

    /** 登録処理 */
    public function register(RegisterRequest $request)
    {
        $v = $request->validated();

        User::create([
            'name'       => $v['name'],
            'name_kanji' => $v['name_kanji'],
            'name_kana'  => $v['name_kana'],
            'email'      => $v['email'],
            'password'   => Hash::make($v['password']),
        ]);

        return redirect()
            ->route('login')
            ->with('success', 'アカウント登録が完了しました！ログインしてください。');
    }

    /** ログアウト処理 */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'ログアウトしました');
    }
}
