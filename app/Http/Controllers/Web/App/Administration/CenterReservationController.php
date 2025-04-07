<?php

namespace App\Http\Controllers\Web\App\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CenterReservationController extends Controller
{
    public function index()
    {
        return view('app.administration.reservation.index');
    }
}
