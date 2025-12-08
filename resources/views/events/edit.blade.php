@extends('layouts.app')

@section('title', 'Editar Evento')


@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('dashboard.organizer') }}" class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center">
            &larr; Voltar
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-8">
            <h2 class="text-2xl font-bold text-slate-800 mb-6">Editar Evento</h2>

            <form action="{{ route('events.update', $evento->id) }}" method="POST">
                @csrf
                @method('PUT') <div class="mb-6">
                    <label for="titulo" class="block text-sm font-medium text-slate-700 mb-1">Título</label>
                    <input type="text" name="titulo" value="{{ old('titulo', $evento->titulo) }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg @error('titulo') border-red-500 @enderror" required>
                    @error('titulo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="descricao" class="block text-sm font-medium text-slate-700 mb-1">Descrição</label>
                    <textarea name="descricao" rows="5" class="w-full px-4 py-2 border border-slate-300 rounded-lg @error('descricao') border-red-500 @enderror" required>{{ old('descricao', $evento->descricao) }}</textarea>
                    @error('descricao')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="data" class="block text-sm font-medium text-slate-700 mb-1">Data</label>
                        <input type="date" name="data" value="{{ old('data', $evento->data) }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg @error('data') border-red-500 @enderror" required>
                        @error('data')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="hora" class="block text-sm font-medium text-slate-700 mb-1">Hora</label>
                        <input type="time" name="hora" value="{{ old('hora', substr($evento->hora, 0, 5)) }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg @error('hora') border-red-500 @enderror" required>
                        @error('hora')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label for="local" class="block text-sm font-medium text-slate-700 mb-1">Local</label>
                        <input type="text" name="local" value="{{ old('local', $evento->local) }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg @error('local') border-red-500 @enderror" required>
                        @error('local')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="limite_vagas" class="block text-sm font-medium text-slate-700 mb-1">Limite de Vagas</label>
                        <input type="number" name="limite_vagas" value="{{ old('limite_vagas', $evento->limite_vagas) }}" min="{{ $evento->inscricoes()->count() }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg @error('limite_vagas') border-red-500 @enderror" required>
                        <p class="text-xs text-slate-500 mt-1">Mínimo permitido: {{ $evento->inscricoes()->count() }} (participantes já inscritos)</p>
                        @error('limite_vagas')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg shadow-md transition duration-200">
                        Atualizar Evento
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
