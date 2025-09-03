<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes; // ★ 追加

class Product extends Model
{
    use HasFactory, SoftDeletes; // ★ 追加

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

    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }

    // ★ 追加：購入履歴
    public function sales()
    {
        return $this->hasMany(\App\Models\Sale::class, 'product_id');
    }
}
