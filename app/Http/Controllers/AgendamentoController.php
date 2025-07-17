<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Agendamento;

class AgendamentoController extends Controller
{
    // Exibe o formulário de agendamento
    public function create()
    {
        $servicos = Service::all();
        return view('agendamentos.create', compact('servicos'));
    }

    // Salva o agendamento no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'email' => 'required|email',
            'servico_id' => 'required|exists:services,id',
            'data' => 'required|date',
            'horario' => 'required'
        ]);

        Agendamento::create($request->all());

        return redirect()->route('agendamentos.create')->with('success', 'Agendamento realizado com sucesso!');
    }

    // Lista todos os agendamentos
    public function index()
    {
        $agendamentos = Agendamento::with('service')->orderBy('data', 'asc')->get();

        return view('agendamentos.index', compact('agendamentos'));
    }

    // Exclui um agendamento
    public function destroy($id)
    {
        $agendamento = Agendamento::findOrFail($id);
        $agendamento->delete();

        return redirect()->route('agendamentos.index')->with('success', 'Agendamento excluído com sucesso!');
    }
}
