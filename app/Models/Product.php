<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Company;
use App\Models\User;
use App\Models\Sale;

/**
 * 商品モデル（ソフト削除対応）
 * リレーション: company, user, likedByUsers, sales
 */
class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_name',
        'description',
        'price',
        'stock',
        'img_path',
        'company_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /** いいねしているユーザー */
    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }

    /** 購入履歴 */
    public function sales()
    {
        return $this->hasMany(Sale::class, 'product_id');
    }
}
