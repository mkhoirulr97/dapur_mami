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
        Schema::create('material_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code')->unique();
            $table->integer('total_paid');
            $table->integer('total_return');
            $table->integer('total_purchase');
            $table->integer('status')->default(1);
            $table->json('suppliers')->nullable();
            $table->integer('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_transactions');
    }
};
