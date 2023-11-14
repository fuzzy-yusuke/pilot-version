<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Tenants extends Model
{
    use HasFactory;

    use HasUuids;

    protected $table = 'm_tenants';
    protected $primaryKey = 'tenant_id';

    protected $fillable = [
        'tenant_name1',
        'tenant_name2',
        'start_date',
        'end_date',
        'admin_email',
        'number_of_users',
        'phone_number',
        'fax_number',
        'postal_code',
        'address1',
        'address2',
        'address3',
        'representative',
        'contact_person',
        'Invoice_Issuer',
    ];

    //外部キーの設定
    public function m_users()
    {
        return $this->hasMany(M_Users::class);
    }
    public function m_tenant_control()
    {
        return $this->hasMany(M_Tenant_Control::class);
    }
    public function m_departments()
    {
        return $this->hasMany(M_Departments::class);
    }
    public function m_cars()
    {
        return $this->hasMany(M_Cars::class);
    }
    public function t_driving_logs()
    {
        return $this->hasMany(T_Driving_Logs::class);
    }
    public function t_pdf_file_headers()
    {
        return $this->hasMany(T_Pdf_File_Headers::class);
    }
    public function t_pdf_file_body()
    {
        return $this->hasMany(T_Pdf_File_Body::class);
    }
    public function t_activity_logs()
    {
        return $this->hasMany(T_Activity_Logs::class);
    }
    public function t_notifications()
    {
        return $this->hasMany(T_Notifications::class);
    }
}
