<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // AVISAR AO LARAVEL PARA USAR SUA TABELA
    protected $table = 'USUARIOS';

    // AVISAR QUE A SENHA ESTÁ NA COLUNA 'senha' (e não 'password')
    public function getAuthPassword()
    {
        return $this->senha;
    }

    protected $fillable = [
        'nome',
        'email',
        'senha',
        'perfil',
    ];

    protected $hidden = [
        'senha',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'senha' => 'hashed', // Importante para o Laravel entender o hash
        ];
    }
}