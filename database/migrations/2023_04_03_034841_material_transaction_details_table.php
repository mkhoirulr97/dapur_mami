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
        Schema::create('material_transaction_details', function (Blueprint $table) {
            $table->id();
            $table->integer('material_transaction_id');
            $table->string('name');
            $table->integer('unit_type')->default(1);
            $table->integer('quantity');
            $table->integer('ppu');
            $table->integer('total');
            $table->integer('status')->default(1); // 1 = waiting for payment, 2 = paid, 3 = canceled
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_transaction_details');
    }
};
