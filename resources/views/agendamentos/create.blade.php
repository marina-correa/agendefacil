@extends('layouts.app')

@section('title', 'Agendar Serviço')

@section('content')
    <h2 class="text-xl font-bold mb-4">Agendar Serviço</h2>

    {{-- Formulário de agendamento --}}
    <form id="agendamento-form" action="{{ route('agendamentos.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="nome" class="block font-medium">Nome:</label>
            <input type="text" id="nome" name="nome" value="{{ old('nome') }}" required
                class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div>
            <label for="email" class="block font-medium">E-mail:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div>
            <label for="servico_id" class="block font-medium">Serviço:</label>
            <select id="servico_id" name="servico_id" required
                class="w-full border border-gray-300 rounded px-3 py-2">
                <option value="">-- Selecione --</option>
                @foreach($servicos as $servico)
                    <option value="{{ $servico->id }}" {{ old('servico_id') == $servico->id ? 'selected' : '' }}>
                        {{ $servico->name }} - R$ {{ number_format($servico->price, 2, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="data" class="block font-medium">Data:</label>
            <input type="date" id="data" name="data" value="{{ old('data') }}" required
                class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div>
            <label for="horario" class="block font-medium">Horário:</label>
            <input type="time" id="horario" name="horario" value="{{ old('horario') }}" required
                class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Agendar</button>
        </div>
    </form>

    <hr class="my-8">

    <h2 class="text-xl font-bold mb-4 text-center">Calendário de Agendamentos</h2>

    {{-- Calendário menor --}}
    <div id="calendar" style="max-width: 600px; margin: 40px auto; font-size: 14px;"></div>

    <hr class="my-8">

    <h2 class="text-xl font-bold mb-4 text-center">Lista de Agendamentos</h2>

    @if(session('success'))
        <p class="text-green-600 font-semibold mb-4 text-center">{{ session('success') }}</p>
    @endif

    @if($agendamentos->isEmpty())
        <p class="text-center">Nenhum agendamento encontrado.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 rounded">
                <thead>
                    <tr class="bg-blue-600 text-white">
                        <th class="py-2 px-4 border-r border-blue-700 text-left">Nome</th>
                        <th class="py-2 px-4 border-r border-blue-700 text-left">E-mail</th>
                        <th class="py-2 px-4 border-r border-blue-700 text-left">Serviço</th>
                        <th class="py-2 px-4 border-r border-blue-700 text-left">Data</th>
                        <th class="py-2 px-4 border-r border-blue-700 text-left">Horário</th>
                        <th class="py-2 px-4 text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($agendamentos as $agendamento)
                        <tr class="border-t border-gray-300">
                            <td class="py-2 px-4 border-r border-gray-300">{{ $agendamento->nome }}</td>
                            <td class="py-2 px-4 border-r border-gray-300">{{ $agendamento->email }}</td>
                            <td class="py-2 px-4 border-r border-gray-300">{{ $agendamento->service->name ?? 'Serviço não encontrado' }}</td>
                            <td class="py-2 px-4 border-r border-gray-300">{{ \Carbon\Carbon::parse($agendamento->data)->format('d/m/Y') }}</td>
                            <td class="py-2 px-4 border-r border-gray-300">{{ $agendamento->horario }}</td>
                            <td class="py-2 px-4 text-center">
                                <form action="{{ route('agendamentos.destroy', $agendamento->id) }}" method="POST" onsubmit="return confirm('Confirma exclusão?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">
                                        Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    {{-- FullCalendar CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/main.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.8/main.min.css" rel="stylesheet" />

    {{-- FullCalendar JS --}}
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

            const form = document.getElementById('agendamento-form');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

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
                    form.reset();
                    alert(data.message || 'Agendamento realizado com sucesso!');
                    calendar.refetchEvents();
                    // Para atualizar a lista, recarregue a página:
                    location.reload();
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
