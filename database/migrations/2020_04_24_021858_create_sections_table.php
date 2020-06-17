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
            ['id' => 1, 'dept_id'=> 1 , 'section_name' => 'System Admin'],
            ['id' => 2, 'dept_id'=> 2 , 'section_name' => 'Computer Engineering Technology'],
            ['id' => 3, 'dept_id'=> 2 , 'section_name' => 'Electronics Engineering Technology'],
            ['id' => 4, 'dept_id'=> 3 , 'section_name' => 'Civil Engineering Technology'],
            ['id' => 5, 'dept_id'=> 3 , 'section_name' => 'Architecture Technology'],
            ['id' => 6, 'dept_id'=> 4 , 'section_name' => 'Mechanical Engineering Technology'],
            ['id' => 7, 'dept_id'=> 4 , 'section_name' => 'Electro Mechanical Engineering Technology'],
            ['id' => 8, 'dept_id'=> 5 , 'section_name' => 'BASD'],
            ['id' => 9, 'dept_id'=> 6 , 'section_name' => 'Engineering Technology'],
            ['id' => 10, 'dept_id'=> 7 , 'section_name' => 'Planning Section'],
            ['id' => 11, 'dept_id'=> 7 , 'section_name' => 'Finance Section']
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
