<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions_d_m_t1', function (Blueprint $table) {
            $table->decimal('opening_balance', 10, 2)->nullable()->after('response_data');
            $table->decimal('closing_balance', 10, 2)->nullable()->after('opening_balance');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions_d_m_t1', function (Blueprint $table) {
            $table->dropColumn(['opening_balance', 'closing_balance']);
        });
    }
};
