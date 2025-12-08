@extends('layouts.app')

@section('title', 'Criar Evento')


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

            <form action="{{ route('events.store') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label for="titulo" class="block text-sm font-medium text-slate-700 mb-1">Título do Evento</label>
                    <input type="text" name="titulo" id="titulo" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition @error('titulo') border-red-500 @enderror" value="{{ old('titulo') }}" required>
                    @error('titulo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="descricao" class="block text-sm font-medium text-slate-700 mb-1">Descrição</label>
                    <textarea name="descricao" id="descricao" rows="5" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition @error('descricao') border-red-500 @enderror" required>{{ old('descricao') }}</textarea>
                    @error('descricao')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="data" class="block text-sm font-medium text-slate-700 mb-1">Data</label>
                        <input type="date" name="data" id="data" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition @error('data') border-red-500 @enderror" value="{{ old('data') }}" required>
                        @error('data')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="hora" class="block text-sm font-medium text-slate-700 mb-1">Hora</label>
                        <input type="time" name="hora" id="hora" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition @error('hora') border-red-500 @enderror" value="{{ old('hora') }}" required>
                        @error('hora')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label for="local" class="block text-sm font-medium text-slate-700 mb-1">Local</label>
                        <input type="text" name="local" id="local" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition @error('local') border-red-500 @enderror" value="{{ old('local') }}" required>
                        @error('local')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="limite_vagas" class="block text-sm font-medium text-slate-700 mb-1">Limite de Vagas</label>
                        <input type="number" name="limite_vagas" id="limite_vagas" min="1" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition @error('limite_vagas') border-red-500 @enderror" value="{{ old('limite_vagas') }}" required>
                        @error('limite_vagas')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
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
