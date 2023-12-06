<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\LoginHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class LogLoginHistory
{
    public function handle($request, Closure $next)
    {
        // Verifica se o usuário está autenticado
        if (Auth::check() && !$request->is('logout')) {

            // Verifica se o indicador de login recente está na sessão
            if (!Session::has('user_just_logged_in')) {
                $authUser = Auth::user();

                LoginHistory::create([
                    'user_id' => $authUser->id,
                    'associate_id' => (authUserIsAnAssociate()) ? $authUser->contact->company->associate->id : null,
                    'ip' => Request::ip(),
                    'user_agent' => Request::userAgent(),
                ]);

                // Define o indicador de login recente na sessão
                Session::put('user_just_logged_in', true);
            }
        }

        // Continua o fluxo normal
        return $next($request);
    }
}