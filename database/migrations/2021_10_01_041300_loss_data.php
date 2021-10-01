<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LossData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loss_data', function (Blueprint $table) {
            $table->id();
            $table->string('keyid');
            $table->string('problem');
            $table->string('start');
            $table->string('stop');
            $table->integer('dur');
            $table->string('tipe');
            $table->string('ket');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
