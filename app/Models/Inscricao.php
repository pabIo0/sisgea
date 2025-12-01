<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscricao extends Model
{
    use HasFactory;

    protected $table = 'INSCRICOES';

    // Desativa a tentativa do Laravel de preencher created_at e updated_at
    public $timestamps = false; 

    protected $fillable = ['usuario_id', 'evento_id'];
}