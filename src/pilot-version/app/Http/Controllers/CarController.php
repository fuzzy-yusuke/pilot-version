<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_Cars;

class CarController extends Controller
{
    public function index()
    {
        $cars = M_Cars::all();
        return view('tenant.car', ['cars' => $cars]);
    }

    public function update(Request $request)
    {
        M_Cars::where('car_id', $request->car_id)->update([
            'number_plate' => $request->number_plate,
            'car_type' => $request->car_type,
            'start_date' => $request->start_date
        ]);
        return redirect()->route('tenant.car');
    }
}
