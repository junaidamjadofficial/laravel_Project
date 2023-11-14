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
            $table->bigInteger('Trx_id')->nullable()->after('user_loan_id');
            $table->bigInteger('Trx_code')->nullable()->after('Trx_id');
            $table->enum('Trx_response',['paid','unpaid'])->nullable()->after('Trx_code');
                      
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
            $table->dropColumn('Trx_id');
            $table->dropColumn('Trx_code');
            $table->dropColumn('Trx_response');
            
        });
    }
};
