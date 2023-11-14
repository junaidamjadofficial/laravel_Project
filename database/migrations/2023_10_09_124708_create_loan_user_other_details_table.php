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
        Schema::create('loan_user_other_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('loan_user_id')->unsigned()->nullable();
            $table->string('Owner_address')->nullable();
            $table->date('dob')->nullable();
            $table->date('cnic_issuance_date')->nullable();
            $table->string('father_name')->nullable();
            $table->string('Mother_name')->nullable();
            $table->string('consumer_type')->nullable();
            $table->string('remarks')->nullable();
            $table->foreign('loan_user_id')->references('id')->on('loan_users')->onDelete('cascade');
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
        Schema::dropIfExists('loan_user_other_details');
    }
};
