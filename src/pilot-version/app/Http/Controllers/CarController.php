<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\M_Cars;
use App\Models\M_Departments;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $departments = M_Departments::all();
        $index = M_Cars::query();
        $keyword = $request->input('keyword');
        if (!empty($keyword)) {
            $cars = $index->where(function ($query) use ($keyword) {
                $query->where('department_name', 'LIKE', "%{$keyword}%")
                    ->orWhere('number_plate', 'LIKE', "%{$keyword}%")
                    ->orWhere('car_type', 'LIKE', "%{$keyword}%");
            })->get();
        } else {
            $cars = M_Cars::all();
        }
        return view('tenant.car', ['cars' => $cars, 'departments' => $departments]);
    }

    public function create(Request $request)
    {
        $car = new M_Cars();
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
        return redirect()->route('tenant.car');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        M_Cars::where('car_id', $request->car_id)->update([
            'department_id' => $request->department_id,
            'car_type' => $request->car_type,
            'number_plate' => $request->number_plate,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'updated_by' => $user->user_name,
            'update_program' => $request->update_program
        ]);
        return redirect()->route('tenant.car');
    }

    public function delete(Request $request)
    {
        M_Cars::where('car_id', $request->car_id)->delete();
        return redirect()->route('tenant.car');
    }
}
