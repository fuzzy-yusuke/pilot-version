<?php

namespace App\Http\Controllers;

use App\Models\M_Cars;
use App\Models\T_Driving_Logs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\M_Departments;
use App\Models\M_Users;

class DrivingLogController extends Controller
{

    public function index(Request $request)
    {
        $cars = M_Cars::all();
        $user = Auth::user();
        $users = M_Users::all();
        $index = T_Driving_Logs::query();
        $keyword = $request->input('keyword');
        if (!empty($keyword)) {
            $drivinglogs = $index->where(function ($query) use ($keyword) {
                $query->where('tenant_id', 'LIKE', "%{$keyword}%")
                    ->orWhere('driving_date', 'LIKE', "%{$keyword}%")
                    ->orWhere('updated_at', 'LIKE', "%{$keyword}%")
                    ->orWhere('user_id', 'LIKE', "%{$keyword}%");
            })->get();
        } else {
            $drivinglogs = T_Driving_Logs::all();
        }
        return view(
            'tenant.drivinglog',
            ['drivinglogs' => $drivinglogs, 'cars' => $cars, 'user' => $user, 'users' => $users]
        );
    }

    public function create(Request $request)
    {
        $car = new T_Driving_Logs();
        $user = Auth::user();
        $car->tenant_id = $user->tenant_id;
        $car->car_id = $request->car_id;
        $car->department_id = $request->department_id;
        $car->car_type = $request->car_type;
        $car->number_plate = $request->number_plate;
        $car->start_date = $request->start_date;
        $car->end_date = $request->end_date;
        $car->updated_by = $user->user_name;
        $car->update_program = $request->update_program;
        $car->save();
        return redirect()->route('tenant.drivinglog');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        T_Driving_Logs::where('log_id', $request->log_id)->update([
            'department_id' => $request->department_id,
            'car_type' => $request->car_type,
            'number_plate' => $request->number_plate,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'updated_by' => $user->user_name,
            'update_program' => $request->update_program
        ]);
        return redirect()->route('tenant.drivinglog');
    }

    public function delete(Request $request)
    {
        T_Driving_Logs::where('log_id', $request->log_id)->delete();
        return redirect()->route('tenant.drivinglog');
    }
}
