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
            $table->string('numero_radicado');
            $table->string('asunto');
            $table->text('descripcion');
            $table->string('categoria');
            $table->boolean('estatus')->default(false);
            $table->timestamps();
            $table->timestamp('fecha_vencimiento')->nullable();
            $table->integer('dias')->nullable();
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
