<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Event Platform') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-slate-50 text-slate-800 flex flex-col min-h-screen">
    <nav class="bg-indigo-600 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="shrink-0 flex items-center">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('images/logo.png') }}" alt="SISGEA" class="h-14 w-auto">
                        </a>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ url('/') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent hover:border-white text-sm font-medium hover:text-indigo-100 transition duration-150 ease-in-out">
                            Home
                        </a>
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center">
                    <div class="relative flex items-center gap-4">
                        <span class="text-sm">Olá, Daniel</span>
                        <form method="POST" action="#">
                            @csrf
                            <button type="submit" class="text-sm bg-indigo-700 hover:bg-indigo-800 px-3 py-1 rounded transition">Logout</button>
                        </form>
                    </div>
                </div>

                <div class="-mr-2 flex items-center sm:hidden">
                    <button type="button" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="inline-flex items-center justify-center p-2 rounded-md text-indigo-200 hover:text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Abrir menu principal</span>
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="hidden sm:hidden" id="mobile-menu">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ url('/') }}" class="bg-indigo-700 text-white block px-3 py-2 rounded-md text-base font-medium">Home / Próximos Eventos</a>
            </div>
            <div class="pt-4 pb-4 border-t border-indigo-700">
                <div class="flex items-center px-4">
                    <div class="ml-3">
                        <div class="text-base font-medium text-white">Usuário Admin</div>
                        <div class="text-sm font-medium text-indigo-200">admin@sisgea.com</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    <a href="/events/create" class="block px-4 py-2 text-base font-medium text-indigo-100 hover:text-white hover:bg-indigo-700">Criar Evento</a>

                    <form method="POST" action="#">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-base font-medium text-indigo-100 hover:text-white hover:bg-indigo-700">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <footer class="bg-slate-800 text-slate-400 py-6 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; {{ date('Y') }} SISGEA. Todos os direitos reservados.</p>
        </div>
    </footer>

</body>
</html>
