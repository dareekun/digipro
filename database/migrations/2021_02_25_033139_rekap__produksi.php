<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RekapProduksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekap_prod', function (Blueprint $table) {
            $table->id();
            $table->string('keyid');
            $table->string('tipe');
            $table->string('start');
            $table->string('stop');
            $table->integer('dur');
            $table->string('ttlprod');
            $table->string('prodorg');
            $table->string('standart');
            $table->string('actual');
            $table->string('percentage');
            $table->string('ttlperc');
            $table->string('kaporg');
            $table->string('petugas');
            $table->string('status');
            $table->string('lastedit');
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
