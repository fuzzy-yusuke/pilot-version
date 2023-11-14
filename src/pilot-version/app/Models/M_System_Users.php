<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_System_Users extends Model
{
    use HasFactory;
    protected $table = 'm_system_users';
    protected $fillable = [
        'sys_user_name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
