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
        Schema::create('physical_orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('paintCategory');
            $table->string('paintType');
            $table->string('capacity');
            $table->integer('quantity');
            $table->string('paintcolor');
            $table->enum('needs_painter', ['yes', 'no']);
            $table->text('description')->nullable();
            $table->string('status')->default('Pending');
            $table->timestamps();
        });
    }

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('physical_orders');
    }
};
