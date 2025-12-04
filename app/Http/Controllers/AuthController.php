<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // === REGISTRO (CADASTRO) ===

    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        // Validação
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:USUARIOS,email', // Verifica se o email é único na tabela USUARIOS 
            'senha' => 'required|min:6|confirmed', // 'confirmed' checa o campo senha_confirmation
            'perfil' => 'required|in:participante,organizador' // Garante que é um dos dois
        ]);

        // Criar usuário
        User::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => Hash::make($request->senha),
            'perfil' => $request->perfil
        ]);

        // Login automático após cadastro
        if (Auth::attempt(['email' => $request->email, 'password' => $request->senha])) {
            $request->session()->regenerate();
            
            // Redirecionamento p/ organizador
            if ($request->perfil == 'organizador') {
                return redirect()->route('dashboard.organizer');
            }
            return redirect()->route('dashboard.participant');
        }

        return redirect()->route('login');
    }

    // === LOGIN ===

    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        // Validação
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // tenta logar
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Redireciona baseado no perfil
            if (Auth::user()->perfil == 'organizador') {
                return redirect()->route('dashboard.organizer');
            }
            
            return redirect()->route('dashboard.participant');
        }

        // Erro de login
        return back()->withErrors([
            'email' => 'Email ou senha incorretos.',
        ])->onlyInput('email');
    }

    // === LOGOUT ===
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}