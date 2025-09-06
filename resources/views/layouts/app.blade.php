{{-- ファイル: layouts/app.blade.php
 目的 : ベースレイアウト（未使用でも保守のため残置）
 注意 : 通常は layouts/header_footer.blade.php を継承 --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    @include('layouts.header_footer')

    <main>
        @yield('content')
    </main>
</body>
</html>
