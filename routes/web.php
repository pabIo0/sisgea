<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\AuthController;
use App\Models\Evento;

// --- PÁGINA INICIAL (WELCOME) ---
Route::get('/', function () {
    $events = Evento::where('data', '>=', now())->orderBy('data')->take(6)->get();
    return view('welcome', compact('events'));
})->name('home');

// --- CONTATO ---
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
    
    // Resource completa para eventos (index, create, store, show, edit, update, destroy)
    // Nota: Como suas views estão em 'events', o resource vai procurar lá automaticamente
    Route::resource('events', EventController::class);

    // Dashboards
    Route::get('/meus-eventos', [EventController::class, 'dashboardParticipant'])->name('dashboard.participant');
    Route::get('/organizador', [EventController::class, 'dashboardOrganizer'])->name('dashboard.organizer');

    // Inscrição (mantendo a lógica que já tínhamos)
    Route::post('/events/{id}/inscrever', [EventController::class, 'inscrever'])->name('events.inscrever');
});