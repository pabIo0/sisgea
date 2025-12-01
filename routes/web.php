<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\AuthController;

// Rota Raiz: Redireciona para o Login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rotas de Autenticação (Públicas)
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rotas Protegidas (Só acessa se estiver logado)
Route::middleware(['auth'])->group(function () {
    
    // CRUD de Eventos (protegido)
    Route::resource('eventos', EventoController::class);

    // Rota personalizada para inscrição
    Route::post('/eventos/{id}/inscrever', [EventoController::class, 'inscrever'])->name('eventos.inscrever');
    
    // Rota para ver inscritos
    Route::get('/eventos/{id}/inscritos', [EventoController::class, 'verInscritos'])->name('eventos.inscritos');
    
    // Dashboard temporário para teste
    Route::get('/dashboard', function () {
        return "Bem-vindo, " . auth()->user()->nome . "! <br> <a href='/eventos'>Ir para Eventos</a> <form method='POST' action='/logout'>".csrf_field()."<button>Sair</button></form>";
    });
});