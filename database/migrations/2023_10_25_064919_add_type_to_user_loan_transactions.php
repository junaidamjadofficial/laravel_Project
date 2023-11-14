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
        Schema::table('user_loan_transactions', function (Blueprint $table) {
            $table->enum('type',['disbursement','collection','penalty','fed','charges','foh','downpayment','penalty_fed'])->after('amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_loan_transactions', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
