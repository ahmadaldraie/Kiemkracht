<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Verwerk een inkomend request en controleer of de gebruiker een beheerder is.
     *
     * Deze middlewarefunctie controleert of de geauthenticeerde gebruiker beheerdersrechten heeft.
     * Als de gebruiker niet geauthenticeerd is als beheerder, wordt een AuthorizationException gegenereerd.
     * 
     * @param  \Illuminate\Http\Request  $request  De inkomende HTTP request
     * @param  \Closure  $next  De volgende middleware/handler in de pipeline
     * @return \Symfony\Component\HttpFoundation\Response  De response van de volgende middleware/handler
     * @throws \Illuminate\Auth\Access\AuthorizationException  Als de gubruiker geen beheerdersrechten heeft.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::user() || !Auth::user()->is_admin) {
            throw new AuthorizationException('U hebt geen toegang tot deze pagina.');
        }

        return $next($request);
    }
}
