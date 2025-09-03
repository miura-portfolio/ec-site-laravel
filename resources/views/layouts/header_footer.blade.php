<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravelマーケット</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/script.js') }}" defer></script>
</head>
<body>
    <header>
        <h1>Laravelマーケット</h1>
        <nav class="nav-links">
            <a href="{{ route('product.list') }}">Home</a>
            <a href="{{ route('mypage.index') }}">マイページ</a>

            @auth
                <span style="margin-left: 1rem;">ようこそ、{{ Auth::user()->name }} さん</span>

                {{-- ログアウトをリンク風に --}}
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="margin-left: 1rem;">
                    ログアウト
                </a>
                <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}">ログイン</a>
                <a href="{{ route('auth.register') }}">新規登録</a>
            @endguest
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <nav class="nav-links">
            <a href="{{ route('product.list') }}">Home</a>
            <a href="{{ route('mypage.index') }}">マイページ</a>
            <a href="{{ route('inquiry.form') }}">お問い合わせ</a> {{-- フッターのリンクは残す --}}
        </nav>
        <p>&copy; 2025 Laravel Market</p>
    </footer>
</body>
</html>
