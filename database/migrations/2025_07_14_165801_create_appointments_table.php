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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();                                      // ID do agendamento
            $table->string('client_name');                     // Nome do cliente
            $table->string('client_email')->nullable();        // E-mail (opcional)
            $table->foreignId('service_id')                    // Relaciona com services
                  ->constrained()
                  ->onDelete('cascade');
            $table->date('date');                              // Data do agendamento
            $table->time('time');                              // Hora do agendamento
            $table->timestamps();                              // created_at / updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
