<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * いいね（ユーザー×商品の多対多）
 * 同一組合せはユニーク
 */
return new class extends Migration {
    public function up(): void {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['user_id','product_id'], 'likes_user_product_unique');
            $table->index(['user_id','product_id'], 'likes_user_product_idx');
        });
    }

    public function down(): void {
        Schema::dropIfExists('likes');
    }
};
