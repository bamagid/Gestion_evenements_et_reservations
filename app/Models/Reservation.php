<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Notifications\Notifiable;

class Reservation extends Model
{
    use HasFactory,Notifiable;
    protected $fillable = [
        'client_id',
        'reference',
        'evenement_id',
        'nombre_de_place',
        'est_accepte_ou_pas'
        ];

        public function evenement()
    {
        return $this->belongsTo(Evenement::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
