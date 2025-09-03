<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Product;

class PurchaseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'product_id' => Product::factory()->state([
                'user_id' => 1,         // 必要なら明示
                'company_id' => 1,      // ★ これが重要！
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
