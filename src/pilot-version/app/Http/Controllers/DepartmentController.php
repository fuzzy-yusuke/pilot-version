<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\M_Departments;
use App\Models\M_Tenants;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = M_Departments::all();
        return view('tenant.department', ['departments' => $departments]);
    }

    public function create(Request $request)
    {
        $department = new M_Departments();
        $user = Auth::user();
        $department->tenant_id = $user->tenant_id;
        $department->department_id = $request->department_id;
        $department->department_name = $request->department_name;
        $department->phone_number = $request->phone_number;
        $department->fax_number = $request->fax_number;
        $department->postal_code = $request->postal_code;
        $department->address1 = $request->address1;
        $department->address2 = $request->address2;
        $department->address3 = $request->address3;
        $department->start_date = $request->start_date;
        $department->end_date = $request->end_date;
        $department->updater = $user->user_name;
        $department->update_program = $request->update_program;
        $department->save();
        return redirect()->route('tenant.department');
    }
}