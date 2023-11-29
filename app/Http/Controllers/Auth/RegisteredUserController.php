<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Association;
use App\Models\Client;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {   
        
        $request->validate([
            'Nom' => ['required', 'string', 'max:255'],
            'Prenom' => ['required', 'string', 'max:255'],
            'Telephone'=>'numeric',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255','unique:'.Client::class,'unique:'.Association::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $user = Client::create([
            'Nom' => $request->Nom,
            'Prenom' => $request->Prenom,
            'Telephone'=>$request->Telephone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
            
          if ($user->save()) {
            Auth::guard('client')->login($user);
    
            return redirect(RouteServiceProvider::HOME);
          }  ;
    }
}
