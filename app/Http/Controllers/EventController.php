<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Inscricao;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    // Listar eventos
    public function index()
    {
        $eventos = Evento::all();

        return view('welcome', ['eventos' => $eventos]);
    }
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

        // Verifica se o usuário está logado
        $jaInscrito = false;

        if (Auth::check()) {
            $jaInscrito = Inscricao::where('usuario_id', Auth::id())
                ->where('evento_id', $id)
                ->exists();
        }

        return view('events.show', compact('evento', 'jaInscrito'));
    }

    // Dashboard do Participante
    public function dashboardParticipant()
    {
        $user = Auth::user();
        $inscricoes = Inscricao::where('INSCRICOES.usuario_id', $user->id)
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

    public function edit($id)
    {
        $evento = Evento::findOrFail($id);

        // Só o dono pode editar
        if (Auth::id() != $evento->usuario_id) {
            return redirect()->route('dashboard.organizer')->with('error', 'Acesso não autorizado');
        }

        return view('events.edit', compact('evento'));
    }

    public function update(Request $request, $id)
    {
        $evento = Evento::findOrFail($id);

        if (Auth::id() != $evento->usuario_id) {
            abort(403);
        }

        $request->validate([
            'titulo' => 'required',
            'descricao' => 'required',
            'data' => 'required|date',
            'hora' => 'required',
            'local' => 'required',
            'limite_vagas' => 'required|integer'
        ]);

        $evento->update($request->all());

        return redirect()->route('dashboard.organizer')->with('success', 'Evento atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $evento = Evento::findOrFail($id);

        if (Auth::id() != $evento->usuario_id) {
            abort(403);
        }

        $evento->delete();

        return redirect()->route('dashboard.organizer')->with('success', 'Evento excluído com sucesso!');
    }

    public function verInscritos($id)
    {
        $evento = Evento::findOrFail($id);

        if (Auth::id() != $evento->usuario_id) {
            return redirect()->route('dashboard.organizer')->with('error', 'Acesso negado.');
        }

        $inscritos = Inscricao::where('INSCRICOES.evento_id', $id)
            ->join('USUARIOS', 'INSCRICOES.usuario_id', '=', 'USUARIOS.id')
            ->select('USUARIOS.nome', 'USUARIOS.email', 'INSCRICOES.created_at as data_inscricao')
            ->get();

        return view('events.inscritos', compact('evento', 'inscritos'));
    }

    public function inscrever($id)
    {
        $user = Auth::user();
        $evento = Evento::findOrFail($id);

        // 1. Verifica se já está inscrito
        $jaInscrito = Inscricao::where('usuario_id', $user->id)
            ->where('evento_id', $id)
            ->exists();

        if ($jaInscrito) {
            return back()->with('error', 'Você já está inscrito neste evento!');
        }

        // Conta quantas inscrições esse evento já tem
        $totalInscritos = Inscricao::where('evento_id', $id)->count();

        if ($evento->limite_vagas > 0 && $totalInscritos >= $evento->limite_vagas) {
            return back()->with('error', 'Desculpe, as vagas para este evento esgotaram!');
        }

        // 3. Cria a inscrição
        Inscricao::create([
            'usuario_id' => $user->id,
            'evento_id' => $id
        ]);

        return back()->with('success', 'Inscrição realizada com sucesso!');
    }
}
