<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SingleDeviceSessionMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $sessionToken = $request->session()->getId();

            if ($user->session_id && $user->session_id !== $sessionToken) {
                Auth::logout();

                return redirect()->route('login')->with('message', 'Você foi desconectado, alguém fez login em outro dispositivo.');
            }

            if (!$user->session_id) {
                $user->session_id = $sessionToken;
                $user->save();
            }
        }

        return $next($request);
    }
}