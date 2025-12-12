@extends('layouts.app')

@section('title', 'SISGEA - Eventos Excluídos')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Eventos Excluídos</h1>
                <p class="text-slate-500 mt-2">Eventos que foram excluídos e podem ser restaurados</p>
            </div>
            <a href="{{ route('dashboard.organizer') }}"
                class="bg-slate-600 hover:bg-slate-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Voltar para Meus Eventos
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-slate-100">
            {{-- Desktop Table --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                Evento</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                Data/Hora</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                Local</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                Excluído em</th>
                            <th scope="col"
                                class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">
                                Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @foreach ($eventosExcluidos as $evento)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-slate-900">{{ $evento->titulo }}</div>
                                    <div class="text-xs text-slate-400 mt-1 line-clamp-2">{{ Str::limit($evento->descricao, 50) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-slate-500">{{ date('d/m/Y', strtotime($evento->data)) }}</div>
                                    <div class="text-sm text-slate-400">{{ substr($evento->hora, 0, 5) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-slate-500">{{ $evento->local }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-slate-500">{{ date('d/m/Y H:i', strtotime($evento->deleted_at)) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <form action="{{ route('events.restaurar', $evento->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Tem certeza que deseja restaurar este evento?');">
                                        @csrf
                                        <button type="submit"
                                            class="text-green-600 hover:text-green-900 font-medium">Restaurar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Mobile Cards --}}
            <div class="md:hidden">
                @foreach ($eventosExcluidos as $evento)
                    <div class="p-4 border-b border-slate-100 last:border-b-0 space-y-3">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-bold text-slate-900">{{ $evento->titulo }}</h3>
                                <p class="text-xs text-slate-400 mt-1">{{ Str::limit($evento->descricao, 60) }}</p>
                            </div>
                        </div>

                        <div class="text-sm text-slate-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ $evento->local }}
                        </div>

                        <div class="text-sm text-slate-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ substr($evento->hora, 0, 5) }} - {{ date('d/m/Y', strtotime($evento->data)) }}
                        </div>

                        <div class="text-xs text-slate-500">
                            Excluído em: {{ date('d/m/Y H:i', strtotime($evento->deleted_at)) }}
                        </div>

                        <div class="flex justify-end pt-2 mt-2 border-t border-slate-50">
                            <form action="{{ route('events.restaurar', $evento->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Tem certeza que deseja restaurar este evento?');">
                                @csrf
                                <button type="submit"
                                    class="text-sm font-medium text-green-600 hover:text-green-800">Restaurar Evento</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($eventosExcluidos->isEmpty())
                <div class="p-8 text-center text-gray-500">
                    <svg class="w-16 h-16 mx-auto text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <p class="text-lg font-medium text-slate-600">Nenhum evento excluído</p>
                    <p class="text-sm text-slate-400 mt-1">Eventos excluídos aparecerão aqui e poderão ser restaurados</p>
                </div>
            @endif
        </div>
    </div>
@endsection

