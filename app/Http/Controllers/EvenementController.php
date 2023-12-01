<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class EvenementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evenements = Evenement::all();
        return view('welcome', compact('evenements'));
    }
    /**
     * Display a listing of the resource.
     */
    public function events()
    {
        $evenements = Evenement::all();
        return view('dashboard', compact('evenements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ok = "pas bon";
        return view('evenements.ajouter', compact('ok'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'libelle' => ['required', 'string', 'max:255'],
            'date_limite_inscription' => ['required', 'date'],
            'description' => ['required', 'string'],
            'image_mise_en_avant' => ['required', 'mimes:jpeg,png,jpg,gif,svg|max:10000'],
            'lieux' => 'required|string',
            'date_evenement' => ['required', 'date'],
        ]);
        if ($request->file('image_mise_en_avant')) {
            $file = $request->file('image_mise_en_avant');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('evenements'), $filename);
        }

        $evenement = Evenement::create([
            'libelle' => $request->libelle,
            'date_limite_inscription' => $request->date_limite_inscription,
            'description' => $request->description,
            'image_mise_en_avant' => $filename,
            'lieux' => $request->lieux,
            'association_id' => Auth::guard('association')->user()->id,
            'date_evenement' => $request->date_evenement,
        ]);
        if ($evenement->save()) {
            return redirect('/dashboard')->with("status", "Evenement ajouté avec succés");
        } else {
            return back()->with("status", "Erreur lors de l'ajout de l'evenement veuillez reessayez svp");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $evenements=Evenement::where('association_id',Auth::guard('association')->user()->id)->get();
        return view('evenements.myevents',compact('evenements'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $evenement = Evenement::findOrFail($id);
        $ok = 'ok';
        return view('evenements.ajouter', compact('evenement', 'ok'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evenement $evenement)
    {
        $request->validate([
            'libelle' => ['required', 'string', 'max:255'],
            'date_limite_inscription' => ['required', 'date'],
            'description' => ['required', 'string'],
            'image_mise_en_avant' => ['sometimes'],
            'lieux' => 'required|string',
            'date_evenement' => ['required', 'date'],
        ]);

        $evenement = Evenement::findOrFail($request->id);
        if ($request->file('image_mise_en_avant')) {
            if (File::exists(public_path('evenements/' . $evenement->image_mise_en_avant))) {
                File::delete(public_path('images/' . $evenement->image_mise_en_avant));
            }
            $file = $request->file('image_mise_en_avant');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('evenements'), $filename);
            $evenement->image_mise_en_avant = $filename;
        }


        $evenement->libelle = $request->libelle;
        $evenement->date_limite_inscription = $request->date_limite_inscription;
        $evenement->description = $request->description;
        $evenement->lieux = $request->lieux;
        $evenement->association_id = Auth::guard('association')->user()->id;
        $evenement->date_evenement = $request->date_evenement;

        if ($evenement->update()) {
            return redirect('/dashboard')->with("status", "Evenement modifié avec succés");
        } else {
            return back()->with("status", "Erreur lors de la modification de l'evenement veuillez reessayez svp");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function cloture($id)
    {
        $evenement = Evenement::findOrFail($id);
        $evenement->update(['est_cloture_ou_pas' => 1]);
        return back()->with("status", "Evenement cloturé avec succés");;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $evenement = Evenement::findOrFail($id);
        $evenement->delete();
        return back()->with("status", "Evenement Supprimé avec succés");
    }
}
