<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 呼び出すSeederを登録
        $this->call([
            UsersTableSeeder::class,
            ProductsTableSeeder::class,
            ProductSeeder::class,
            SalesTableSeeder::class,
        ]);
    }
}
