<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price_at_purchase',  // ★ マイグレーションと一致させる
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ★ ソフト削除済みの商品も履歴から参照できるように
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->withTrashed();
    }
}
