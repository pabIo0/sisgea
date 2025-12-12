@extends('layouts.app')

@section('title', 'SISGEA - Meus eventos')


@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-slate-900">Meus Eventos Criados</h1>
            <div class="flex gap-3">
                <a href="{{ route('events.excluidos') }}"
                    class="bg-slate-500 hover:bg-slate-600 text-white font-bold py-2 px-6 rounded-lg shadow-md transition duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                    Eventos Excluídos
                </a>
                <a href="{{ route('events.create') }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Criar Novo Evento
                </a>
            </div>
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
                                Inscritos</th>
                            <th scope="col"
                                class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">
                                Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @foreach ($eventos as $evento)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-slate-900">{{ $evento->titulo }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-slate-500">{{ date('d/m/Y', strtotime($evento->data)) }}</div>
                                    <div class="text-sm text-slate-400">{{ substr($evento->hora, 0, 5) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-slate-500">{{ $evento->local }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                        {{ $evento->totalInscricoes() }} / {{ $evento->limite_vagas }}
                                    </span>
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end gap-3">
                                    <a href="{{ route('events.inscritos', $evento->id) }}"
                                        class="text-green-600 hover:text-green-900">Ver Inscritos</a>
                                    <a href="{{ route('events.edit', $evento->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                    <form action="{{ route('events.destroy', $evento->id) }}" method="POST"
                                        onsubmit="return confirm('Tem certeza que deseja excluir este evento?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-900 cursor-pointer">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Mobile Cards --}}
            <div class="md:hidden">
                @foreach ($eventos as $evento)
                    <div class="p-4 border-b border-slate-100 last:border-b-0 space-y-3">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-bold text-slate-900">{{ $evento->titulo }}</h3>
                            </div>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                {{ $evento->totalInscricoes() }} / {{ $evento->limite_vagas }}
                            </span>
                        </div>

                        <div class="text-sm text-slate-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            {{ $evento->local }}
                        </div>

                        <div class="text-sm text-slate-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            {{ substr($evento->hora, 0, 5) }}
                        </div>

                        <div class="text-sm text-slate-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                             {{ date('d/m/Y', strtotime($evento->data)) }}
                        </div>

                        <div class="flex justify-between items-center pt-2 mt-2 border-t border-slate-50">
                            <a href="{{ route('events.inscritos', $evento->id) }}"
                                class="text-sm font-medium text-green-600 hover:text-green-800">Ver Inscritos</a>
                            <div class="flex items-center gap-3">
                                <a href="{{ route('events.edit', $evento->id) }}"
                                    class="text-sm font-medium text-indigo-600 hover:text-indigo-800">Editar</a>
                                <form action="{{ route('events.destroy', $evento->id) }}" method="POST"
                                    onsubmit="return confirm('Tem certeza que deseja excluir este evento?');"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-sm font-medium text-red-600 hover:text-red-800">Excluir</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($eventos->isEmpty())
                <div class="p-8 text-center text-gray-500">
                    Você ainda não criou nenhum evento.
                </div>
            @endif
        </div>
    </div>
@endsection
