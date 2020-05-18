<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_order', function (Blueprint $table) {

            $table->unsignedBigInteger('credit_id')->nullable();
            $table->foreign('credit_id')->references('credit_id')->on('credit');

            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id')->references('order_id')->on('orders');

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
        Schema::dropIfExists('credit_order');
    }
}
