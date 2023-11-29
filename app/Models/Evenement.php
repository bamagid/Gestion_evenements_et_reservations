<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{

    protected $fillabe =[
        "libelle",
        "date_limite_inscription",
        'description',
        'image_mise_en_avant',
        'est_cloture_ou_pas',
        'association_id',
        'date_evenement'

    ];
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
