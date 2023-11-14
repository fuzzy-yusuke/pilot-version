<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T_Pdf_File_Headers extends Model
{
    use HasFactory;
    protected $table = 't_pdf_file_headers';
    protected $fillable = [
        'file_name',
        'uploaded_at',
        'email_data',
        'text_data',
        'remarks1',
        'remarks2',
        'logical_deletion',
    ];

    //外部キーの設定
    public function m_tenants()
    {
        return $this->belongsTo(M_Tenants::class);
    }
}
