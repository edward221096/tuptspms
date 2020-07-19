<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateFunctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('functions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('function_name');
            $table->timestamps();
        });

        DB::table('functions')->insert([
            ['id' => 1, 'function_name' => 'Core Administrative Functions'],
            ['id' => 2, 'function_name' => 'Core Administrative Functions - Clerical/Routine'],
            ['id' => 3, 'function_name' => 'Core Administrative Functions - Technical'],
            ['id'=> 4, 'function_name'=> 'Support Functions'],
            ['id'=> 5, 'function_name'=> 'Higher and Advanced Education Program'],
            ['id'=> 6, 'function_name'=> 'Research Program'],
            ['id'=> 7, 'function_name'=> 'Technical Advisory Extension Program']
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('functions');
    }
}
