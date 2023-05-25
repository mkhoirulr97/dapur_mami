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
        Schema::table('material_transactions', function (Blueprint $table) {
            $table->integer('total_paid')->default(0)->change();
            $table->integer('total_return')->default(0)->change();
            $table->integer('total_purchase')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('material_transactions', function (Blueprint $table) {
            $table->integer('total_paid')->change();
            $table->integer('total_return')->change();
            $table->integer('total_purchase')->change();
        });
    }
};
