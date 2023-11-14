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
        Schema::create('user_loan_charges', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_loan_id')->unsigned()->nullable();
            $table->bigInteger('loan_plan_id')->unsigned()->nullable();
            $table->integer('charges_amount')->nullable();
            $table->integer('fed')->nullable();

            $table->foreign('loan_plan_id')->references('id')->on('loan_plan')->onDelete('set null');
            $table->foreign('user_loan_id')->references('id')->on('user_loans')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_loan_charges');
    }
};
