@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-[calc(100vh-200px)]">
    <div class="w-full max-w-md bg-white rounded-xl shadow-md overflow-hidden md:max-w-lg">
        <div class="md:flex">
            <div class="w-full p-8">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-slate-800">Crie sua conta</h2>
                    <p class="text-slate-500 text-sm mt-1">Junte-se a nós para gerenciar ou participar de eventos.</p>
                </div>

                <form method="POST" action="#">
                    @csrf

                    <div class="mb-4">
                        <label for="nome" class="block text-sm font-medium text-slate-700 mb-1">Nome Completo</label>
                        <input type="text" name="nome" id="nome" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" required autofocus>
                    </div>

                    <div class="mb-4">
                        <label for="login" class="block text-sm font-medium text-slate-700 mb-1">Login (Usuário)</label>
                        <input type="text" name="login" id="login" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" required>
                    </div>

                    <div class="mb-4">
                        <label for="perfil" class="block text-sm font-medium text-slate-700 mb-1">Perfil</label>
                        <select name="perfil" id="perfil" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition bg-white">
                            <option value="participante">Participante</option>
                            <option value="organizador">Organizador</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Senha</label>
                        <input type="password" name="password" id="password" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" required>
                    </div>

                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1">Confirmar Senha</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" required>
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 rounded-lg shadow-md transition duration-200">
                        Cadastrar
                    </button>

                    <div class="mt-4 text-center">
                        <a href="/login" class="text-sm text-indigo-600 hover:text-indigo-800 hover:underline">Já tem uma conta? Faça login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
