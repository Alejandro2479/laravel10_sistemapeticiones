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
        Schema::create('peticion_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('peticion_id');
            $table->unsignedBigInteger('user_id');
            $table->boolean('completado')->default(false);
            $table->text('resumen')->nullable();
            $table->timestamps();

            $table->foreign('peticion_id')->references('id')->on('peticions')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peticion_user');
    }
};
