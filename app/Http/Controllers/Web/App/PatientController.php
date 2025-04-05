<?php

namespace App\Http\Controllers\Web\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $document = request()->input('document');

        return view('app.patients.register', [
            'document' => $document
        ]);
    }

    public function register(Request $request)
    {
        dd($request->all());
    }
}
