<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 会社マスタ
 * 主な列: company_name
 */
class Company extends Model
{
    use HasFactory;

    protected $fillable = ['company_name'];
}
