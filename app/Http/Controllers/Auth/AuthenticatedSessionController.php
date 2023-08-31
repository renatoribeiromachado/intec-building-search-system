<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Associate;
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
        $authUser = Auth::user();

        if ($authUser->is_active == self::IT_IS_ACTIVE) {

            if (
                $authUser->contact()->exists() &&
                $authUser->contact->company()->exists() &&
                ($authUser->contact->company->is_active == self::IT_IS_NOT_ACTIVE)
            ) {
                Auth::guard('web')->logout();
            
                $request->session()->invalidate();
                
                $request->session()->regenerateToken();
    
                session()->flash('message', 'Acesso não permitido, entre em contato com a INTEC.');
    
                return redirect()->route('login');
            }

            // // valid for associate managers and common associate users
            // if (
            //     $authUser->contact()->exists() &&
            //     $authUser->contact->company()->exists() &&
            //     $authUser->contact->company->associate()->exists() &&
            //     ($authUser->is_active == self::IT_IS_NOT_ACTIVE)
            // ) {
            //     Auth::guard('web')->logout();
            
            //     $request->session()->invalidate();
                
            //     $request->session()->regenerateToken();
    
            //     session()->flash('message', 'Acesso não permitido, entre em contato com a INTEC.');
    
            //     return redirect()->route('login');
            // }

            // Check user plan and set his restrictions
            if (authUserIsAnAssociate()) {

                $associateModel = $authUser->contact->company->associate;
                $associateSignInDueDate = optional($associateModel->data_filter_ends_at)
                    ->format('Y-m-d');
                $today = today()->format('Y-m-d');

                if ($today > $associateSignInDueDate) {
                    Auth::guard('web')->logout();
                    
                    $request->session()->invalidate();
                    
                    $request->session()->regenerateToken();
        
                    session()->flash('message', 'Acesso não permitido, entre em contato com a INTEC.');
        
                    return redirect()->route('login');
                }

                $statesVisible = $associateModel->states()->get()->pluck('id');
                $segmentSubTypesVisible = $associateModel->segmentSubTypes()->get()->pluck('id');

                request()->session()->put('statesVisible', $statesVisible);
                request()->session()->put('segmentSubTypesVisible', $segmentSubTypesVisible);
            }

            $theUserIsActiveAndIsAnAssociate = (
                $authUser->contact()->exists() &&
                $authUser->contact->company()->exists() &&
                $authUser->contact->company->associate()->exists() &&
                ($authUser->is_active == self::IT_IS_ACTIVE)
            );

            if (
                $theUserIsActiveAndIsAnAssociate &&
                ($authUser->role->slug == Associate::ASSOCIATE_MANAGER)
            ) {
                return redirect()->intended(RouteServiceProvider::HOME);
            }

            if (
                $theUserIsActiveAndIsAnAssociate &&
                ($authUser->role->slug == Associate::ASSOCIATE_USER)
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

        session()->flash('message', 'Acesso não permitido, entre em contato com a INTEC.');

        return redirect()->route('login');
    }
}
