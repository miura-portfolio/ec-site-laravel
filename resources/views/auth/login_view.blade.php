{{-- ファイル: auth/login_view.blade.php
 目的 : ログイン画面
 依存 : route('auth.login.submit'), route('auth.register')
 注意 : フラッシュ/エラーを上部に表示してUXを担保 --}}
@extends('layouts.header_footer')

@section('content')
    <div class="login-form">
        @if (session('success'))
            <div class="flash-message">{{ session('success') }}</div>
        @endif

        @if ($errors->has('login_error'))
            <div class="flash-message error">{{ $errors->first('login_error') }}</div>
        @endif

        <form method="POST" action="{{ route('auth.login.submit') }}">
            @csrf
            <input type="email" name="email" placeholder="メールアドレス" required>
            <input type="password" name="password" placeholder="パスワード" required>
            <button type="submit" class="login-button">ログイン</button>
        </form>
        <a href="{{ route('auth.register') }}">新規登録はこちら</a>
    </div>
@endsection
