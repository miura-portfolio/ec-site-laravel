{{-- ファイル: auth/register_view.blade.php
 目的 : 会員登録
 依存 : route('auth.register.submit'), route('login') --}}
@extends('layouts.header_footer')

@section('content')
<div class="register-form">
    @if ($errors->any())
    <div class="error-messages" style="color: red; margin-bottom: 1rem;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('auth.register.submit') }}">
        @csrf
        <input type="text" name="name" placeholder="ユーザ名" required>
        <input type="text" name="name_kanji" placeholder="名前（漢字）" required>
        <input type="text" name="name_kana" placeholder="名前（カナ）" required>
        <input type="email" name="email" placeholder="メールアドレス" required>
        <input type="password" name="password" placeholder="パスワード" required>
        <input type="password" name="password_confirmation" placeholder="確認パスワード" required>
        <button type="submit" class="register-button">新規登録</button>
    </form>
    <a href="{{ route('login') }}">ログインはこちら</a>
</div>
@endsection
