<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * 商品（ソフト削除対応）
 * 会社削除は制限（restrict）／ユーザー削除は連鎖（cascade）
 */
return new class extends Migration {
    public function up(): void {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->text('description')->nullable();
            $table->unsignedInteger('price');
            $table->unsignedInteger('stock')->default(10);
            $table->string('img_path')->nullable();

            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('company_id')->constrained('companies')->restrictOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->index('user_id');
            $table->index('company_id');
        });
    }

    public function down(): void {
        Schema::dropIfExists('products');
    }
};
