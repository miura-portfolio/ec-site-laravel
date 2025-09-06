{{-- ファイル: inquiry/form_view.blade.php
 目的 : 公開のお問い合わせフォーム
 依存 : route('inquiry.send') --}}
@extends('layouts.header_footer')

@section('content')
<div class="container container-narrow">
    <h2>お問い合わせフォーム</h2>

    @if (session('success'))
        <div class="flash-message" role="status" aria-live="polite">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="flash-message error">
            <ul style="margin:0; padding-left:1.2rem;">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('inquiry.send') }}">
        @csrf
        <div class="form-row">
            <label for="name">名前</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="form-row">
            <label for="email">メールアドレス</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="form-row">
            <label for="message">お問い合わせ内容</label>
            <textarea id="message" name="message" rows="6" required>{{ old('message') }}</textarea>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary btn-compact">送信</button>
            <a href="{{ route('product.list') }}" class="btn btn-secondary btn-compact">戻る</a>
        </div>
    </form>
</div>
@endsection
