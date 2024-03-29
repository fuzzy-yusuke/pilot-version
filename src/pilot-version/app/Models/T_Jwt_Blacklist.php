<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T_Jwt_Blacklist extends Model
{
    use HasFactory;
    protected $table = 't_jwt_blacklist';
    protected $fillable = [
        'jti',
        'token',
        'expiry',
    ];
}
