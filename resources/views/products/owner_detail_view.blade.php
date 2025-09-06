{{-- ファイル: products/owner_detail_view.blade.php
 目的 : 出品者向けの商品詳細（編集/削除導線）
 依存 : route('product.edit'), route('product.destroy'), route('mypage.index') --}}
@extends('layouts.header_footer')

@section('content')
<div class="container container-narrow">
    <h2>出品商品詳細</h2>

    <div class="product-detail">
        <p class="tight"><strong>商品名：</strong>{{ $product->product_name }}</p>
        <div class="spacer"></div>

        <p class="tight"><strong>説明：</strong></p>
        <p style="white-space:pre-wrap; margin-top:4px;">{{ $product->description }}</p>

        @if(!empty($product->img_path))
            <div class="img-wrap" style="margin:8px 0;">
                <img src="{{ asset($product->img_path) }}" alt="{{ $product->product_name }}" width="300">
            </div>
        @endif

        <p class="tight"><strong>金額：</strong>{{ number_format($product->price) }}円</p>
        @isset($product->stock)
            <div class="spacer"></div>
            <p class="tight"><strong>在庫：</strong>{{ $product->stock }}個</p>
        @endisset
        <div class="spacer"></div>

        <div class="form-actions">
            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary btn-compact btn-no-wrap">編集</a>

            <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="js-delete-form" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-compact btn-no-wrap">削除する</button>
            </form>

            <a href="{{ route('mypage.index') }}" class="btn btn-secondary btn-compact btn-no-wrap">戻る</a>
        </div>
    </div>
</div>
@endsection
