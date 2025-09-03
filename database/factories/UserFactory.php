<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Company;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'name_kanji' => '佐藤 太郎',       // ✅ これが必要
            'name_kana' => 'サトウ タロウ',    // ✅ これが必要
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
            'company_id' => Company::factory(), // ✅ 追加！
        ];
    }
}
