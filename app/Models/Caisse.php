<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caisse extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',

        'solde_especes_initial',
        'solde_momo_initial',

        'apport_espece',
        'apport_momo',

        'vente_espece',
        'vente_momo',

        'decaissement_espece',
        'decaissement_momo',

        'solde_especes_final',
        'solde_momo_final',
        
        'operateur',
        'status',
    ];

    
}
