<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Printinglot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lotprint', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('paperid');
            $table->string('barcode');
            $table->date('release');
            $table->boolean('opt1')->default(0);
            $table->boolean('opt2')->default(0);
            $table->boolean('opt3')->default(0);
            $table->boolean('opt4')->default(0);
            $table->boolean('opt5')->default(0);
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
