<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\CalendarController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Aqui estão as rotas web da sua aplicação.
*/

// Página inicial (redireciona para o formulário de agendamento + lista)
Route::get('/', function () {
    return redirect()->route('agendamentos.create');
});

// Formulário para criar agendamento, calendário e lista de agendamentos na mesma página
Route::get('/agenda', [AgendamentoController::class, 'create'])->name('agendamentos.create');

// Processa o envio do formulário de agendamento
Route::post('/agendamentos', [AgendamentoController::class, 'store'])->name('agendamentos.store');

// Excluir agendamento
Route::delete('/agendamentos/{id}', [AgendamentoController::class, 'destroy'])->name('agendamentos.destroy');

// Rota que retorna os eventos JSON para o calendário
Route::get('/eventos', [CalendarController::class, 'getEvents'])->name('eventos');

// Rota de teste para listar todos os emails dos usuários com indicação se são admin ou não
Route::get('/teste-admin', function () {
    $users = User::all();
    if ($users->isEmpty()) {
        return 'Nenhum usuário cadastrado.';
    }
    $result = '';
    foreach ($users as $user) {
        $result .= $user->email . ' - ' . ($user->is_admin ? 'Admin' : 'Usuário') . '<br>';
    }
    return $result;
});

// Rota simples para teste se o Laravel está funcionando
Route::get('/teste', function () {
    return 'Teste OK';
});
