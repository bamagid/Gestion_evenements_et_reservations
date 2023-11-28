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
     * Display the association registration view.
     */
    public function create1(): View
    {
        return view('auth.registeradmin');
    }

    /**
     * Handle an incoming association registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store1(Request $request): RedirectResponse
    {
        $request->validate([
            'Nom' => ['required', 'string', 'max:255'],
            'Date_creation' => ['required', 'string', 'max:255'],
            'slogan'=>'required|string',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Client::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        if($request->file('logo')){
            $file= $request->file('logo');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('logos'),$filename);

        }

        $association = Association::create([
            'Nom' => $request->Nom,
            'Date_creation' => $request->Date_creation,
            'slogan'=>$request->slogan,
            'logo'=> $filename,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
      

        if ($association->save()) {

        Auth::guard('association')->login($association);

        return redirect(RouteServiceProvider::ADMIN_HOME);
        }
    }


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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Client::class],
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
