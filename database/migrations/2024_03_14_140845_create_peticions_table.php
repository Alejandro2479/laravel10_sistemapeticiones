<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peticions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('numero_radicado');
            $table->string('asunto');
            $table->text('descripcion');
            $table->string('nota_devolucion')->nullable();
            $table->string('nombre_devolucion')->nullable();
            $table->string('email_devolucion')->nullable();
            $table->boolean('estatus')->default(false);
            $table->timestamps();
            $table->timestamp('fecha_vencimiento')->nullable();
            $table->integer('dias')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peticions');
    }
};
