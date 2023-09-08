<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\LoginHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LogLoginHistory
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && !$request->is('logout')) {
            $authUser = Auth::user();

            LoginHistory::create([
                'user_id' => $authUser->id,
                'associate_id' => (authUserIsAnAssociate()) ? $authUser->contact->company->associate->id : null,
                'ip' => Request::ip(),
                'user_agent' => Request::userAgent(),
            ]);
        }

        return $next($request);
    }
}


