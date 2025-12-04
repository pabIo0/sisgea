<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\AuthController;
use App\Models\Evento;

// 1. Página Inicial (Welcome)
Route::get('/', function () {
    // Busca todos os eventos futuros
    $events = Evento::where('data', '>=', now())->orderBy('data')->get();
    return view('welcome', compact('events'));
})->name('home');

// 2. Página de Contato
Route::get('/contato', function () {
    return view('contato');
})->name('contato');

// --- AUTENTICAÇÃO ---
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- ÁREA RESTRITA (LOGADO) ---
Route::middleware(['auth'])->group(function () {
    
    // CRUD de Eventos
    Route::resource('events', EventoController::class);

    // Rota para inscrição
    Route::post('/eventos/{id}/inscrever', [EventoController::class, 'inscrever'])->name('eventos.inscrever');
    Route::get('/eventos/{id}/inscritos', [EventoController::class, 'verInscritos'])->name('eventos.inscritos');

    // --- DASHBOARDS ---
    
    // Visão do Participante (Minhas Inscrições)
    Route::get('/meus-eventos', function () {
        return view('dashboard.participant');
    })->name('dashboard.participant');

    // Visão do Organizador (Meus Eventos Criados)
    Route::get('/meus-eventos-criados', function () {
        return view('dashboard.organizer');
    })->name('dashboard.organizer');
});