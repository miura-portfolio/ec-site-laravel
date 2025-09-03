<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductFactory extends Factory
{
    // 明示的にモデルを関連付け
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'product_name' => $this->faker->words(2, true),
            'description'  => $this->faker->sentence(),
            'price'        => $this->faker->numberBetween(100, 50000),
            'img_path'     => null,          // 画像未設定なら null（任意で 'images/noimage.png' でもOK）
            'stock'        => 10,            // ★在庫10をデフォルトに
            'user_id'      => 1,
            'company_id'   => 1,
        ];
    }
}
