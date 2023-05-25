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
        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('transaction_details_id');
            $table->foreign('transaction_details_id')->references('id')->on('transaction_details');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // check if column exists
            if (Schema::hasColumn('transactions', 'transaction_details_id')) {
                $table->dropForeign('transactions_transaction_details_id_foreign');
                $table->dropColumn('transaction_details_id');
            }
        });
    }
};
