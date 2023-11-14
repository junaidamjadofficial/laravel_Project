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
        Schema::create('loan_user_shop_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('loan_user_id')->unsigned()->nullable();
            $table->string('shop_name')->nullable();
            $table->string('shop_address')->unique()->nullable();
            $table->double('shop_length',8,2)->default(12);
            $table->double('shop_width',8,2)->default(12);
            $table->string('pop_code')->nullable();
            $table->enum('shop_status',['Rent','Own']);
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
        Schema::dropIfExists('loan_user_shop_details');
    }
};
