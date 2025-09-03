<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\User;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $user = User::first();

        Product::create([
            'product_name' => '鉛筆',
            'description'  => '書きやすい鉛筆です',
            'price'        => 200,
            'img_path'     => 'images/pencil.png',
            'stock'        => 10,             // ★在庫10
            'user_id'      => $user->id,
            'company_id'   => 1,
        ]);

        Product::create([
            'product_name' => 'イヤホン',
            'description'  => 'ワイヤレスです。',
            'price'        => 1000,
            'img_path'     => 'images/earphone.png',
            'stock'        => 10,             // ★
            'user_id'      => $user->id,
            'company_id'   => 1,
        ]);

        Product::create([
            'product_name' => 'タブレット',
            'description'  => '軽量です',
            'price'        => 25000,
            'img_path'     => 'images/tablet.png',
            'stock'        => 10,             // ★
            'user_id'      => $user->id,
            'company_id'   => 1,
        ]);

        Product::create([
            'product_name' => 'デスク',
            'description'  => '昇降できます',
            'price'        => 30000,
            'img_path'     => 'images/desk.png',
            'stock'        => 10,             // ★
            'user_id'      => $user->id,
            'company_id'   => 1,
        ]);
    }
}
