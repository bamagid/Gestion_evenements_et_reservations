<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Association;
use App\Models\Client;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $this->validate($request, [
            'email' => ['required', 'string'],
            'mot_de_passe' => ['required', 'string']
        ]);
        $users1 = Client::all();
        $users2 = Association::all();
            foreach ($users1 as  $user) {
                
                if (Hash::check($request->mot_de_passe, $user['mot_de_passe']) && $request->email === $user['email']) {
                    Auth::guard('client')->login($user);
                    return redirect()->intended('/');}
                
            } 
            
            foreach ($users2 as  $user1) {
                if (Hash::check($request->mot_de_passe, $user1['mot_de_passe']) && $request->email===$user1['email']) {
                    Auth::guard('association')->login($user);
                    return redirect('/');
                }
            }

            return 'Vos informations sont incorrects';
        
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
