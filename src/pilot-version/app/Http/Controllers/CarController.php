<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_Cars;

class CarController extends Controller
{
    public function index()
    {
        $cars = M_Cars::all();
        //dd($cars);
        return view('tenant.car', ['cars' => $cars]);
    }
}
