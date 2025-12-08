@extends('layouts.app')

@section('title', 'SISGEA - Meus eventos')


@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Minhas Inscrições</h1>
        <a href="/" class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center">
            Buscar Novos Eventos &rarr;
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        @if(isset($inscricoes) && count($inscricoes) > 0)
            @foreach($inscricoes as $inscricao)
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition duration-300 overflow-hidden border border-slate-100 flex flex-col h-full">
                    <div class="p-6 flex-grow">
                        <div class="flex justify-between items-start mb-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                Confirmado
                            </span>
                            <span class="text-sm text-slate-400">
                                {{ date('d/m/Y', strtotime($inscricao->data)) }}
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2 line-clamp-2">{{ $inscricao->titulo }}</h3>
                        <div class="space-y-2 text-sm text-slate-600 mb-4">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ substr($inscricao->hora, 0, 5) }}
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $inscricao->local }}
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-50 px-6 py-4 border-t border-slate-100 flex justify-between items-center">
                        <a href="{{ route('events.show', $inscricao->id) }}" class="text-indigo-600 hover:text-indigo-800 font-medium text-sm">Ver Detalhes</a>
                        <form action="{{ route('events.cancelar', $inscricao->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja cancelar sua inscrição?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 font-medium text-sm">Cancelar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-span-full text-center py-12">
                <p class="text-slate-500 text-lg">Você ainda não se inscreveu em nenhum evento.</p>
                <a href="/" class="mt-4 inline-block text-indigo-600 hover:text-indigo-800 font-medium">Buscar eventos disponíveis &rarr;</a>
            </div>
        @endif
    </div>
</div>
@endsection
