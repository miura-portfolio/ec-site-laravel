<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * 購入履歴（価格スナップショット保持）
 * 商品削除は履歴を守るため restrict
 */
return new class extends Migration {
    public function up(): void {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')->restrictOnDelete();
            $table->unsignedInteger('quantity')->default(1);
            $table->unsignedInteger('price_at_purchase')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->index('product_id');
        });
    }

    public function down(): void {
        Schema::dropIfExists('sales');
    }
};
