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

    // Dashboard do Participante
    public function dashboardParticipant()
    {
        $user = Auth::user();
        // Busca eventos onde o usuário está inscrito
        // Nota: Isso requer que o relacionamento 'eventos' esteja definido no Model User
        // Se não tiver, podemos fazer via query manual:
        $inscricoes = Inscricao::where('usuario_id', $user->id)
            ->join('EVENTOS', 'INSCRICOES.evento_id', '=', 'EVENTOS.id')
            ->select('EVENTOS.*', 'INSCRICOES.created_at as data_inscricao')
            ->get();

        return view('dashboard.participant', compact('inscricoes'));
    }

    // Dashboard do Organizador
    public function dashboardOrganizer()
    {
        $user = Auth::user();
        $eventos = Evento::where('usuario_id', $user->id)->get();
        
        return view('dashboard.organizer', compact('eventos'));
    }
}