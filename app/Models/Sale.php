<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 購入履歴（単価スナップショットを保持）
 * 主な列: user_id, product_id, quantity, price_at_purchase
 */
class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price_at_purchase',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /** ソフト削除済みの商品も履歴から参照可能に */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->withTrashed();
    }
}
