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
            $table->string('id')->primary();
            $table->string('keyid');
            $table->string('tipe');
            $table->string('start');
            $table->string('stop');
            $table->integer('dur');
            $table->integer('daily_plan');
            $table->integer('daily_actual');
            $table->integer('daily_diff');
            $table->integer('ng_process');
            $table->integer('ng_material');
            $table->integer('ng_total');
            $table->string('ket');
            $table->boolean('status')->default(0);
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
