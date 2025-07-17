<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgendamentoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aqui estão as rotas web da sua aplicação.
|
*/

// Página inicial opcional
Route::get('/', function () {
    return redirect()->route('agendamentos.create');
});

// Formulário para agendar
Route::get('/agenda', [AgendamentoController::class, 'create'])->name('agendamentos.create');

// Processa o envio do formulário
Route::post('/agendamentos', [AgendamentoController::class, 'store'])->name('agendamentos.store');

// Lista de agendamentos
Route::get('/agendamentos', [AgendamentoController::class, 'index'])->name('agendamentos.index');

// Excluir agendamento
Route::delete('/agendamentos/{id}', [AgendamentoController::class, 'destroy'])->name('agendamentos.destroy');
