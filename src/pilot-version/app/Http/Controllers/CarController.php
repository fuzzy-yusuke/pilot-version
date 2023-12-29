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

    public function edit(M_Cars $car)
    {
        return view('tenant.car', ['car' => $car]);
    }

    public function update(Request $request, M_Cars $car)
    {
        $car->car = $request->car;
        $car->save();
        return redirect('tenant.car');
    }
}
