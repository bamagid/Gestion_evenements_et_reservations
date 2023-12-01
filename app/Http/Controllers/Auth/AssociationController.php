<?php

namespace App\Http\Controllers\auth;

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

class AssociationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

   
     /**
     * Display the association registration view.
     */
    public function create(): View
    {
        return view('auth.registeradmin');
    }

    /**
     * Handle an incoming association registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'Nom' => ['required', 'regex:/^[a-zA-Z ]+$/', 'max:255'],
            'Date_creation' => ['required', 'date'],
            'slogan'=>['required','regex:/^[a-zA-Z ]+$/','max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Client::class,'unique:'.Association::class],
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

            return redirect('/dashboard');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Association $association)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Association $association)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Association $association)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Association $association)
    {
        //
    }

    public function destroy1(Request $request){
       
        Auth::guard('association')->logout();
        session()->invalidate();
 
        session()->regenerateToken();
 
        return redirect('/');

    }
}

