@extends('layouts.header_footer')

@section('content')
<div class="container container-narrow">
    <h2>マイページ</h2>

    {{-- 上部：ユーザー情報 --}}
    <div class="form-actions" style="justify-content: flex-start; margin-bottom: .5rem;">
        <form action="{{ route('account.edit') }}" method="GET" style="margin:0;">
            <button type="submit" class="btn btn-primary btn-compact btn-no-wrap">
                アカウント編集
            </button>
        </form>
    </div>

    <div style="display:flex; gap:2rem; flex-wrap:wrap; margin-bottom:1rem;">
        <div>
            <div>ユーザー名：{{ $user->name }}</div>
            <div>Eメール：{{ $user->email }}</div>
        </div>
        <div>
            <div>名前：{{ $user->name_kanji ?? '—' }}</div>
            <div>カナ：{{ $user->name_kana ?? '—' }}</div>
        </div>
    </div>

    {{-- 中部：出品商品 --}}
    <div style="display:flex; align-items:center; justify-content:space-between; margin: 12px 0 6px;">
        <h3 style="margin:0;">出品商品</h3>
        <a href="{{ route('product.create') }}" class="btn btn-primary btn-compact">新規登録</a>
    </div>

    @if($myProducts->isEmpty())
        <p>出品中の商品はありません。</p>
    @else
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
@foreach($myProducts as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->product_name }}</td>
        <td class="description-cell">
            {{ Str::limit($product->description, 50) }}
        </td>
        <td>
            @if(!empty($product->img_path))
                <img src="{{ asset($product->img_path) }}" alt="{{ $product->product_name }}" width="60">
            @endif
            {{-- 画像削除時は何も表示しない（noimage を出さない） --}}
        </td>
        <td>{{ number_format($product->price) }}</td>
        <td>
            <a href="{{ route('product.ownerDetail', $product->id) }}"
               class="btn btn-primary btn-compact">詳細</a>
        </td>
    </tr>
@endforeach
            </tbody>
        </table>
    @endif

    {{-- 下部：購入した商品 --}}
    <div style="display:flex; align-items:center; justify-content:space-between; margin-top:24px;">
        <h3 style="margin:0;">購入した商品</h3>
        <a href="{{ route('mypage.purchases') }}" class="btn btn-primary btn-compact btn-no-wrap">購入履歴</a>
    </div>

    @if($purchases->isEmpty())
        <p>購入履歴はまだありません。</p>
    @else
        <table class="product-table">
            <thead>
                <tr>
                    <th>商品名</th>
                    <th>商品説明</th>
                    <th>料金 (¥)</th>
                    <th>個数</th>
                </tr>
            </thead>
            <tbody>
            @foreach($purchases as $sale)
                <tr>
                    <td>{{ $sale->product->product_name ?? '—' }}</td>
                    <td>{{ $sale->product->description ?? '—' }}</td>
                    <td>{{ isset($sale->product) ? number_format($sale->product->price) : '—' }}</td>
                    <td>{{ $sale->quantity ?? 1 }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
