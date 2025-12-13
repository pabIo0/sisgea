@extends('layouts.app')

@section('title', 'SISGEA - ' . $evento->titulo)

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="{{ url('/') }}" class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center">
                &larr; Voltar para lista de eventos
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            {{-- TITULO --}}
            <div class="bg-indigo-600 px-8 py-6">
                <h1 class="text-3xl font-bold text-white">
                    {{ $evento->titulo }}
                </h1>

                <div class="flex flex-wrap gap-4 mt-4 text-indigo-100">

                    {{-- DATA --}}
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        {{ \Carbon\Carbon::parse($evento->data)->format('d/m/Y') }}
                    </div>

                    {{-- HORA --}}
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ \Carbon\Carbon::parse($evento->hora)->format('H:i') }}
                    </div>

                    {{-- LOCAL --}}
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        {{ $evento->local }}
                    </div>

                </div>
            </div>

            {{-- CONTENT --}}
            <div class="p-8">
                <div class="prose max-w-none text-slate-700 mb-8">
                    <h3 class="text-xl font-semibold text-slate-900 mb-3">Sobre o Evento</h3>

                    <p class="whitespace-pre-line">
                        {{ $evento->descricao }}
                    </p>
                </div>

                {{-- FOOTER --}}
                <div class="border-t border-slate-100 pt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="text-slate-600">
                        {{-- Lógica visual de vagas --}}
                        @php
                            $vagasRestantes = $evento->vagasDisponiveis();
                            $estaLotado = $evento->estaLotado();
                            $corVagas = $estaLotado
                                ? 'text-red-600'
                                : ($vagasRestantes < 5
                                    ? 'text-orange-500'
                                    : 'text-emerald-600');
                        @endphp
                        <div class="flex flex-col">
                            <span class="font-bold text-slate-900 text-lg">{{ $evento->limite_vagas }} vagas totais</span>
                            <span class="text-sm font-medium {{ $corVagas }}">
                                @if ($estaLotado)
                                    Esgotado!
                                @else
                                    Restam {{ $vagasRestantes }} vagas
                                @endif
                            </span>
                        </div>
                    </div>
                    @auth
                        @if ($eOrganizador)
                            <button disabled
                                class="bg-indigo-100 text-indigo-700 font-bold py-3 px-8 rounded-lg cursor-not-allowed border border-indigo-200 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="2 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                                </svg>
                                Você é o organizador deste evento
                            </button>
                        @elseif ($jaInscrito)
                            <button disabled
                                class="bg-indigo-50 text-indigo-600 font-bold py-3 px-8 rounded-lg cursor-not-allowed border border-indigo-100 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                    </path>
                                </svg>
                                Inscrição Confirmada
                            </button>
                        @elseif($estaLotado)
                            <button disabled
                                class="bg-slate-100 text-slate-400 font-bold py-3 px-8 rounded-lg cursor-not-allowed border border-slate-200">
                                Vagas Esgotadas
                            </button>
                        @else
                            <form action="{{ route('events.inscrever', $evento->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3 px-8 rounded-lg shadow-md transition transform hover:-translate-y-0.5">
                                    Quero participar
                                </button>
                            </form>
                        @endif
                    @else
                        <div class="text-center sm:text-right">
                            @if ($estaLotado)
                                <span
                                    class="inline-block bg-slate-100 text-slate-400 font-bold py-3 px-8 rounded-lg cursor-not-allowed border border-slate-200">
                                    Vagas Esgotadas
                                </span>
                            @else
                                <p class="text-slate-500 mb-2 text-sm">Faça login para se inscrever</p>
                                <a href="{{ route('login') }}"
                                    class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg shadow-md transition">
                                    Entrar e Inscrever-se
                                </a>
                            @endif
                        </div>
                    @endauth
                </div>

                {{-- <div class="border-t border-slate-100 pt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="text-slate-600">
                    <span class="font-bold text-slate-900 text-lg">{{ $evento->limite_vagas }}</span> vagas totais
                </div>

                @auth

                    @if ($jaInscrito)
                        <button disabled class="bg-gray-100 text-gray-500 font-bold py-3 px-8 rounded-lg cursor-not-allowed border border-gray-200">
                            Você já está inscrito
                        </button>
                    @else
                        <form action="{{ route('events.inscrever', $evento->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3 px-8 rounded-lg shadow-md transition transform hover:-translate-y-0.5">
                                Inscrever-se Agora
                            </button>
                        </form>
                    @endif

                @else
                    <div class="text-center sm:text-right">
                        <p class="text-slate-500 mb-2">Faça login para garantir sua vaga.</p>
                        <a href="{{ route('login') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg shadow-md transition">
                            Fazer Login
                        </a>
                    </div>
                @endauth
            </div> --}}
            </div>
        </div>
    </div>
@endsection
