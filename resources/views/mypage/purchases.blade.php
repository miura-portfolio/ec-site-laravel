@extends('layouts.header_footer')

@section('content')
<div class="container container-narrow">
    <h2>購入履歴</h2>

    @if($purchases->isEmpty())
        <p>購入履歴はまだありません。</p>
    @else
        <table class="product-table">
            <thead>
                <tr>
                    <th>購入日</th>
                    <th>商品名</th>
                    <th>個数</th>
                    <th>金額 (¥)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchases as $purchase)
                <tr>
                    {{-- 購入日 --}}
                    <td>{{ $purchase->created_at->format('Y-m-d') }}</td>

                    {{-- 商品名（product_name に変更） --}}
                    <td>{{ $purchase->product->product_name ?? '不明' }}</td>

                    {{-- 個数（sales.quantity 前提。無ければ 1） --}}
                    <td>{{ $purchase->quantity ?? 1 }}</td>

                    {{-- 金額（sales.price 優先、無ければ product.price × quantity） --}}
                    @php
                        $unitPrice = $purchase->price ?? ($purchase->product->price ?? 0);
                        $qty = $purchase->quantity ?? 1;
                    @endphp
                    <td>{{ number_format($unitPrice * $qty) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
