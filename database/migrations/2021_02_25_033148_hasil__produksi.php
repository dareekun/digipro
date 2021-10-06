<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HasilProduksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_prod', function (Blueprint $table) {
            $table->id();
            $table->string('keyid');
            $table->string('inti1');
            $table->string('analisa1');
            $table->string('tindakan1');
            $table->integer('hasil');
            $table->integer('avalaible');
            $table->decimal('phh', $precision = 8, $scale = 2);
            $table->string('inti2');
            $table->string('analisa2');
            $table->string('tindakan2');
            $table->integer('ttlloss');
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
