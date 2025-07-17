@extends('layouts.app')

@section('title', 'Agendar Serviço')

@section('content')
    <h2>Agendar Serviço</h2>

    {{-- Mensagem de sucesso --}}
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    {{-- Exibe erros de validação --}}
    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulário de agendamento --}}
    <form action="{{ route('agendamentos.store') }}" method="POST">
        @csrf

        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" value="{{ old('nome') }}" required><br><br>

        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required><br><br>

        <label for="servico_id">Serviço:</label><br>
        <select id="servico_id" name="servico_id" required>
            <option value="">-- Selecione --</option>
            @foreach($servicos as $servico)
                <option value="{{ $servico->id }}" {{ old('servico_id') == $servico->id ? 'selected' : '' }}>
                    {{ $servico->name }} - R$ {{ number_format($servico->price, 2, ',', '.') }}
                </option>
            @endforeach
        </select><br><br>

        <label for="data">Data:</label><br>
        <input type="date" id="data" name="data" value="{{ old('data') }}" required><br><br>

        <label for="horario">Horário:</label><br>
        <input type="time" id="horario" name="horario" value="{{ old('horario') }}" required><br><br>

        <button type="submit">Agendar</button>
    </form>

    <br>
    <a href="{{ route('agendamentos.index') }}" class="button">Ver Agendamentos</a>
@endsection
