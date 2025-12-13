<?php

namespace App\Http\Controllers;
use App\Models\Inscricao;
use Illuminate\Http\Request;
use App\Models\Evento;
use Illuminate\Support\Facades\Auth;

class InscricaoController extends Controller
{
    public function store(Request $request, $eventoId)
{

    $user = Auth::user();
    $evento = Evento::findOrFail($eventoId);
    
    // 1. Verifica se o usuário é o organizador do evento
    if ($evento->usuario_id == $user->id) {
        return back()->with('error', 'O organizador do evento não pode se inscrever no próprio evento.');
    }
    
    // 2. Verifica se já está lotado
    if ($evento->estaLotado()) {
        return back()->with('error', 'Desculpe, as vagas para este evento esgotaram.');
    }
    
    // 3. Verifica se o usuário já está inscrito
    $jaInscrito = $evento->inscricoes()->where('usuario_id', $user->id)->exists();
    if ($jaInscrito) {
        return back()->with('warning', 'Você já está inscrito neste evento.');
    }

    // 4. Cria a inscrição
    Inscricao::create([
        'evento_id' => $evento->id,
        'usuario_id' => $user->id,
    ]);
    return redirect()->route('events.show', $evento->id)
                     ->with('success', 'Inscrição realizada com sucesso!');
}

    public function destroy($eventoId)
    {
        $user = Auth::user();

        // Encontra a inscrição do usuário para este evento
        $inscricao = Inscricao::where('usuario_id', $user->id)
            ->where('evento_id', $eventoId)
            ->first();

        if ($inscricao) {
            $inscricao->delete();
            return back()->with('success', 'Inscrição cancelada com sucesso!');
        }

        return back()->with('error', 'Inscrição não encontrada.');
    }
}
