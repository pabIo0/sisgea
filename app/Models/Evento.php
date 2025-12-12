<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Inscricao;

class Evento extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'EVENTOS';

    protected $fillable = [
        'titulo',
        'descricao',
        'data',
        'hora',
        'local',
        'limite_vagas',
        'usuario_id'
    ];

     // Relacionamento 1:N
    public function inscricoes()
    {
        return $this->hasMany(Inscricao::class, 'evento_id');
    }

     // Verificar vagas disponíveis
    public function vagasDisponiveis()
    {

        $totalInscritos = $this->inscricoes()->count();


        return $this->limite_vagas - $totalInscritos;
    }

    public function totalInscricoes()
    {
        return $this->inscricoes()->count();
    }

    // Verifica se está lotado
    public function estaLotado()
    {
        return $this->vagasDisponiveis() <= 0;
    }




}
