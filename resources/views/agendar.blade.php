<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Agendar Serviço</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="mb-4">Agendar um Serviço</h2>

        <form action="{{ route('agendar.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="client_name" class="form-label">Seu Nome:</label>
                <input type="text" class="form-control" name="client_name" required>
            </div>

            <div class="mb-3">
                <label for="client_email" class="form-label">Seu E-mail (opcional):</label>
                <input type="email" class="form-control" name="client_email">
            </div>

            <div class="mb-3">
                <label for="service_id" class="form-label">Serviço:</label>
                <select name="service_id" class="form-select" required>
                    <option value="">Selecione</option>
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }} - R$ {{ number_format($service->price, 2, ',', '.') }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Data:</label>
                <input type="date" class="form-control" name="date" required>
            </div>

            <div class="mb-3">
                <label for="time" class="form-label">Hora:</label>
                <input type="time" class="form-control" name="time" required>
            </div>

            <button type="submit" class="btn btn-success">Agendar</button>
        </form>
    </div>
</body>
</html>
