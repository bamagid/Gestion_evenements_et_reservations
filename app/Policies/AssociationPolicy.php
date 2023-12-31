<?php

namespace App\Policies;

use App\Models\Association;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class AssociationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Association $association): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Association $association)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Association $association)
    {
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Association $association ,Association $associations)
    {
        return  $association->id === $associations->id
            ?
            Response::Allow()
            :
            Response::Deny("Vous ne pouvez pas modifier les  informations de cet utilisateur");
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Association $association ,Association $associations)
    {
        return  $association->id === $associations->id
            ?
            Response::Allow()
            :
            Response::Deny("Vous ne pouvez pas supprimer les  informations de cet utilisateur");
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Association $association)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Association $association)
    {
        //
    }
}
