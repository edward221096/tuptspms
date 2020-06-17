<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('division_id');
            $table->bigInteger('dept_id');
            $table->bigInteger('section_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('role');
            $table->string('status')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        //insert users
        DB::table('users')->insert([
            ['id' => 1, 'division_id' => 1, 'dept_id' => 1, 'section_id' => 1,
                'name' => 'Super Admin', 'email' => 'superadmin@email.com',
                'username' => 'superadmin', 'role' => 'Super Admin',
                'status' => 'Account Approved', 'password' => bcrypt('p@ssw0rd')],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
