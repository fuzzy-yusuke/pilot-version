<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Tenants extends Model
{
    use HasFactory;
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
}
