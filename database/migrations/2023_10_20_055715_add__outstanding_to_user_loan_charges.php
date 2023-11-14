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
        Schema::table('user_loan_charges', function (Blueprint $table) {
            $table->integer('Outstanding')->nullable()->after('fed');
            $table->date('Paid_date')->nullable()->after('Outstanding');
            $table->integer('Amount_disperse')->nullable()->after('Paid_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_loan_charges', function (Blueprint $table) {
            $table->dropColumn('Outstanding');
            $table->dropColumn('Paid_date');
            $table->dropColumn('Amount_disperse');
            
        });
    }
};
