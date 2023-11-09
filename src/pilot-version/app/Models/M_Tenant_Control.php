<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Tenant_Control extends Model
{
    use HasFactory;
    protected $fillable = [
        'tenant_name1',
        'tenant_name2',
        'processing_date',
        'processing_time',
        'phone_number',
        'fax_number',
        'postal_code',
        'address1',
        'address2',
        'address3',
        'Invoice_Issuer',
    ];
}
