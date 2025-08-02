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
        Schema::create('material_controllers', function (Blueprint $table) {
            $table->id();
    $table->string('name');
    $table->string('unit');
    $table->float('stock_qty')->default(0);
    $table->float('reorder_level')->default(0);
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_controllers');
    }
};
