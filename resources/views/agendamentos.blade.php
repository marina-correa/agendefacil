<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Agendamentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="mb-4">Agendamentos</h2>

        <table class="table table-bordered bg-white">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>E-mail</th>
                    <th>Serviço</th>
                    <th>Data</th>
                    <th>Hora</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($agendamentos as $a)
                <tr>
                    <td>{{ $a->client_name }}</td>
                    <td>{{ $a->client_email }}</td>
                    <td>{{ $a->service->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($a->date)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($a->time)->format('H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="/" class="btn btn-secondary">Voltar</a>
    </div>
</body>
</html>
