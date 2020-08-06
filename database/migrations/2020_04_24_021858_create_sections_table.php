<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('dept_id');
            $table->string('section_name');
            $table->timestamps();
        });

        //insert departments
        DB::table('sections')->insert([
            ['id' => 1, 'dept_id'=> 1, 'section_name' => 'System Admin'],
            ['id' => 2, 'dept_id'=> 2, 'section_name' => 'Computer Engineering Technology'],
            ['id' => 3, 'dept_id'=> 2, 'section_name' => 'Electronics Engineering Technology'],
            ['id' => 4, 'dept_id'=> 2, 'section_name' => 'Electrical Engineering Technology'],
            ['id' => 5, 'dept_id'=> 2, 'section_name' => 'Instrumentation and Control Engineering Technology'],
            ['id' => 6, 'dept_id'=> 3, 'section_name' => 'Civil Engineering Technology'],
            ['id' => 7, 'dept_id'=> 3, 'section_name' => 'Chemical Engineering Technology'],
            ['id' => 8, 'dept_id'=> 3, 'section_name' => 'Architecture Technology'],
            ['id' => 9, 'dept_id'=> 4, 'section_name' => 'Mechanical Engineering Technology'],
            ['id' => 10, 'dept_id'=> 4, 'section_name' => 'Electromechanical Engineering Technology'],
            ['id' => 11, 'dept_id'=> 4, 'section_name' => 'Automotive Engineering Technology'],
            ['id' => 12, 'dept_id'=> 4, 'section_name' => 'Mechanical and Tool Engineering Technology'],
            ['id' => 13, 'dept_id'=> 4, 'section_name' => 'Non-Destructive Testing Engineering Technology'],
            ['id' => 14, 'dept_id'=> 4, 'section_name' => 'Refrigeration and Airconditioning Engineering Technology'],
            ['id' => 15, 'dept_id'=> 5, 'section_name' => 'Bachelor of Engineering'],
            ['id' => 16, 'dept_id' => 7, 'section_name' => 'Campus Director'],
            ['id' => 17, 'dept_id' => 8, 'section_name' => 'ADAA'],
            ['id' => 18, 'dept_id' => 9, 'section_name' => 'ADAF'],
            ['id' => 19, 'dept_id' => 10, 'section_name' => 'ADRE'],
            ['id' => 20, 'dept_id'=> 11,  'section_name' => 'Accounting'],
            ['id' => 21, 'dept_id'=> 12 , 'section_name' => 'Budget'],
            ['id' => 22, 'dept_id'=> 13 , 'section_name' => 'Cashier'],
            ['id' => 23, 'dept_id'=> 14 , 'section_name' => 'IDO'],
            ['id' => 24, 'dept_id'=> 15 , 'section_name' => 'Industry Based'],
            ['id' => 25, 'dept_id'=> 16 , 'section_name' => 'Medical Service'],
            ['id' => 26, 'dept_id'=> 17 , 'section_name' => 'PDO'],
            ['id' => 27, 'dept_id'=> 18 , 'section_name' => 'Procurement'],
            ['id' => 28, 'dept_id'=> 19 , 'section_name' => 'QAA'],
            ['id' => 29, 'dept_id'=> 20 , 'section_name' => 'Records'],
            ['id' => 30, 'dept_id'=> 21 , 'section_name' => 'UITC'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections');
    }
}
