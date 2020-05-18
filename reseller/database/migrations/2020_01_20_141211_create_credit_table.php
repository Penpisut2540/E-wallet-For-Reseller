<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit', function (Blueprint $table) {
            $table->bigIncrements('credit_id');
            $table->double('before', 8, 2)->nullable()->default('0.00');
            $table->double('current', 8, 2)->nullable()->default('0.00');
            $table->double('after', 8, 2)->nullable()->default('0.00');
            $table->string('create_by')->nullable();
            $table->string('update_by')->nullable();
            $table->enum('typeCreate',['ADD','USED','CHENGE'])->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('credit');
    }
}
