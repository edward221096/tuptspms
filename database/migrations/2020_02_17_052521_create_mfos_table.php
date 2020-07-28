<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mfos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('function_id')->nullable()->unsigned();
            $table->bigInteger('dept_id')->nullable()->unsigned();
            $table->bigInteger('form_id')->unsigned();
            $table->mediumText('mfo_desc')->nullable();
            $table->string('role')->nullable();
            $table->mediumText('success_indicator_desc')->nullable();
            $table->mediumText('actual_accomplishment_desc')->nullable();
            $table->mediumText('alloted_budget')->nullable();
            $table->mediumText('persons_accountable')->nullable();
            $table->mediumText('remarks')->nullable();
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
        Schema::dropIfExists('mfos');
    }
}
