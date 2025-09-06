<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories.HasFactory;

/**
 * お問い合わせ保存用モデル（必要に応じて使用）
 * 保存する場合は name も fillable に含める
 */
class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'name',
        'email',
        'message',
    ];
}
