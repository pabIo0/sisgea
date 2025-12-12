<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InscricaoController;


// --- PÁGINA INICIAL (WELCOME) ---
Route::get('/', [EventController::class, 'index']);

// --- AUTENTICAÇÃO ---
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    // --- ROTAS PARA TODOS OS LOGADOS (Participantes e Organizadores) ---

    // Dashboard Participante
    Route::get('/meus-eventos', [EventController::class, 'dashboardParticipant'])->name('dashboard.participant');

    // Inscrever-se
    Route::post('/events/{id}/inscrever', [InscricaoController::class, 'store'])->name('events.inscrever');
    Route::delete('/events/{id}/cancelar', [InscricaoController::class, 'destroy'])->name('events.cancelar');

    // --- ROTAS EXCLUSIVAS DE ORGANIZADOR ---
    Route::middleware(['organizador'])->group(function () {

        // Dashboard Organizador
        Route::get('/organizador', [EventController::class, 'dashboardOrganizer'])->name('dashboard.organizer');

        // Ver Inscritos
        Route::get('/events/{id}/inscritos', [EventController::class, 'verInscritos'])->name('events.inscritos');

        // Eventos Excluídos
        Route::get('/events-excluidos', [EventController::class, 'eventosExcluidos'])->name('events.excluidos');
        Route::post('/events/{id}/restaurar', [EventController::class, 'restaurar'])->name('events.restaurar');

        // CRUD de Eventos 
        Route::resource('events', EventController::class)->except(['show']);
    });

    // Ver Detalhes do Evento
    Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
});
