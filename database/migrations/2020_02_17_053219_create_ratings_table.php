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
            $table->bigInteger('form_sequence_id')->nullable();
            $table->bigInteger('user_id');
            $table->bigInteger('form_id');
            $table->bigInteger('division_id');
            $table->bigInteger('dept_id');
            $table->bigInteger('section_id');
            $table->bigInteger('mfo_id');
            $table->string('function_name');
            $table->mediumText('mfo_desc')->nullable();
            $table->mediumText('success_indicator_desc')->nullable();
            $table->mediumText('actual_accomplishment_desc')->nullable();
            $table->mediumText('remarks')->nullable();
            $table->integer('Q1')->nullable();
            $table->integer('E2')->nullable();
            $table->integer('T3')->nullable();
            $table->decimal('A4', 8, 4)->nullable();
            $table->decimal('core_total_average', 8,4 )->nullable();
            $table->decimal('support_total_average', 8, 4)->nullable();
            $table->decimal('research_total_average', 8, 4)->nullable();
            $table->decimal('ipcr_rating_average', 8, 4)->nullable();
            $table->decimal('clericalroutine', 8, 4)->nullable();
            $table->decimal('technical', 8, 4)->nullable();
            $table->decimal('total_weighted_score', 8, 4)->nullable();
            $table->string('salary_grade')->nullable();
            $table->string('evaluation_startdate');
            $table->string('evaluation_enddate');
            $table->string('ratee_esignature')->nullable();
            $table->string('rater_esignature')->nullable();
            $table->mediumText('ratee_esignature_file')->nullable();
            $table->mediumText('rater_esignature_file')->nullable();
            $table->string('ratee_role')->nullable();
            $table->string('rater_role')->nullable();
            $table->string('remarks_files')->nullable();
            $table->date('ratee_date')->nullable();
            $table->date('rater_date')->nullable();
            $table->mediumText('rater_comments')->nullable();
            $table->string('evaluationform_name')->nullable();
            $table->string('evaluationform_status');
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
