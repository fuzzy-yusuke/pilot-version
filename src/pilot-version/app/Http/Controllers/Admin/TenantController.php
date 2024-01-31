<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\M_Tenants;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TenantController extends Controller
{
    public function index(Request $request)
    {
        $index = M_Tenants::query();
        $keyword = $request->input('keyword');
        if (!empty($keyword)) {
            $tenants = $index->where(function ($query) use ($keyword) {
                $query->where('tenant_name1', 'LIKE', "%{$keyword}%")
                    ->orWhere('tenant_name2', 'LIKE', "%{$keyword}%")
                    ->orWhere('admin_email', 'LIKE', "%{$keyword}%");
            })->get();
        } else {
            $tenants = M_Tenants::all();
        }
        return view('admin.tenant', ['tenants' => $tenants]);
    }

    public function create(Request $request)
    {
        $tenant = new M_Tenants();
        $user = Auth::user();
        $tenant->tenant_id = (string)Str::uuid();
        $tenant->tenant_name1 = $request->tenant_name1;
        $tenant->tenant_name2 = $request->tenant_name2;
        $tenant->start_date = $request->start_date;
        $tenant->end_date = $request->end_date;
        $tenant->admin_email = $request->admin_email;
        $tenant->number_of_users = $request->number_of_users;
        $tenant->phone_number = $request->phone_number;
        $tenant->fax_number = $request->fax_number;
        $tenant->postal_code = $request->postal_code;
        $tenant->address1 = $request->address1;
        $tenant->address2 = $request->address2;
        $tenant->address3 = $request->address3;
        $tenant->representative = $request->representative;
        $tenant->contact_person = $request->contact_person;
        $tenant->Invoice_Issuer = $request->Invoice_Issuer;
        $tenant->updated_by = $user->user_name;
        $tenant->update_program = $request->update_program;
        $tenant->save();
        return redirect()->route('admin.tenant');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        M_Tenants::where('tenant_id', $request->tenant_id)->update([
            'tenant_name1' => $request->tenant_name1,
            'tenant_name2' => $request->tenant_name2,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'admin_email' => $request->admin_email,
            'number_of_users' => $request->number_of_users,
            'phone_number' => $request->phone_number,
            'fax_number' => $request->fax_number,
            'postal_code' => $request->postal_code,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'address3' => $request->address3,
            'representative' => $request->representative,
            'contact_person' => $request->contact_person,
            'Invoice_Issuer' => $request->Invoice_Issuer,
            'updated_by' => $user->user_name,
            'update_program' => $request->update_program
        ]);
        return redirect()->route('admin.tenant');
    }

    public function delete(Request $request)
    {
        M_Tenants::where('tenant_id', $request->tenant_id)->delete();
        return redirect()->route('admin.tenant');
    }
}
