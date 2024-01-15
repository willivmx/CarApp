<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'car_id', 'location_date', 'return_date', 'location_amount', 'status', 'comment'
    ];
}
