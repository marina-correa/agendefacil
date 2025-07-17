<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cria a tabela agendamentos.
     */
    public function up(): void
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email');
            $table->foreignId('servico_id')->constrained('services')->onDelete('cascade');
            $table->date('data');
            $table->time('horario');
            $table->timestamps();
        });
    }

    /**
     * Remove a tabela agendamentos.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendamentos');
    }
};
