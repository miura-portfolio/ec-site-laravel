{{-- ファイル: components/messages.blade.php
 目的 : 共通の成功/エラー表示
 使用 : @include('components.messages') --}}
@if (session('success'))
    <div class="alert alert-success" role="status" aria-live="polite">
        {{ session('success') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
