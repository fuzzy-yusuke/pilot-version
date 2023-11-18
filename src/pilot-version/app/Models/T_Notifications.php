<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T_Notifications extends Model
{
    use HasFactory;
    protected $table = 't_notifications';
    protected $fillable = [
        'type',
        'content',
        'is_read',
    ];

    //外部キーの設定
    public function m_tenants()
    {
        return $this->belongsTo(M_Tenants::class, 'tenant_id');
    }
}
