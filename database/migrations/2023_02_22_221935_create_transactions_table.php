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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('discounts_id')->nullable();
            $table->string('transaction_code')->unique();
            $table->string('customer_name');
            $table->integer('payment_method'); // 1 = cash, 2 = credit card
            $table->integer('total_payment');
            $table->integer('status'); // 1 = success, 2 = failed
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('discounts_id')->references('id')->on('discounts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
