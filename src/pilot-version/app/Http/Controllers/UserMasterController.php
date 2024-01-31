<?php

namespace App\Http\Controllers;

use App\Models\M_Departments;
use App\Models\M_Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserMasterController extends Controller
{
    public function index(Request $request)
    {
        $departments = M_Departments::all();
        $index = M_Users::query();
        $keyword = $request->input('keyword');
        if (!empty($keyword)) {
            $members = $index->where(function ($query) use ($keyword) {
                $query->where('department_name', 'LIKE', "%{$keyword}%")
                    ->orWhere('number_plate', 'LIKE', "%{$keyword}%")
                    ->orWhere('user_name', 'LIKE', "%{$keyword}%");
            })->get();
        } else {
            $members = M_Users::all();
        }
        return view('tenant.user', ['members' => $members, 'departments' => $departments]);
    }

    public function create(Request $request)
    {
        $member = new M_Users();
        $user = Auth::user();
        $request->validate([
            'user_id' => 'required|unique:m_users',
            'email' => 'required|unique:m_users|email',
            'password' => 'required'
        ]);

        $member->tenant_id = $user->tenant_id;
        $member->user_id = $request->user_id;
        $member->department_id = $request->department_id;
        $member->user_name = $request->user_name;
        $member->email = $request->email;
        $member->password = Hash::make($request->password);
        $member->remember_token = Str::random(10);
        $member->role = $request->role;
        $member->start_date = $request->start_date;
        $member->end_date = $request->end_date;
        $member->updated_by = $user->user_name;
        $member->update_program = $request->update_program;
        $member->save();
        return redirect()->route('tenant.user');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'email' => 'required|unique:m_users|email',
        ]);
        M_Users::where('user_id', $request->user_id)->update([
            'department_id' => $request->department_id,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'role' => $request->role,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'updated_by' => $user->user_name,
            'update_program' => $request->update_program
        ]);
        return redirect()->route('tenant.user');
    }

    public function delete(Request $request)
    {
        M_Users::where('user_id', $request->user_id)->delete();
        return redirect()->route('tenant.user');
    }
}
