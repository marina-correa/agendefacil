@extends('layouts.app')

@section('title', 'Lista de Agendamentos')

@section('content')
    <h2>Agendamentos</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if($agendamentos->isEmpty())
        <p>Nenhum agendamento encontrado.</p>
    @else
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Serviço</th>
                    <th>Data</th>
                    <th>Horário</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($agendamentos as $agendamento)
                    <tr>
                        <td>{{ $agendamento->nome }}</td>
                        <td>{{ $agendamento->email }}</td>
                        <td>{{ $agendamento->service->name ?? 'Serviço não encontrado' }}</td>
                        <td>{{ \Carbon\Carbon::parse($agendamento->data)->format('d/m/Y') }}</td>
                        <td>{{ $agendamento->horario }}</td>
                        <td>
                            <form action="{{ route('agendamentos.destroy', $agendamento->id) }}" method="POST" onsubmit="return confirm('Confirma exclusão?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="color: red;">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <br>
    <a href="{{ route('agendamentos.create') }}">Voltar para o formulário</a>
@endsection
