@extends('layouts.header_footer')

@section('content')
<div class="container container-narrow">
    <h2>出品商品編集</h2>

    @if ($errors->any())
        <div class="flash-message error" style="margin-bottom:1rem;">
            <ul style="margin:0; padding-left:1.2rem;">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-row">
            <label for="name">商品名</label>
            <input type="text" id="name" name="name"
                   value="{{ old('name', $product->product_name) }}" required>
        </div>

        <div class="form-row">
            <label for="price">価格</label>
            <input type="number" id="price" name="price" min="0"
                   value="{{ old('price', $product->price) }}" required>
        </div>

        <div class="form-row">
            <label for="description">商品説明</label>
            <textarea id="description" name="description" rows="4">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="form-row">
            <label for="stock">在庫数</label>
            <input type="number" id="stock" name="stock" min="0"
                   value="{{ old('stock', $product->stock) }}" required>
        </div>
        <div class="form-row">
            <label for="company_name">会社名</label>
            <input type="text" id="company_name" name="company_name"
                  value="{{ old('company_name', $product->company->company_name ?? '') }}">
        </div>


        {{-- 現在の画像表示 --}}
{{-- 現在の画像表示 / 削除チェック（横一列で改行しない） --}}
<div class="form-row">
    <label>現在の画像</label>
    <div class="image-inline">
        @if (!empty($product->img_path))
            <img src="{{ asset($product->img_path) }}" alt="現在の画像" class="img-preview">
            <label class="inline-checkbox">
                <input type="checkbox" name="remove_image" value="1">
                画像を削除する
            </label>
        @else
            <span class="muted">（登録なし）</span>
        @endif
    </div>
</div>

{{-- アップロード欄（選択クリアボタンはJSで動作） --}}
<div class="form-row image-field">
    <label for="image">商品画像</label>
    <div class="file-row">
        <input type="file" id="image" name="image" accept="image/*">
        <button type="button" class="btn btn-secondary btn-compact js-clear-file" data-target="#image">
            選択をクリア
        </button>
    </div>
</div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary btn-compact">更新</button>
            <a href="{{ route('product.ownerDetail', $product->id) }}" class="btn btn-secondary btn-compact">戻る</a>
        </div>
    </form>
</div>
@endsection
