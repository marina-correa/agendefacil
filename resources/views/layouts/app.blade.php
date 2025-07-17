<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'Sistema de Agendamento')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
            background-color: #f4f4f4;
        }
        header {
            background-color: #007BFF;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        footer {
            text-align: center;
            font-size: 14px;
            color: #555;
            margin-top: 40px;
            padding: 10px 0;
            border-top: 1px solid #ddd;
        }
        .content {
            background: white;
            padding: 20px;
            border-radius: 8px;
        }
        a.button {
            display: inline-block;
            padding: 8px 15px;
            background: #28a745;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            margin-bottom: 20px;
        }
        a.button.red {
            background: #dc3545;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background: #007BFF;
            color: white;
        }
        button.delete-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <h1>Sistema de Agendamento</h1>
    </header>

    <div class="content">
        @yield('content')
    </div>

    <footer>
        &copy; {{ date('Y') }} Sua Empresa
    </footer>
</body>
</html>
