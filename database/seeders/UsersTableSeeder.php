<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Company; // ← 忘れずに use！

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ ① Company を1つだけ作成（Factoryで）
        $company = Company::factory()->create([
            'company_name' => 'テスト株式会社'
        ]);

        // ✅ ② 手動のテストユーザー
        User::create([
            'name' => 'Test User',
            'name_kanji' => 'テスト 太郎',
            'name_kana' => 'テスト タロウ',
            'email' => 'test@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'company_id' => $company->id, // ← 追加
        ]);

        // ✅ ③ Factoryでダミーユーザーを5人作成（同じ会社に所属）
        User::factory()->count(5)->create([
            'company_id' => $company->id,
            'name_kanji' => '山田 太郎',
            'name_kana' => 'ヤマダ タロウ',
        ]);
    }
}
