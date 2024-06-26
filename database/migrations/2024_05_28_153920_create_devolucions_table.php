<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('devolucions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('peticion_id');
            $table->unsignedBigInteger('user_id');
            $table->text('razon')->nullable();
            $table->boolean('estatus')->default(false);
            $table->timestamps();
            $table->text('nombre_reasignado')->nullable();
            $table->text('email_reasignado')->nullable();

            $table->foreign('peticion_id')->references('id')->on('peticions')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devoluciones');
    }
};
