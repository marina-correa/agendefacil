<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Serviço</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="mb-4">Cadastrar Novo Serviço</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('servicos.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nome do Serviço:</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Preço (R$):</label>
                <input type="number" step="0.01" name="price" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="/" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</body>
</html>
