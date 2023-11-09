<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T_Activity_Logs extends Model
{
    use HasFactory;
    protected $fillable = [
        'activity_description',
        'timestamp',
        'json',
    ];
}
