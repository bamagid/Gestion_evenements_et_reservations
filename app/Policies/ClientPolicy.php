<?php

namespace App\Policies;

use App\Models\Client;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class ClientPolicy
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
    public function view(Client $client)
    {
       return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Client $client)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Client $client, Client $clients)
    {
        return $client->id === $clients->id
            ?
            Response::Allow()
            :
            Response::Deny("Vous ne pouvez pas modifier les  informations de cet utilisateur");
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Client $client, Client $clients)
    {
        return $client->id === $clients->id
        ?
        Response::Allow()
        :
        Response::Deny("Vous ne pouvez pas supprimer les  informations de cet utilisateur");
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Client $client) 
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Client $client)
    {
        //
    }
}
