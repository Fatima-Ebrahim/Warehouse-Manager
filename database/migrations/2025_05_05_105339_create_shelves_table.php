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
        Schema::create('shelves', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->foreignId('warehouse_coordinate_id')->nullable()->constrained('warehouse_coordinates')->nullOnDelete();
            $table->float('width')->default(0);
            $table->float('length')->default(0);
            $table->float('height')->default(0);
            $table->unsignedTinyInteger('levels')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shelves');
    }
};
