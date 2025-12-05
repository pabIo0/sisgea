<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
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

    Route::resource('events', EventController::class);

    // DASHBOARDS
    Route::get('/meus-eventos', [EventController::class, 'dashboardParticipant'])->name('dashboard.participant');
    Route::get('/organizador', [EventController::class, 'dashboardOrganizer'])->name('dashboard.organizer');

    Route::post('/events/{id}/inscrever', [EventController::class, 'inscrever'])->name('events.inscrever');
    Route::get('/events/{id}/inscritos', [EventController::class, 'verInscritos'])->name('events.inscritos');

});