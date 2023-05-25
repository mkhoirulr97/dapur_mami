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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price');
            $table->integer('category'); // 1: food, 2: drink, 3: other
            $table->text('description')->nullable();
            $table->integer('weight')->nullable();
            $table->unsignedBigInteger('discounts_id')->nullable();
            $table->integer('active')->default(1); // 1: active, 0: non active
            $table->timestamps();

            $table->foreign('discounts_id')->references('id')->on('discounts');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
