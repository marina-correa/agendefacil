@extends('layouts.app')

@section('title', 'Lista de Agendamentos')

@section('content')
    <h2 class="text-xl font-bold mb-4">Agendamentos</h2>

    @if(session('success'))
        <p style="color: green; margin-bottom: 20px;">{{ session('success') }}</p>
    @endif

    @if($agendamentos->isEmpty())
        <p>Nenhum agendamento encontrado.</p>
    @else
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <thead>
                <tr style="background-color: #007BFF; color: white;">
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Nome</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">E-mail</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Serviço</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Data</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Horário</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: center;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($agendamentos as $agendamento)
                    <tr style="border-bottom: 1px solid #ddd;">
                        <td style="padding: 8px;">{{ $agendamento->nome }}</td>
                        <td style="padding: 8px;">{{ $agendamento->email }}</td>
                        <td style="padding: 8px;">{{ $agendamento->service->name ?? 'Serviço não encontrado' }}</td>
                        <td style="padding: 8px;">{{ \Carbon\Carbon::parse($agendamento->data)->format('d/m/Y') }}</td>
                        <td style="padding: 8px;">{{ $agendamento->horario }}</td>
                        <td style="padding: 8px; text-align: center;">
                            <form action="{{ route('agendamentos.destroy', $agendamento->id) }}" method="POST" onsubmit="return confirm('Confirma exclusão?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('agendamentos.create') }}" style="display: inline-block; padding: 8px 15px; background-color: #007BFF; color: white; border-radius: 5px; text-decoration: none;">
        Voltar para o formulário
    </a>
@endsection
