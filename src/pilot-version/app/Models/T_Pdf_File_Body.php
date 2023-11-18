<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T_Pdf_File_Body extends Model
{
    use HasFactory;
    protected $table = 't_pdf_file_body';
    protected $fillable = [
        'key',
        'value',
        'remarks1',
        'remarks2',
    ];

    //外部キーの設定
    public function m_tenants()
    {
        return $this->belongsTo(M_Tenants::class, 'tenant_id');
    }
}
