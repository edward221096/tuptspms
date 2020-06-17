<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('division_id');
            $table->string('dept_name');
        });

        //insert departments
        DB::table('departments')->insert([
            ['id' => 1, 'division_id' => 1 , 'dept_name' => 'System Admin'],
            ['id' => 2, 'division_id' => 2 , 'dept_name' => 'Electrical and Allied Department'],
            ['id' => 3, 'division_id' => 2 , 'dept_name' => 'Civil and Allied Department'],
            ['id' => 4, 'division_id' => 2 , 'dept_name' => 'Mechanical and Allied Department'],
            ['id' => 5, 'division_id' => 2 , 'dept_name' => 'Bachelors of Engineering Department'],
            ['id' => 6, 'division_id' => 2 , 'dept_name' => 'Basic Arts and Sciences Department (BASD)'],
            ['id' => 7, 'division_id' => 3 , 'dept_name' => 'Planning Department'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
