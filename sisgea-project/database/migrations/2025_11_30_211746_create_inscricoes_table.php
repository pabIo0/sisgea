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
         Schema::create('inscricoes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('evento_id');

            $table->timestamps();

            // Restrições
            $table->foreign('usuario_id')
                  ->references('id')->on('usuarios')
                  ->onDelete('cascade');

            $table->foreign('evento_id')
                  ->references('id')->on('eventos')
                  ->onDelete('cascade');

            // Evita inscrição duplicada
            $table->unique(['usuario_id', 'evento_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscricoes');
    }
};
