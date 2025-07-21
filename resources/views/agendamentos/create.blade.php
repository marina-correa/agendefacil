@extends('layouts.app')

@section('title', 'Agendar Serviço')

@section('content')
    <h2>Agendar Serviço</h2>

    {{-- Formulário de agendamento --}}
    <form id="agendamento-form" action="{{ route('agendamentos.store') }}" method="POST">
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

    <hr>

    <h2>Calendário de Agendamentos</h2>

    <div id="calendar" style="max-width: 900px; margin: 40px auto;"></div>

    {{-- Importa os estilos do FullCalendar --}}
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/main.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.8/main.min.css" rel="stylesheet" />

    {{-- Importa os scripts do FullCalendar --}}
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.8/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/locales/pt-br.global.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'pt-br',
                events: "{{ route('eventos') }}"
            });

            calendar.render();

            // Captura o submit do formulário para enviar via AJAX
            const form = document.getElementById('agendamento-form');

            form.addEventListener('submit', function(e) {
                e.preventDefault(); // previne submit normal

                const formData = new FormData(form);

                fetch("{{ route('agendamentos.store') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) throw response;
                    return response.json();
                })
                .then(data => {
                    // Limpa os campos do formulário
                    form.reset();

                    // Exibe mensagem de sucesso
                    alert(data.message || 'Agendamento realizado com sucesso!');

                    // Recarrega os eventos no calendário
                    calendar.refetchEvents();
                })
                .catch(async errorResponse => {
                    if (errorResponse.json) {
                        const errorData = await errorResponse.json();
                        let errors = errorData.errors || {};
                        let messages = Object.values(errors).flat().join('\n');
                        alert('Erro(s):\n' + messages);
                    } else {
                        alert('Erro ao enviar o formulário.');
                    }
                });
            });
        });
    </script>
@endsection
