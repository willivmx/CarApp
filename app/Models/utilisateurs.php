<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class utilisateurs extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom', 'prenom', 'email', 'password', 'role'
        // Ajoutez d'autres attributs selon vos besoins
    ];
}
