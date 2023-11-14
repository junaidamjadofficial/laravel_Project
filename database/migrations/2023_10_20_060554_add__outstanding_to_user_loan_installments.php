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
        Schema::table('user_loan_installments', function (Blueprint $table) {
            $table->integer('Outstanding')->nullable()->after('amount');
            $table->enum('Status',[0,1])->nullable()->after('Outstanding');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_loan_installments', function (Blueprint $table) {
            $table->dropColumn('Outstanding');
            $table->dropColumn('Status');
        });
    }
};
