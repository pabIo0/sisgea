<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Busca todos os eventos do banco
        $eventos = \App\Models\Evento::all();
        
        // Retorna a view passando os dados
        return view('eventos.index', ['eventos' => $eventos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('eventos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validação (Garante que os dados vieram e estão certos)
        $request->validate([
            'titulo' => 'required|max:255',
            'descricao' => 'required',
            'data' => 'required|date',
            'local' => 'required',
            'limite_vagas' => 'required|integer',
            // Para teste, vamos fixar um ID de organizador existente no banco
            // Depois pegaremos do usuário logado
        ]);

        // 2. Criar o Evento no Banco
        // Como o Model Evento já tem o $fillable configurado, podemos fazer assim:
        
        // DICA: Como não temos login ainda, vamos forçar o usuario_id = 1 (João Silva)
        // apenas para testar se grava no banco.
        $dados = $request->all();
        $dados['usuario_id'] = 1; // Temporário para teste

        \App\Models\Evento::create($dados);

        // 3. Redirecionar (Feedback)
        return "Evento criado com sucesso! Verifique no Banco de Dados.";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function inscrever($id)
    {
        $usuario = auth()->user(); // Pega o usuário logado
        
        // Verifica se já está inscrito (Regra de Negócio)
        $jaInscrito = \App\Models\Inscricao::where('usuario_id', $usuario->id)
                                           ->where('evento_id', $id)
                                           ->exists();

        if ($jaInscrito) {
            return back()->with('success', 'Você já está inscrito neste evento!');
        }

        // Cria a inscrição
        \App\Models\Inscricao::create([
            'usuario_id' => $usuario->id,
            'evento_id' => $id
        ]);

        return back()->with('success', 'Inscrição realizada com sucesso!');
    }

    public function verInscritos($id)
    {
        // 1. Busca o evento para pegar o título
        $evento = \App\Models\Evento::findOrFail($id);

        // 2. Segurança: Só o dono do evento pode ver a lista!
        if (auth()->user()->id != $evento->usuario_id) {
            return redirect('/eventos')->with('error', 'Você não tem permissão para ver isso.');
        }

        // 3. Busca os inscritos fazendo JOIN com a tabela de usuários
        // "Selecione o nome e email dos USUARIOS onde o ID deles esteja na tabela INSCRICOES deste evento"
        $inscritos = \App\Models\Inscricao::where('evento_id', $id)
            ->join('USUARIOS', 'INSCRICOES.usuario_id', '=', 'USUARIOS.id')
            ->select('USUARIOS.nome', 'USUARIOS.email', 'INSCRICOES.created_at as data_inscricao')
            ->get();

        // 4. Retorna a view
        return view('eventos.inscritos', [
            'evento' => $evento,
            'inscritos' => $inscritos
        ]);
    }
}
