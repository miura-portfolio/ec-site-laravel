{{-- ファイル: mypage/account_edit_view.blade.php
 目的 : 会員のアカウント編集
 依存 : route('account.update'), route('mypage.index') --}}
@extends('layouts.header_footer')

@section('content')
<div class="container container-narrow">
    <h2>アカウント編集画面</h2>

    @if ($errors->any())
        <div class="flash-message error" style="margin-bottom:1rem;">
            <ul style="margin:0; padding-left:1rem;">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('account.update') }}">
        @csrf
        @method('PUT')

        <div class="form-row">
            <label for="name">ユーザー名</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-row">
            <label for="email">Eメール</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-row">
            <label for="name_kanji">名前</label>
            <input type="text" id="name_kanji" name="name_kanji" value="{{ old('name_kanji', $user->name_kanji ?? '') }}" required>
        </div>

        <div class="form-row">
            <label for="name_kana">カナ</label>
            <input type="text" id="name_kana" name="name_kana" value="{{ old('name_kana', $user->name_kana ?? '') }}" required>
        </div>

        {{-- 任意：変更したい場合のみ入力 --}}
        <div class="form-row">
            <label for="password">パスワード（任意）</label>
            <input type="password" id="password" name="password" autocomplete="new-password">
        </div>
        <div class="form-row">
            <label for="password_confirmation">パスワード確認</label>
            <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary btn-compact">更新</button>
            <a href="{{ route('mypage.index') }}" class="btn btn-secondary btn-compact">戻る</a>
        </div>
    </form>
</div>
@endsection
