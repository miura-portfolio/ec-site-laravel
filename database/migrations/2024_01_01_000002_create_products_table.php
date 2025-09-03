<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->text('description')->nullable();
            $table->unsignedInteger('price');
            $table->unsignedInteger('stock')->default(10);
            $table->string('img_path')->nullable();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->foreignId('company_id')
                  ->constrained('companies')
                  ->restrictOnDelete(); // 会社に商品があれば会社削除不可

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
