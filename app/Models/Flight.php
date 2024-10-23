<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $fillable = [
        'flight_name',
        'takeoff_location',
        'landing_location',
        'operating_days',
        'created_at',
        'updated_at'
    ];
}
