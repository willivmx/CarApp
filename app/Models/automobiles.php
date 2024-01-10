<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class automobiles extends Model
{
    use HasFactory;
    protected $fillable = [
        'marque', 'modele', 'annee_fabrication', 'numero_plaque', 'couleur', 'type_carburant',
        'kilometrage', 'statut'
    ];
}
