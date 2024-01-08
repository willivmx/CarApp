<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class abonnés extends Model
{
    use HasFactory;
    protected $table = "abonnés";
    protected $fillable = ['nom','prenom','email','numéro'];
}
