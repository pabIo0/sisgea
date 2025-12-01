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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 255);
            $table->text('descricao');
            $table->date('data');
            $table->time('hora');
            $table->string('local', 255);
            $table->integer('limite_vagas');

            $table->unsignedBigInteger('usuario_id'); // organizador

            $table->timestamps();

            // FK
            $table->foreign('usuario_id')
                  ->references('id')->on('usuarios')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
