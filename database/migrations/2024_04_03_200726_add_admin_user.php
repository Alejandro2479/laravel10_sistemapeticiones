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
            'role' => 'admin',
        ]);

        DB::table('users')->insert([
            'name' => 'Pepe Otalvaro',
            'username' => 'usuario1',
            'email' => 'usuario1@test.com',
            'password' => bcrypt('contraseña'),
            'role' => 'user',
        ]);

        DB::table('users')->insert([
            'name' => 'Pepe Murillo',
            'username' => 'usuario2',
            'email' => 'usuario2@test.com',
            'password' => bcrypt('contraseña'),
            'role' => 'user',
        ]);

        DB::table('users')->insert([
            'name' => 'Pepe Urbanski',
            'username' => 'usuario3',
            'email' => 'usuario3@test.com',
            'password' => bcrypt('contraseña'),
            'role' => 'user',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Eliminar el usuario administrador si es necesario revertir la migración
        DB::table('users')->where('email', 'admin@test.com')->delete();
    }
}
