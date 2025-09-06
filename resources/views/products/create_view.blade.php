{{-- ファイル: products/create_view.blade.php
 目的 : 商品登録フォーム
 依存 : route('product.store') --}}
@extends('layouts.header_footer')

@section('content')
<div class="container container-narrow">
    <h2>商品登録</h2>

    <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-row">
            <label>商品名</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name') <p style="color:red; font-size:0.9em;">{{ $message }}</p> @enderror
        </div>

        <div class="form-row">
            <label>価格</label>
            <input type="number" name="price" min="0" value="{{ old('price') }}" required>
            @error('price') <p style="color:red; font-size:0.9em;">{{ $message }}</p> @enderror
        </div>

        <div class="form-row">
            <label>商品説明</label>
            <textarea name="description" rows="5">{{ old('description') }}</textarea>
            @error('description') <p style="color:red; font-size:0.9em;">{{ $message }}</p> @enderror
        </div>

        <div class="form-row">
            <label>在庫数</label>
            <input type="number" name="stock" min="0" value="{{ old('stock', 0) }}" required>
            @error('stock') <p style="color:red; font-size:0.9em;">{{ $message }}</p> @enderror
        </div>

        <div class="form-row">
            <label>会社</label>
            <input type="text" name="company_name" value="{{ old('company_name') }}" required>
            @error('company_name') <p style="color:red; font-size:0.9em;">{{ $message }}</p> @enderror
        </div>

        <div class="form-row">
            <label>商品画像</label>
            <input type="file" name="image" accept="image/*">
            @error('image') <p style="color:red; font-size:0.9em;">{{ $message }}</p> @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary btn-compact">登録</button>
            <a href="{{ route('mypage.index') }}" class="btn btn-secondary btn-compact">戻る</a>
        </div>
    </form>
</div>
@endsection
