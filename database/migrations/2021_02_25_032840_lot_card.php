<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LotCard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lotcard', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('barcode');
            $table->string('keyid');
            $table->string('modelno');
            $table->string('lotno');
            $table->string('shift');
            $table->string('partname');
            $table->string('nolot');
            $table->ineteger('input1')->nullable();
            $table->ineteger('input2')->nullable();
            $table->ineteger('ng1')->nullable();
            $table->ineteger('ng2')->nullable();
            $table->string('input1');
            $table->string('input2');
            $table->string('input1');
            $table->string('input2');
            $table->ineteger('status');
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
