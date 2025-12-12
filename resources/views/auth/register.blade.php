@extends('layouts.app')

@section('title', 'SISGEA - Cadastro')


@section('content')
    <div class="flex justify-center items-center min-h-[calc(100vh-200px)]">
        <div class="w-full max-w-md bg-white rounded-xl shadow-md overflow-hidden md:max-w-lg">
            <div class="md:flex">
                <div class="w-full p-8">
                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-bold text-slate-800">Crie sua conta</h2>
                        <p class="text-slate-500 text-sm mt-1">Junte-se a nós para gerenciar ou participar de eventos.</p>
                    </div>

                    <form method="POST" action="{{ route('register.post') }}" novalidate> @csrf

                        <div class="mb-4">
                            <label for="nome" class="block text-sm font-medium text-slate-700 mb-1">Nome
                                Completo</label>
                            <input type="text" name="nome" id="nome"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
                                required autofocus>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition @error('email') border-red-500 @enderror"
                                required>
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="perfil" class="block text-sm font-medium text-slate-700 mb-1">Perfil</label>
                            <select name="perfil" id="perfil"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition bg-white">
                                <option value="participante">Participante</option>
                                <option value="organizador">Organizador</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Senha</label>
                            <input type="password" name="senha" id="senha"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
                                required>


                            <div class="mt-2 h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                                <div id="password-strength-bar" class="h-full bg-red-500 w-0 transition-all duration-300">
                                </div>
                            </div>
                            <p id="password-feedback" class="text-xs text-slate-500 mt-1">Mínimo de 6 caracteres</p>
                        </div>

                        <div class="mb-6">
                            <label for="password_confirmation"
                                class="block text-sm font-medium text-slate-700 mb-1">Confirmar Senha</label>
                            <input type="password" name="senha_confirmation" id="senha_confirmation"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
                                required>

                            <div class="mt-2 h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                                <div id="password-confirmation-bar"
                                    class="h-full bg-red-500 w-0 transition-all duration-300"></div>
                            </div>
                            <p id="password-confirmation-feedback" class="text-xs text-slate-500 mt-1"></p>
                        </div>



                        <button type="submit"
                        id="register-button"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 rounded-lg shadow-md transition duration-200">
                            Cadastrar
                        </button>

                        <div class="mt-5 text-center">
                            <a href="{{ route('login') }}"
                                class="text-sm text-indigo-600 hover:text-indigo-800 hover:underline">Já tem uma conta? Faça
                                Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="{{ asset('js/register-validation.js') }}"></script>
