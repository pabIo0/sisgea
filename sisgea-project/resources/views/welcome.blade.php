@extends('layouts.app')

@section('content')
<div class="text-center mb-12">
    <h1 class="text-4xl font-extrabold text-slate-900 sm:text-5xl">Próximos Eventos</h1>
    <p class="mt-4 text-xl text-slate-500">Confira os eventos disponíveis e garanta sua vaga.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Evento 1 -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition duration-300 overflow-hidden border border-slate-100 flex flex-col h-full">
            <div class="p-6 flex-grow">
                <div class="flex justify-between items-start mb-4">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                        Evento
                    </span>
                    <span class="text-sm text-slate-400">
                        25/11/2025
                    </span>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2 line-clamp-2">Workshop de Laravel 10</h3>
                <div class="space-y-2 text-sm text-slate-600 mb-4">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        14:00
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Auditório Principal
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        50 vagas
                    </div>
                </div>
            </div>
            <div class="bg-slate-50 px-6 py-4 border-t border-slate-100">
                <a href="#" class="block w-full text-center bg-white border border-indigo-600 text-indigo-600 hover:bg-indigo-600 hover:text-white font-semibold py-2 rounded-lg transition duration-200">
                    Ver Detalhes
                </a>
            </div>
        </div>

        <!-- Evento 2 -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition duration-300 overflow-hidden border border-slate-100 flex flex-col h-full">
            <div class="p-6 flex-grow">
                <div class="flex justify-between items-start mb-4">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                        Evento
                    </span>
                    <span class="text-sm text-slate-400">
                        02/12/2025
                    </span>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2 line-clamp-2">Conferência de Tech 2023</h3>
                <div class="space-y-2 text-sm text-slate-600 mb-4">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        09:00
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Centro de Convenções
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        200 vagas
                    </div>
                </div>
            </div>
            <div class="bg-slate-50 px-6 py-4 border-t border-slate-100">
                <a href="#" class="block w-full text-center bg-white border border-indigo-600 text-indigo-600 hover:bg-indigo-600 hover:text-white font-semibold py-2 rounded-lg transition duration-200">
                    Ver Detalhes
                </a>
            </div>
        </div>

        <!-- Evento 3 -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition duration-300 overflow-hidden border border-slate-100 flex flex-col h-full">
            <div class="p-6 flex-grow">
                <div class="flex justify-between items-start mb-4">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                        Evento
                    </span>
                    <span class="text-sm text-slate-400">
                        10/12/2025
                    </span>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2 line-clamp-2">Meetup de Design System</h3>
                <div class="space-y-2 text-sm text-slate-600 mb-4">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        19:00
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Coworking Space
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        30 vagas
                    </div>
                </div>
            </div>
            <div class="bg-slate-50 px-6 py-4 border-t border-slate-100">
                <a href="#" class="block w-full text-center bg-white border border-indigo-600 text-indigo-600 hover:bg-indigo-600 hover:text-white font-semibold py-2 rounded-lg transition duration-200">
                    Ver Detalhes
                </a>
            </div>
        </div>
</div>
@endsection
