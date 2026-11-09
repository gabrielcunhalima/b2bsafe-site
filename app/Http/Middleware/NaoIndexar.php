<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/** Mantém a área restrita fora dos buscadores (RF-011): cabeçalho X-Robots-Tag em toda resposta. */
class NaoIndexar
{
    public function handle(Request $request, Closure $next): Response
    {
        $resposta = $next($request);
        $resposta->headers->set('X-Robots-Tag', 'noindex, nofollow');

        return $resposta;
    }
}
