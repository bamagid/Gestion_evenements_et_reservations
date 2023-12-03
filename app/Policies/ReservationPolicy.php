<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\Reservation;
use Illuminate\Auth\Access\Response;

class ReservationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Client $client)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Client $client, Reservation $reservation)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Client $client)
    {
        
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Client $client, Reservation $reservation)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Client $client, Reservation $reservation)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Client $client, Reservation $reservation)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Client $client, Reservation $reservation)
    {
        //
    }
}
