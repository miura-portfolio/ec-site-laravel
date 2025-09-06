{{-- ファイル: mypage/purchases.blade.php
 目的 : 購入履歴（詳細表）
 注意 : 価格は sales.price_at_purchase を優先して表示 --}}
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
                    <td>{{ $purchase->created_at->format('Y-m-d') }}</td>
                    <td>{{ $purchase->product->product_name ?? '不明' }}</td>
                    <td>{{ $purchase->quantity ?? 1 }}</td>
                    @php
                        $unitPrice = $purchase->price_at_purchase ?? ($purchase->product->price ?? 0);
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
