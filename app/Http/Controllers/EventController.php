<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Inscricao;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // 1. Mostrar o formulário de criação
    public function create()
    {
        // Retorna a view que está em resources/views/events/create.blade.php
        return view('events.create'); 
    }

    // 2. Salvar o evento no banco
    public function store(Request $request)
    {
        // Validação
        $request->validate([
            'titulo' => 'required',
            'descricao' => 'required',
            'data' => 'required|date',
            'hora' => 'required',
            'local' => 'required',
            'limite_vagas' => 'required|integer'
        ]);

        // Salvar
        Evento::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'data' => $request->data,
            'hora' => $request->hora,
            'local' => $request->local,
            'limite_vagas' => $request->limite_vagas,
            'usuario_id' => Auth::id() // Pega o ID de quem está logado
        ]);

        // Redirecionar para a Dashboard do Organizador
        return redirect()->route('dashboard.organizer')->with('success', 'Evento criado com sucesso!');
    }

    // 3. Mostrar detalhes de um evento específico
    public function show($id)
    {
        $evento = Evento::findOrFail($id);
        return view('events.show', compact('evento'));
    }
}