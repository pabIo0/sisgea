<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckOrganizer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica se o usuário não é organizador
        if ($request->user()->perfil !== 'organizador') {
            // Se for participante, manda de volta para a home
            return redirect('/')->with('error', 'Acesso negado: Apenas organizadores podem acessar esta área.');
        }

        // Se for organizador, deixa passar
        return $next($request);
    }
}
