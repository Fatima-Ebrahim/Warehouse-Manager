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
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->foreignId('unit_id')->constrained('units')->onDelete('cascade');
            $table->foreignId('storage_unit_id')->nullable()->constrained('storage_units')->cascadeOnDelete();
            $table->foreignId('storage_location_id')->nullable()->constrained('storage_locations')->onDelete('set null');
            $table->string('batch_number')->nullable();
            $table->date('production_date');
            $table->date('expiry_date');
            $table->decimal('quantity', 12, 3);
            $table->decimal('quantity_in_base_unit', 12, 3);
            $table->foreignId('purchase_receipt_item_id')->nullable()->constrained('purchase_receipt_items')->onDelete('cascade');
            $table->timestamps();

            $table->index(['item_id', 'expiry_date']);
            $table->index(['storage_location_id', 'batch_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
