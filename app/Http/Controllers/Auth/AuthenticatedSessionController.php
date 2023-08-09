<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    const IT_IS_ACTIVE = 1;
    const IT_IS_NOT_ACTIVE = 0;
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        $user = Auth::user();

        if ($user->is_active == self::IT_IS_ACTIVE) {

            if (
                $user->contact()->exists() &&
                $user->contact->company()->exists() &&
                ($user->contact->company->is_active == self::IT_IS_NOT_ACTIVE)
            ) {
                Auth::guard('web')->logout();
            
                $request->session()->invalidate();
                
                $request->session()->regenerateToken();
    
                session()->flash('message', 'Acesso não permitido, entre em contato com a INTEC.');
    
                return redirect()->route('login');
            }

            // // valid for associate managers and common associate users
            // if (
            //     $user->contact()->exists() &&
            //     $user->contact->company()->exists() &&
            //     $user->contact->company->associate()->exists() &&
            //     ($user->is_active == self::IT_IS_NOT_ACTIVE)
            // ) {
            //     Auth::guard('web')->logout();
            
            //     $request->session()->invalidate();
                
            //     $request->session()->regenerateToken();
    
            //     session()->flash('message', 'Acesso não permitido, entre em contato com a INTEC.');
    
            //     return redirect()->route('login');
            // }

            if (
                $user->contact()->exists() &&
                $user->contact->company()->exists() &&
                $user->contact->company->associate()->exists() &&
                ($user->is_active == self::IT_IS_ACTIVE) &&
                (Auth::user()->role->slug == 'associado-gestora')
            ) {
                return redirect()->intended(RouteServiceProvider::HOME);
            }

            if (
                $user->contact()->exists() &&
                $user->contact->company()->exists() &&
                $user->contact->company->associate()->exists() &&
                ($user->is_active == self::IT_IS_ACTIVE) &&
                (Auth::user()->role->slug == 'associado-usuario')
            ) {
                return redirect()->intended(RouteServiceProvider::HOME);
            }

            return redirect()->intended(RouteServiceProvider::HOME);
        }
        else {

            Auth::guard('web')->logout();
            
            $request->session()->invalidate();
            
            $request->session()->regenerateToken();

            session()->flash('message', 'Acesso não permitido, entre em contato com a INTEC.');

            return redirect()->route('login');
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
