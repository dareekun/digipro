<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HasilMesin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_prod', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('keyid');
            $table->integer('durasi');
            $table->decimal('cycle', $precision = 3, $scale = 2);
            $table->string('detail');
            $table->integer('hasil');
            $table->integer('defect');
            $table->integer('waktu');
            $table->integer('planning');
            $table->integer('eff');
            $table->integer('total');
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
