<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateEvaluationperiodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluationperiods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('evaluation_startdate');
            $table->date('evaluation_enddate');
            $table->string('evaluation_period_status');
            $table->timestamps();
        });

        DB::table('evaluationperiods')->insert([
            ['id' => 1, 'evaluation_startdate' => '2020-01-01' , 'evaluation_enddate' => '2020-01-31','evaluation_period_status'=> 'Open'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluationperiods');
    }
}
