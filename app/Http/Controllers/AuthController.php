<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{
    public function showLoginForm() { return view('auth.login_view'); }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('product.list');
        }
        return back()->withErrors(['login_error' => 'メールアドレスもしくはパスワードが間違っています']);
    }

    public function showRegisterForm() { return view('auth.register_view'); }

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
        return redirect()->route('login')->with('success', 'アカウント登録が完了しました！ログインしてください。');
    }

    public function logout(\Illuminate\Http\Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'ログアウトしました');
    }
}
