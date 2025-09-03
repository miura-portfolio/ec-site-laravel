<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $fillable = [
        'name',
        'name_kanji',
        'name_kana',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function purchases() {
        return $this->hasMany(Purchase::class);
    }

    // 🔽 ここを追加！！
    public function likedProducts()
    {
        return $this->belongsToMany(Product::class, 'likes')->withTimestamps();
    }
    public function sales()
    {
    return $this->hasMany(Sale::class);
    }
}
