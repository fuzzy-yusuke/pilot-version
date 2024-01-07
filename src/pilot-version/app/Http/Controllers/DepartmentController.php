<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\M_Departments;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $index = M_Departments::query();
        $keyword = $request->input('keyword');
        if (!empty($keyword)) {
            $departments = $index->where(function ($query) use ($keyword) {
                $query->where('department_name', 'LIKE', "%{$keyword}%")
                    ->orWhere('parent_department_id', 'LIKE', "%{$keyword}%")
                    ->orWhere('phone_number', 'LIKE', "%{$keyword}%")
                    ->orWhere('address1', 'LIKE', "%{$keyword}%")
                    ->orWhere('address2', 'LIKE', "%{$keyword}%")
                    ->orWhere('address3', 'LIKE', "%{$keyword}%");
            })->get();
        } else {
            $departments = M_Departments::all();
        }
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

    public function update(Request $request)
    {
        $user = Auth::user();
        M_Departments::where('department_id', $request->department_id)->update([
            'department_name' => $request->department_name,
            'phone_number' => $request->phone_number,
            'fax_number' => $request->fax_number,
            'postal_code' => $request->postal_code,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'address3' => $request->address3,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'updater' => $user->user_name,
            'update_program' => $request->update_program
        ]);
        return redirect()->route('tenant.department');
    }
}
