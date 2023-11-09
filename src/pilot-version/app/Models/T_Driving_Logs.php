<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T_Driving_Logs extends Model
{
    use HasFactory;
    protected $fillable = [
        'driving_date',
        'destination',
        'departure_time',
        'arrival_time',
        'start_mileage',
        'end_mileage',
        'fuel',
        'license_confirmation',
        'license_confirmer_id',
        'pre_alcohol_check',
        'pre_alcohol_checker_id',
        'post_alcohol_check',
        'post_alcohol_checker_id',
        'return_driver_id',
    ];
}
