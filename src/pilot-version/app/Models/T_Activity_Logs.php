<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T_Activity_Logs extends Model
{
    use HasFactory;
    protected $table = 't_activity_logs';
    protected $fillable = [
        'activity_description',
        'timestamp',
        'json',
    ];

    //外部キーの設定
    public function m_tenants()
    {
        return $this->belongsTo(M_Tenants::class, 'tenant_id');
    }
}
