<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sistema de Agendamento')</title>

    @vite('resources/css/app.css') {{-- Isso carrega o Tailwind via Vite --}}
</head>
<body class="bg-gray-100 text-gray-800">

    <header class="bg-blue-600 text-white py-4 text-center shadow-md">
        <h1 class="text-2xl font-semibold">Sistema de Agendamento</h1>
    </header>

    <main class="max-w-3xl mx-auto mt-8 px-4">
        <div class="bg-white rounded-lg shadow p-6">
            @yield('content')
        </div>
    </main>

    <footer class="text-center text-sm text-gray-500 mt-10 py-4 border-t border-gray-300">
        &copy; {{ date('Y') }} Sua Empresa. Todos os direitos reservados.
    </footer>

</body>
</html>
