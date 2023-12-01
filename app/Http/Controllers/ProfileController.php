<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Association;
use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Validation\Rules;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        if (Auth::guard('association')->user()) {
            return view('auth.registeradmin', [
                'ok'=>'ok',
                'user' => Auth::guard('association')->user(),
            ]);
        }elseif(Auth::guard('client')->user()) {

            return view('auth.register', [
                'ok'=>'ok',
                'user' => Auth::guard('client')->user(),
            ]);
        }
        abort(403, "Vous ne pouvez pas accedez a cette page");
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        if (Auth::guard('client')->user()) {
            $request->validate([
                'Nom' => ['required', 'Alpha', 'max:30'],
                'Prenom' => ['required', 'regex:/^[a-zA-Z ]+$/', 'max:80'],
                'Telephone'=>['numeric','regex:/^7[05768]{1}+[0-9]{7}$/'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            $client=Client::findOrFail(Auth::guard('client')->user()->id);
            $client->Nom=$request->Nom;
            $client->Prenom=$request->Prenom;
            if ($client->email !== $request->email) {
                $request->validate([
                    'email' => ['required', 'string', 'lowercase', 'email', 'max:255','unique:'.Client::class,'unique:'.Association::class],
                ]);
            }
            $client->email=$request->email;
            $client->password=Hash::make($request->password);
            $client->Telephone=$request->Telephone;
            $client->update();
            return redirect('/')->with('status', 'Bravo vos informations ont été mise a jour avec succéss');
        }elseif (Auth::guard('association')->user()) {
            $request->validate([
                'Nom' => ['required', 'regex:/^[a-zA-Z ]+$/', 'max:255'],
                'Date_creation' => ['required', 'date'],
                'slogan'=>['required','regex:/^[a-zA-Z ]+$/','max:255'],
                'logo'=>'sometimes',
                'password' => ['required', 'confirmed', Rules\Password::defaults()]
            ]);
            // $id=;
     $association=Association::findOrFail(Auth::guard('association')->user()->id);
           
        if($request->file('logo')){
            Storage::delete('/public/logos/'.$association->logo);
            $file= $request->file('logo');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('logos'),$filename);
            $association->logo= $filename;
        }
            $association->Nom = $request->Nom;
            $association->Date_creation = $request->Date_creation;
            $association->slogan=$request->slogan;
            if($association->email !== $request->email) {
                $request->validate([
                    'email' => ['required', 'string', 'lowercase', 'email', 'max:255','unique:'.Client::class,'unique:'.Association::class],
                ]);
            }
            $association->email=$request->email;
            $association->password=Hash::make($request->password);
            $association->update();
            return Redirect::route('dashboard')->with('status', 'Bravo vos informations ont été mise a jour avec succéss');
        }

    }

    public function delete(){
        if (Auth::guard('association')->user()) {
            return view('profile.edit', [
                'user' => Auth::guard('association')->user(),
            ]);
        }elseif(Auth::guard('client')->user()) {
            return view('profile.edit', [
                'ok'=>'ok',
                'user' =>Auth::guard('client')->user(),
            ]);
        }
        abort(403, "Vous ne pouvez pas accedez a cette page");

    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        if (Auth::guard('association')->user()) {
            // dd($request);
            if (Hash::check($request->password,Auth::guard('association')->user()->password)===false) {
                return back()->with('status','Le mot de passe est incorrect');
            }
            
            $user=Association::findOrFail(Auth::guard('association')->user()->id);
            Auth::guard('association')->logout();
            $user->delete();

    
            $request->session()->invalidate();
            $request->session()->regenerateToken();
    
            return Redirect::to('/');
        }
        if (Auth::guard('client')->user()) {
            // dd($request);
            if (Hash::check($request->password,Auth::guard('client')->user()->password)===false) {
                return back()->with('status','Le mot de passe est incorrect');
            }
            
            $user=Client::findOrFail(Auth::guard('client')->user()->id);
            Auth::guard('client')->logout();
            $user->delete();

    
            $request->session()->invalidate();
            $request->session()->regenerateToken();
    
            return Redirect::to('/');
        }

       
    }
}
