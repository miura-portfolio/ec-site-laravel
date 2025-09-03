<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;

    // 保存可能なカラムを追加
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',   // 購入個数
        'price',      // 合計金額（単価×個数）
    ];

    // ユーザーとのリレーション
    public function user() {
        return $this->belongsTo(User::class);
    }

    // 商品とのリレーション
    public function product() {
        return $this->belongsTo(Product::class);
    }
}
