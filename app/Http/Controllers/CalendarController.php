<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamento;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar.index');
    }

    public function getEvents()
    {
        $agendamentos = Agendamento::all();

        $eventos = [];

        foreach ($agendamentos as $agendamento) {
            // Juntando a data e hora para o formato ISO 8601 (ex: 2025-07-21T14:30:00)
            $start = Carbon::parse($agendamento->data . ' ' . $agendamento->horario)->toIso8601String();

            $eventos[] = [
                'title' => $agendamento->servico ?? 'Agendamento',
                'start' => $start,
            ];
        }

        return response()->json($eventos);
    }
}
