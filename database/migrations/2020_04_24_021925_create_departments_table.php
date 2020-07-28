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
            $table->bigInteger('division_id')->nullable();
            $table->string('dept_name')->nullable();
            $table->string('type')->nullable();
        });

        //insert departments
        DB::table('departments')->insert([
            ['id' => 1, 'division_id' => 1 , 'dept_name' => 'System Admin', 'type' => 'Admin'],
            ['id' => 2, 'division_id' => 3 , 'dept_name' => 'Electrical and Allied Department', 'type' => 'Teaching'],
            ['id' => 3, 'division_id' => 3 , 'dept_name' => 'Civil and Allied Department', 'type' => 'Teaching'],
            ['id' => 4, 'division_id' => 3 , 'dept_name' => 'Mechanical and Allied Department', 'type' => 'Teaching'],
            ['id' => 5, 'division_id' => 3 , 'dept_name' => 'Bachelors of Engineering Department', 'type' => 'Teaching'],
            ['id' => 6, 'division_id' => 3 , 'dept_name' => 'Basic Arts and Sciences Department (BASD)', 'type' => 'Teaching'],
            ['id' => 7, 'division_id' => 2 , 'dept_name' => 'Campus Director', 'type' => 'Non-Teaching'],
            ['id' => 8, 'division_id' => 3 , 'dept_name' => 'ADAA', 'type' => 'Teaching'],
            ['id' => 9, 'division_id' => 4 , 'dept_name' => 'ADAF', 'type' => 'Non-Teaching'],
            ['id' => 10, 'division_id' => 5 , 'dept_name' => 'ADRE', 'type' => 'Non-Teaching'],
            ['id' => 11, 'division_id' => 4 , 'dept_name' => 'Accounting', 'type' => 'Non-Teaching'],
            ['id' => 12, 'division_id' => 4 , 'dept_name' => 'Budget', 'type' => 'Non-Teaching'],
            ['id' => 13, 'division_id' => 4 , 'dept_name' => 'Cashier', 'type' => 'Non-Teaching'],
            ['id' => 14, 'division_id' => 4 , 'dept_name' => 'IDO', 'type' => 'Non-Teaching'],
            ['id' => 15, 'division_id' => 4 , 'dept_name' => 'Industry Based', 'type' => 'Non-Teaching'],
            ['id' => 16, 'division_id' => 4 , 'dept_name' => 'Medical Service', 'type' => 'Non-Teaching'],
            ['id' => 17, 'division_id' => 4 , 'dept_name' => 'PDO', 'type' => 'Non-Teaching'],
            ['id' => 18, 'division_id' => 4 , 'dept_name' => 'Procurement', 'type' => 'Non-Teaching'],
            ['id' => 19, 'division_id' => 4 , 'dept_name' => 'QAA', 'type' => 'Non-Teaching'],
            ['id' => 20, 'division_id' => 4 , 'dept_name' => 'Records', 'type' => 'Non-Teaching'],
            ['id' => 21, 'division_id' => 4 , 'dept_name' => 'UITC', 'type' => 'Non-Teaching'],
            ['id' => 22, 'division_id' => 3 , 'dept_name' => 'Academics Department', 'type' => 'Teaching'],
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
