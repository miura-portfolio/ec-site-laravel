@extends('layouts.header_footer')

@section('content')
<div class="container container-narrow">
    <h2>商品詳細</h2>

    <p class="tight"><strong>商品名：</strong>{{ $product->product_name }}</p>
    <div class="spacer"></div>

    <p class="tight"><strong>説明：</strong></p>
    <p style="white-space:pre-wrap; margin-top:4px;">{{ $product->description }}</p>

    {{-- 画像は「あるときだけ」表示（無ければ何も表示しない） --}}
    @if(!empty($product->img_path))
        <div class="img-wrap">
            <img src="{{ asset($product->img_path) }}" alt="{{ $product->product_name }}" width="300">
        </div>
    @endif

    <p class="tight"><strong>金額：</strong>{{ number_format($product->price) }}円</p>
    <div class="spacer"></div>
    <p class="tight"><strong>会社：</strong>{{ $product->company->company_name ?? '未登録' }}</p>

    @auth
        <form method="POST" action="{{ route('product.toggleLike', $product->id) }}" class="like-form">
            @csrf
            <button type="submit"
                class="heart-btn"
                aria-label="{{ $isLiked ? 'お気に入り解除' : 'お気に入りに追加' }}"
                aria-pressed="{{ $isLiked ? 'true' : 'false' }}"
                title="{{ $isLiked ? 'お気に入り解除' : 'お気に入りに追加' }}">
                &#9829;
            </button>
        </form>
    @else
        <p style="margin-top:6px;">お気に入り機能を使うにはログインしてください。</p>
    @endauth

    <div class="form-actions" style="margin-top:12px;">
        <a href="{{ route('purchase.form', $product->id) }}"
           class="btn btn-primary btn-compact btn-no-wrap"
           {{ $product->stock === 0 ? 'aria-disabled=true style=pointer-events:none;opacity:.5;' : '' }}>
           カートに追加（購入画面へ）
        </a>
        <a href="{{ route('product.list') }}" class="btn btn-secondary btn-compact">戻る</a>
    </div>
</div>
@endsection
