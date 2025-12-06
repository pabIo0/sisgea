<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscricao extends Model
{
    use HasFactory;

    protected $table = 'inscricoes';

    public $timestamps = true; // A tabela de inscrições não tem updated_at

    protected $fillable = ['usuario_id', 'evento_id'];
}
