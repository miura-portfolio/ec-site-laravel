<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')->restrictOnDelete();
            $table->unsignedInteger('quantity')->default(1);        // NOT NULL & 1
            $table->unsignedInteger('price_at_purchase')->nullable(); // 任意: 当時価格の保管
            $table->timestamps();

            $table->index('user_id');
            $table->index('product_id');
        });
    }

    public function down(): void {
        Schema::dropIfExists('sales');
    }
};
