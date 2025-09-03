<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Product::factory()->count(10)->create([
            'user_id'    => 1,
            'company_id' => 1,
            'stock'      => 10,   // ★在庫10で生成
        ]);
    }
}
