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
        Schema::create('delivery_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('users_id');
            $table->string('invoice')->unique();
            $table->string('customer_name');
            $table->string('payment_method');
            $table->integer('total_payment');
            $table->integer('sub_total');
            $table->integer('status')->default(0); // 0 = pending, 1 = paid, 2 = delivered, 3 = canceled, 4 = received
            $table->time('delivery_time')->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('delivery_address')->nullable();
            $table->string('delivery_phone')->nullable();
            $table->string('delivery_note')->nullable();
            $table->integer('updated_by')->nullable();
            $table->longText('payment_proof')->nullable(); // bukti pembayaran
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_orders');
    }
};
