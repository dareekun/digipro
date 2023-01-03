<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('model_no');
            $table->string('line');
            $table->string('section');
            $table->string('market')->default('domestic');
            $table->integer('packing')->default(0);
            $table->decimal('time', $precision = 8, $scale = 2);
            $table->integer('std_mp');
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
