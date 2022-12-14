<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Production extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production', function (Blueprint $table) {
            $table->id();
            $table->string('barcode');
            $table->integer('model_no');
            $table->string('lotno');
            $table->date('date');
            $table->integer('shift');
            $table->json('parts_data');
            $table->integer('fg_1')->nullable();
            $table->integer('fg_2')->nullable();
            $table->integer('ng_1')->nullable();
            $table->integer('ng_2')->nullable();
            $table->date('date_1');
            $table->date('date_2');
            $table->string('name_1');
            $table->string('name_2');
            $table->boolean('status')->default(0);
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
