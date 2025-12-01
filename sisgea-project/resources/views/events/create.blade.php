@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <a href="{{ url('/') }}" class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center">
            &larr; Voltar
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-8">
            <h2 class="text-2xl font-bold text-slate-800 mb-6">Criar Novo Evento</h2>

            <form action="#" method="POST">
                @csrf

                <div class="mb-6">
                    <label for="titulo" class="block text-sm font-medium text-slate-700 mb-1">Título do Evento</label>
                    <input type="text" name="titulo" id="titulo" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" required>
                </div>

                <div class="mb-6">
                    <label for="descricao" class="block text-sm font-medium text-slate-700 mb-1">Descrição</label>
                    <textarea name="descricao" id="descricao" rows="5" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" required></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="data" class="block text-sm font-medium text-slate-700 mb-1">Data</label>
                        <input type="date" name="data" id="data" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" required>
                    </div>
                    <div>
                        <label for="hora" class="block text-sm font-medium text-slate-700 mb-1">Hora</label>
                        <input type="time" name="hora" id="hora" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label for="local" class="block text-sm font-medium text-slate-700 mb-1">Local</label>
                        <input type="text" name="local" id="local" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" required>
                    </div>
                    <div>
                        <label for="limite_vagas" class="block text-sm font-medium text-slate-700 mb-1">Limite de Vagas</label>
                        <input type="number" name="limite_vagas" id="limite_vagas" min="1" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" required>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg shadow-md transition duration-200">
                        Salvar Evento
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
