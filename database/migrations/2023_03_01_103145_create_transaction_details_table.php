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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transactions_id');
            $table->unsignedBigInteger('menus_id');
            $table->unsignedBigInteger('discounts_id')->nullable();
            $table->integer('price');
            $table->integer('amount_item');
            $table->integer('total_price');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('transactions_id')->references('id')->on('transactions');
            $table->foreign('menus_id')->references('id')->on('menus');
            $table->foreign('discounts_id')->references('id')->on('discounts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
