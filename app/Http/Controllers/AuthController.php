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
            'nome' => 'required',
            // Verifica se o email é único na tabela USUARIOS
            'email' => 'required|email|unique:USUARIOS,email', 
            'senha' => 'required|min:6'
        ]);

        // Criar usuário no banco
        User::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => Hash::make($request->senha), // Hash seguro
            'perfil' => $request->perfil ?? 'participante' // Padrão participante se não vier
        ]);

        // Login automático após cadastro
        $credentials = ['email' => $request->email, 'password' => $request->senha];
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home');
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
            'password' => ['required'], // O input chama password, mesmo a coluna sendo senha
        ]);

        // Tenta logar
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
            'email' => 'As credenciais fornecidas estão incorretas.',
        ]);
    }

    // === LOGOUT ===
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}