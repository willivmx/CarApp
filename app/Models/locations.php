<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class locations extends Model
{
    use HasFactory;
    protected $fillable = [
        'utilisateur_id', 'voiture_id', 'date_debut', 'date_fin', 'cout', 'statut'
    ];
}
