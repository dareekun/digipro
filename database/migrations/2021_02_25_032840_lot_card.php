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
            $table->string('modelno');
            $table->string('lotno'); 
            $table->string('tempat'); 
            $table->string('partname');
            $table->string('nolot');
            $table->integer('input1')->nullable();
            $table->integer('input2')->nullable();
            $table->integer('ng1')->nullable();
            $table->integer('ng2')->nullable();
            $table->string('date1');
            $table->string('date2');
            $table->string('name1');
            $table->string('name2');
            $table->boolean('status')->default(0);
            $table->boolean('opt1')->default(0);
            $table->boolean('opt2')->default(0);
            $table->boolean('opt3')->default(0);
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
