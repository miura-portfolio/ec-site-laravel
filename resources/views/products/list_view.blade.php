@extends('layouts.header_footer')

@section('content')
<div class="container container-narrow">
    <h2>商品一覧</h2>

    {{-- ▼ ここから追加：フラッシュ / エラー表示 --}}
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
    {{-- ▲ ここまで追加 --}}
    
    <form method="GET" action="{{ route('product.list') }}" class="search-form">
        <div class="search-group">
            <input type="text"   name="name"      placeholder="商品名を入力" value="{{ request('name') }}">
            <input type="number" name="min_price" placeholder="最低価格"     value="{{ request('min_price') }}">
            <span>〜</span>
            <input type="number" name="max_price" placeholder="最高価格"     value="{{ request('max_price') }}">
            <button type="submit">検索</button>
        </div>
    </form>

    <table class="product-table">
        <thead>
            <tr>
                <th>商品番号</th>
                <th>商品名</th>
                <th>商品説明</th>
                <th>画像</th>
                <th>料金 (¥)</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->description }}</td>
                <td>
                    @if(!empty($product->img_path))
                        <img src="{{ asset($product->img_path) }}" alt="商品画像" class="product-image">
                    @endif
                    {{-- 画像が無ければ何も出さない --}}
                </td>
                <td>{{ number_format($product->price) }}</td>

                <td class="action-cell">
                    <a href="{{ route('purchase.form', $product->id) }}"
                       class="btn btn-success btn-compact btn-no-wrap"
                       {{ $product->stock === 0 ? 'aria-disabled=true style=pointer-events:none;opacity:.5;' : '' }}>
                        購入
                    </a>

                    <a href="{{ route('product.detail', $product->id) }}"
                       class="btn btn-success btn-compact btn-no-wrap">
                        詳細
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
