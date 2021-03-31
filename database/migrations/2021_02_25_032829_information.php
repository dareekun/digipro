<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Information extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problem_loss_ability', function (Blueprint $table) {
            $table->string('tanda')->primary();
            $table->string('info1');
            $table->string('info2');
            $table->string('info3');
            $table->string('info4');
            $table->string('info5');
            $table->string('info6');
            $table->string('info7');
            $table->string('info8');
            $table->string('info9');
            $table->string('info10');
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
