<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T_Driving_Logs extends Model
{
    use HasFactory;
    protected $table = 't_driving_logs';
    protected $primaryKey = ['tenant_id', 'log_id'];
    protected $keyType = 'string';
    public $incrementing = false;
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

    //外部キーの設定
    public function m_tenants()
    {
        return $this->belongsTo(M_Tenants::class, 'tenant_id');
    }

    //ユーザーテーブルの設定
    public function m_users()
    {
        return $this->belongsTo(M_Users::class, 'user_id');
    }

    //営業車テーブルの設定
    public function m_cars()
    {
        return $this->belongsTo(M_Cars::class, 'car_id');
    }
}
