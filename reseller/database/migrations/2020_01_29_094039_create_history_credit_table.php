<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryCreditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_credit', function (Blueprint $table) {
            $table->bigIncrements('hiscredit_id');
            $table->double('topup', 8, 2)->nullable();
            $table->double('pay', 8, 2)->nullable();
            $table->double('change', 8, 2)->nullable();
            $table->string('create_by')->nullable();
            $table->enum('typeCreate', ['ADD', 'USED', 'CHENGE'])->nullable();
            $table->unsignedBigInteger('credit_id')->nullable();
            $table->foreign('credit_id')->references('credit_id')->on('credit')->onDelete('cascade');
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
        Schema::dropIfExists('history_credit');
    }
}
