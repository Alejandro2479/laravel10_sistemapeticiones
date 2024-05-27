<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddAdminUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->insert([
            'name' => 'Alejandro Otalvaro',
            'username' => 'admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('contraseña'),
            'rol' => 'admin',
        ]);

        DB::table('users')->insert([
            'name' => 'Pepe Otalvaro',
            'username' => 'usuario1',
            'email' => 'usuario1@test.com',
            'password' => bcrypt('contraseña'),
            'rol' => 'user',
        ]);

        DB::table('users')->insert([
            'name' => 'Pepe Murillo',
            'username' => 'usuario2',
            'email' => 'usuario2@test.com',
            'password' => bcrypt('contraseña'),
            'rol' => 'user',
        ]);

        DB::table('users')->insert([
            'name' => 'Pepe Urbanski',
            'username' => 'usuario3',
            'email' => 'usuario3@test.com',
            'password' => bcrypt('contraseña'),
            'rol' => 'user',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('users')->where('email', 'admin@test.com')->delete();
    }
}
