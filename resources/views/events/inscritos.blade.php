@extends('layouts.app')

@section('title', 'SISGEA - Inscrições')


@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('dashboard.organizer') }}"
                class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center">
                &larr; Voltar para Meus Eventos
            </a>
            <h2 class="text-xl font-bold text-slate-800 ml-auto text-right">Inscritos: {{ $evento->titulo }}</h2>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-slate-100">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                <div>
                    <span class="text-sm text-slate-500">Total de Inscritos</span>
                    <div class="text-2xl font-bold text-indigo-600">{{ count($inscritos) }} / {{ $evento->limite_vagas }}
                    </div>
                </div>
            </div>

            @if (count($inscritos) > 0)
                {{-- Desktop  --}}
                <div class="hidden md:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Nome</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Email</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    Data Inscrição</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            @foreach ($inscritos as $inscrito)
                                <tr class="hover:bg-slate-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                        {{ $inscrito->nome }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ $inscrito->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-400">
                                        {{ date('d/m/Y H:i', strtotime($inscrito->data_inscricao)) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Mobile --}}
                <div class="md:hidden">
                    @foreach ($inscritos as $inscrito)
                        <div class="p-4 border-b border-slate-100 last:border-b-0 space-y-2">

                            <div class="flex justify-between items-start w-full">

                                {{-- Nome e email alinhados à esquerda --}}
                                <div>
                                    <h3 class="text-sm font-bold text-slate-900">
                                        {{ $inscrito->nome }}
                                    </h3>
                                    <p class="text-sm text-slate-500">
                                        {{ $inscrito->email }}
                                    </p>
                                </div>

                                {{-- Data e hora à direita --}}
                                <div class="text-right">
                                    <div class="text-xs text-slate-400">
                                        {{ date('d/m/Y', strtotime($inscrito->data_inscricao)) }}
                                    </div>
                                    <div class="text-xs text-slate-500">
                                        {{ date('H:i', strtotime($inscrito->data_inscricao)) }}
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="p-12 text-center text-slate-500">
                    Ainda não há ninguém inscrito neste evento.
                </div>
            @endif
        </div>
    </div>
@endsection
