<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateDivisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('divisions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('division_name');
            $table->timestamps();
        });

        //insert divisions
        DB::table('divisions')->insert([
            ['id' => 1, 'division_name' => 'System Admin'],
            ['id' => 2, 'division_name' => 'Campus Director Division'],
            ['id' => 3, 'division_name' => 'Assistant Director for Academic Affairs'],
            ['id' => 4, 'division_name' => 'Assistant Director for Administrative and Finance'],
            ['id' => 5, 'division_name' => 'Assistant Director for Research and Extension'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('divisions');
    }
}
