<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{

    protected $fillable =[
        'libelle',
        'date_limite_inscription',
        'description',
        'image_mise_en_avant',
        'est_cloture_ou_pas',
        'association_id',
        'date_evenement',
        'lieux'

    ];
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    public function association(){
        return $this->belongsTo(Association::class,'association_id');
        }
}
