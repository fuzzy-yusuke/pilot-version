<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Departments extends Model
{
    use HasFactory;
    protected $fillable = [
        'department_name',
        'phone_number',
        'fax_number',
        'postal_code',
        'address1',
        'address2',
        'address3',
        'start_date',
        'end_date',
    ];

    //外部キーの設定
    public function m_tenants()
    {
        return $this->belongsTo(M_Tenants::class);
    }
}
