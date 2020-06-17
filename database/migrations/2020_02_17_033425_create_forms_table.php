<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('form_type');
            $table->timestamps();
        });

        //default insert of IPCR and OPCR forms
        DB::table('forms')->insert([
            ['id' => 1, 'form_type'=> 'IPCR'],
            ['id'=> 2, 'form_type'=>'OPCR']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forms');
    }
}
