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
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('contraseña'),
            'role' => 'admin',
        ]);

        DB::table('users')->insert([
            'name' => 'usuario1',
            'email' => 'usuario1@test.com',
            'password' => bcrypt('contraseña'),
            'role' => 'user',
        ]);

        DB::table('users')->insert([
            'name' => 'usuario2',
            'email' => 'usuario2@test.com',
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
