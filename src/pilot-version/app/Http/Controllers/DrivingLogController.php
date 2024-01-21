<?php

namespace App\Http\Controllers;

use App\Models\M_Cars;
use App\Models\T_Driving_Logs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\M_Users;
use Illuminate\Support\Str;

class DrivingLogController extends Controller
{

    public function index(Request $request)
    {
        $cars = M_Cars::all();
        $user = Auth::user();
        $members = M_Users::all();
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
            ['drivinglogs' => $drivinglogs, 'cars' => $cars, 'user' => $user, 'members' => $members]
        );
    }

    public function create(Request $request)
    {
        $drivinglogs = new T_Driving_Logs();
        $user = Auth::user();
        $drivinglogs->tenant_id = $user->tenant_id;
        $drivinglogs->log_id = (string)Str::uuid();
        $drivinglogs->user_id = $request->user_id;
        $drivinglogs->car_id = $request->car_id;
        $drivinglogs->driving_date = $request->driving_date;
        $drivinglogs->license_confirmation = $request->license_confirmation;
        $drivinglogs->departure_time = $request->departure_time;
        $drivinglogs->arrival_time = $request->arrival_time;
        $drivinglogs->destination = $request->destination;
        $drivinglogs->start_mileage = $request->start_mileage;
        $drivinglogs->end_mileage = $request->end_mileage;
        $drivinglogs->fuel = $request->fuel;
        $drivinglogs->pre_alcohol_checker_id = $request->pre_alcohol_checker_id;
        $drivinglogs->pre_alcohol_check = $request->pre_alcohol_check;
        $drivinglogs->post_alcohol_checker_id = $request->post_alcohol_checker_id;
        $drivinglogs->post_alcohol_check = $request->post_alcohol_check;
        $drivinglogs->updated_by = $user->user_name;
        $drivinglogs->update_program = $request->update_program;
        $drivinglogs->save();
        return redirect()->route('tenant.drivinglog');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        T_Driving_Logs::where('log_id', $request->log_id)->update([
            'departure_time' => $request->departure_time,
            'arrival_time' => $request->arrival_time,
            'destination' => $request->destination,
            'start_mileage' => $request->start_mileage,
            'end_mileage' => $request->end_mileage,
            'fuel' => $request->fuel,
            'post_alcohol_checker_id' => $request->post_alcohol_checker_id,
            'post_alcohol_check' => $request->post_alcohol_check,
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
