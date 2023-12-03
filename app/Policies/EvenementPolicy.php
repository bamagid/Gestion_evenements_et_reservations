<?php

namespace App\Policies;

use App\Models\Association;
use App\Models\Evenement;
use Illuminate\Auth\Access\Response;

class EvenementPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Association $association)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Association $association, Evenement $evenement)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Association $association)
    {
       return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Association $association, Evenement $evenement)
    {
        return  $association->id === $evenement->association_id
        ?
        Response::Allow()
        :
        Response::Deny("Vous n'avez pas les droits pour modifier les  informations de cet evenement");
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Association $association, Evenement $evenement)
    {
        return  $association->id === $evenement->association_id
        ?
        Response::Allow()
        :
        Response::Deny("Vous n'avez pas les droits pour supprimer cet evenement");
    }


       /**
     * Determine whether the user can update th reservation model.
     */
    public function declineReservation(Association $association, Evenement $evenement)
    {
        return  $association->id === $evenement->reservations->association_id
        ?
        Response::Allow()
        :
        Response::Deny("Vous n'avez pas les droits pour supprimer cet evenement");
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Association $association, Evenement $evenement)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Association $association, Evenement $evenement)
    {
        //
    }
}
