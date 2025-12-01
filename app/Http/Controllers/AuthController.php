<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // === REGISTRO (CADASTRO) ===

    // 1. Mostrar o formulário de cadastro
    public function showRegister() {
        return view('auth.register');
    }

    // 2. Processar o cadastro
    public function register(Request $request) {
        // Validação
        $request->validate([
            'nome' => 'required',
            'email' => 'required|email|unique:USUARIOS,email', // Verifica na tabela USUARIOS
            'senha' => 'required|min:6'
        ]);

        // Criar o usuário no banco
        // Atenção: Mapeamos o input 'senha' para a coluna 'senha' com Hash
        User::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => Hash::make($request->senha),
            'perfil' => 'participante' // Padrão
        ]);

        // Fazer login automático após cadastro
        $credentials = ['email' => $request->email, 'password' => $request->senha];
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('eventos'); // Redireciona para a lista
        }

        return redirect()->route('login');
    }

    // === LOGIN ===

    // 3. Mostrar o formulário de login
    public function showLogin() {
        return view('auth.login');
    }

    // 4. Processar o login
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'], // O input chama password, mas o Laravel sabe comparar
        ]);

        // Tenta logar
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Segurança contra roubo de sessão
            return redirect()->intended('eventos'); // Sucesso! Vai para eventos
        }

        // Falha
        return back()->withErrors([
            'email' => 'As credenciais fornecidas estão incorretas.',
        ]);
    }

    // === LOGOUT ===
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}