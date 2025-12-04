<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

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
}