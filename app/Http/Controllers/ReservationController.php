<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Notifications\DenyReservationNotification;
use App\Notifications\NewReservationNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::where('client_id', Auth::guard('client')->user()->id)->orderBy('id', 'DESC')->get();
        return view('reservations.myreservations', compact(['reservations']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_de_place' => ['required', 'numeric', 'min:1'],
        ]);
        $reservation = Reservation::create([
            'client_id' => Auth::guard('client')->user()->id,
            'nombre_de_place' => $request->nombre_de_place,
            'evenement_id' => $request->evenement_id,
            'reference' => Str::random(10),
        ]);
        if ($reservation->save()) {
            $reservation->client->notify(new NewReservationNotification($reservation->id));
            return redirect('/')->with('status', 'Reservation effectué avec succées');
        } else {

            return back()->with('error', 'La reservation a echoué veuillez reesayer svp');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $reservations = Reservation::where('evenement_id', $request->id)->get();
        // $this->authorize('update',$reservations->evenement,'association');
        return view('reservations.eventReservations', compact(['reservations']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
    }


    public function decline(Request $request)
    {
        $reservation = Reservation::findOrFail($request->id);
        if ($reservation->evenement->association_id === Auth::guard('association')->user()->id) {
            // $this->authorize('update',$reservation->evenement,'association');
            $reservation->update(['est_accepte_ou_pas' => 0]);
                $reservation->client->notify(new DenyReservationNotification($reservation->id));
                return redirect('/dashboard')->with('status', 'La reservation a été annulée!');
        }


        abort(403, "Vous n'avez pas le droit pour modifier cet evenement");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
