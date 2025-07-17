<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Agendamento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #333;
        }
        form label {
            display: block;
            margin-bottom: 10px;
        }
        input, select, button {
            padding: 8px;
            margin-top: 5px;
            width: 100%;
            box-sizing: border-box;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            font-weight: bold;
            cursor: pointer;
            margin-top: 15px;
        }
        .success {
            color: green;
            margin-bottom: 15px;
        }
        .error {
            color: red;
            font-size: 0.9em;
            margin-top: 3px;
        }
    </style>
</head>
<body>
    <h1>Agendar Serviço</h1>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('appointment.store') }}" method="POST">
        @csrf

        <label>Nome:
            <input type="text" name="client_name" value="{{ old('client_name') }}" required />
            @error('client_name')<div class="error">{{ $message }}</div>@enderror
        </label>

        <label>Email:
            <input type="email" name="client_email" value="{{ old('client_email') }}" required />
            @error('client_email')<div class="error">{{ $message }}</div>@enderror
        </label>

        <label>Serviço:
            <select name="service_id" required>
                <option value="">Selecione um serviço</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                        {{ $service->name }} - R$ {{ number_format($service->price, 2, ',', '.') }}
                    </option>
                @endforeach
            </select>
            @error('service_id')<div class="error">{{ $message }}</div>@enderror
        </label>

        <label>Data:
            <input type="date" name="date" value="{{ old('date') }}" required />
            @error('date')<div class="error">{{ $message }}</div>@enderror
        </label>

        <label>Hora:
            <input type="time" name="time" value="{{ old('time') }}" required />
            @error('time')<div class="error">{{ $message }}</div>@enderror
        </label>

        <button type="submit">Agendar</button>
    </form>
</body>
</html>
