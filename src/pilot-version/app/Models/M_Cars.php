<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Cars extends Model
{
    use HasFactory;
    protected $table = 'm_cars';
    protected $fillable = [
        'car_type',
        'number_plate',
        'manager',
        'start_date',
        'end_date',
        'department_id',
    ];

    //外部キーの設定
    public function m_tenants()
    {
        return $this->belongsTo(M_Tenants::class);
    }
}
