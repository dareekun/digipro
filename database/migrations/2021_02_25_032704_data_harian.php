<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DataHarian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataharian', function (Blueprint $table) {
            $table->id();
            $table->string('keyid');
            $table->string('line');
            $table->string('bagian');
            $table->date('tanggal');
            $table->string('shift');
            $table->string('pic');
            $table->integer('kartap');
            $table->integer('absenkartap');
            $table->integer('waktukartap');
            $table->integer('otkartap');
            $table->integer('kwt');
            $table->integer('absenkwt');
            $table->integer('waktukwt');
            $table->integer('otkwt');
            $table->integer('izin');
            $table->integer('optplan');
            $table->string('start');
            $table->string('finish');
            $table->integer('waktukerja');
            $table->string('lastedit');
            $table->string('autosave');
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
