<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestratingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('mfo_id');
            $table->string('function_name');
            $table->integer('average');
            $table->integer('total_weighted_score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('testratings');
    }
}
