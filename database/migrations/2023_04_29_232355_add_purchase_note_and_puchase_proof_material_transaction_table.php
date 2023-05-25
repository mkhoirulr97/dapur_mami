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
            $table->text('purchase_note')->nullable()->after('suppliers');
            $table->longText('purchase_proof')->nullable()->after('purchase_note');
            $table->date('purchase_date')->nullable()->after('purchase_proof');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('material_transactions', function (Blueprint $table) {
            $table->dropColumn('purchase_note');
            $table->dropColumn('purchase_proof');
            $table->dropColumn('purchase_date');
        });
    }
};
