<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->bigInteger('form_id');
            $table->bigInteger('dept_id');
            $table->bigInteger('mfo_id');
            $table->bigInteger('function_id');
            $table->decimal('Q1');
            $table->decimal('E2');
            $table->decimal('T3');
            $table->decimal('A4');
            $table->string('remarks_files');
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
        Schema::dropIfExists('ratings');
    }
}
