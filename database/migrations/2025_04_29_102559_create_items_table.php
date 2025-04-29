<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->foreignId('base_unit_id')->constrained('units')->onDelete('restrict');
            $table->decimal('minimum_stock_level', 10, 2)->default(0);
            $table->decimal('maximum_stock_level', 10, 2)->nullable();
            $table->json('storage_conditions')->nullable();
            $table->decimal('weight_per_unit', 10, 2)->default(0);
            $table->decimal('volume_per_unit', 10, 2)->nullable();
            $table->decimal('average_cost', 10, 2)->default(0);
            $table->decimal('last_purchase_price', 10, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('barcode')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['name', 'code']);
            $table->index(['category_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
