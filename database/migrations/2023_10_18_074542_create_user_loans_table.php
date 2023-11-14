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
        Schema::create('user_loans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('loan_plan_id')->unsigned()->nullable();
            $table->string('phone_no')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('status')->nullable();

                $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('loan_plan_id')->references('id')->on('loan_plan')->onDelete('set null');
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
        Schema::dropIfExists('user_loans');
    }
};
