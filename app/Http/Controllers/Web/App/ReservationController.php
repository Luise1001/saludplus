<?php

namespace App\Http\Controllers\Web\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        return view('app.patients.reserve');
    }

    public function reserve(Request $request)
    {
        dd($request->all());
    }

    public function sheet()
    {
        return view('app.patients.sheet');
    }
}
