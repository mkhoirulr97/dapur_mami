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
        Schema::create('discount_menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('discounts_id');
            $table->unsignedBigInteger('menus_id');

            $table->foreign('discounts_id')->references('id')->on('discounts');
            $table->foreign('menus_id')->references('id')->on('menus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_menus');
    }
};
