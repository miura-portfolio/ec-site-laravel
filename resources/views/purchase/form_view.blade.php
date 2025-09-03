@extends('layouts.header_footer')

@section('content')
<div class="container container-narrow">
    <h2>商品購入</h2>

    {{-- エラーメッセージ --}}
    @if ($errors->has('purchase'))
        <div class="flash-message error" role="alert">{{ $errors->first('purchase') }}</div>
    @endif
    @error('quantity')
        <div class="flash-message error" role="alert">{{ $message }}</div>
    @enderror

    {{-- 成功メッセージ --}}
    @if (session('success'))
        <div class="flash-message" role="status" aria-live="polite">
            {{ session('success') }}
        </div>
    @endif

    <div class="product-detail">
        <p class="tight"><strong>商品名：</strong>{{ $product->product_name }}</p>
        <div class="spacer"></div>
        <p class="tight"><strong>説明：</strong>{{ $product->description }}</p>

        <div class="img-wrap" style="margin:8px 0;">
            @if($product->img_path)
                <img src="{{ asset($product->img_path) }}" alt="{{ $product->product_name }}" width="300">
            @endif
        </div>

        <p class="tight"><strong>金額：</strong>{{ number_format($product->price) }}円</p>
        <div class="spacer"></div>
        <p class="tight"><strong>残り：</strong>{{ $product->stock }}個</p>
        <div class="spacer"></div>
        <p class="tight"><strong>会社：</strong>{{ $product->company->company_name ?? '未登録' }}</p>

        <form method="POST"
              action="{{ route('purchase.store', $product->id) }}"
              class="purchase-form"
              onsubmit="this.querySelector('button[type=submit]').disabled=true;">
            @csrf
            {{-- ★ 二重送信防止用トークン --}}
            <input type="hidden" name="ptoken" value="{{ $ptoken }}">

            <div class="form-row" style="margin-top:.75rem;">
                <label for="quantity">購入個数：</label>
                <input
                    type="number" id="quantity" name="quantity"
                    value="{{ old('quantity', 1) }}"
                    min="1"
                    max="{{ max(1, $product->stock) }}"
                    {{ $product->stock === 0 ? 'disabled' : '' }}
                    style="width:4em; display:inline-block; margin-left:.25rem;">
            </div>

            <div class="form-actions" style="margin-top: .75rem;">
                <button type="submit"
                        class="btn btn-primary btn-compact"
                        {{ $product->stock === 0 ? 'disabled' : '' }}>
                    購入する
                </button>
                <a href="{{ route('product.list') }}"
                   class="btn btn-secondary btn-compact">
                   戻る
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
