@extends('layouts.app')


@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-16">
            <h1 class="text-4xl font-extrabold text-slate-900 sm:text-5xl tracking-tight">
                Próximos Eventos
            </h1>
            <p class="mt-4 text-xl text-slate-500 max-w-2xl mx-auto">
                Confira os eventos disponíveis e garanta sua vaga agora mesmo.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($eventos as $evento)
                <div
                    class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-shadow duration-300 border border-slate-100 flex flex-col h-full overflow-hidden group relative">

                    {{-- Badge de Lotado --}}
                    @if ($evento->estaLotado())
                        <div
                            class="absolute top-0 right-0 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-bl-lg z-10">
                            ESGOTADO
                        </div>
                    @endif

                    <div class="p-6 flex-grow">
                        <div class="flex justify-between items-start mb-4">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700 border border-indigo-100">
                                Evento
                            </span>
                            <span class="text-sm text-slate-400 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                {{ date('d/m/Y', strtotime($evento->data)) }}
                            </span>
                        </div>

                        <h3
                            class="text-xl font-bold text-slate-900 mb-3 line-clamp-2 group-hover:text-indigo-600 transition-colors">
                            {{ $evento->titulo }}
                        </h3>

                        <div class="space-y-3 text-sm text-slate-600">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-indigo-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ substr($evento->hora, 0, 5) }}
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-indigo-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="truncate">{{ $evento->local }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-indigo-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z">
                                    </path>
                                </svg>
                                @if ($evento->estaLotado())
                                    Vagas Esgotadas
                                @else
                                    {{ $evento->vagasDisponiveis() }} vagas restantes
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-50 px-6 py-4 border-t border-slate-100">
                        <a href="{{ route('events.show', $evento->id) }}"
                            class="block w-full text-center bg-white border border-indigo-600 text-indigo-600 hover:bg-indigo-600 hover:text-white font-bold py-2.5 rounded-xl transition-all duration-200 shadow-sm hover:shadow">
                            Ver Detalhes
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($eventos->isEmpty())
            <div class="text-center py-12">
                <p class="text-slate-500 text-lg">Nenhum evento encontrado no momento.</p>
            </div>
        @endif
    </div>
@endsection
