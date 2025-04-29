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
        Schema::create('storage_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')->constrained('warehouses')->onDelete('cascade');
            $table->string('code')->unique();
            $table->string('name');
            $table->integer('level')->default(0);
            $table->decimal('max_weight', 10, 2)->nullable();
            $table->decimal('max_volume', 10, 2)->nullable();
            $table->boolean('is_occupied')->default(false);
            $table->timestamps();

            $table->index(['warehouse_id', 'level']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('storage_locations');
    }
};
