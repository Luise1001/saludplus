<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckHospital
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        session()->forget('medical_center_id');
        session()->forget('medical_center');
        
        $medical_center_id = auth()->user()->medicalCenter->id ?? null;
        $medical_center = auth()->user()->medicalCenter->name ?? null;
        
        if (!$medical_center_id) {
            return redirect()->route('dashboard')->withErrors('No cuenta con un centro médico asignado');
        }

        session(['medical_center_id' => $medical_center_id, 'medical_center' => $medical_center]);

        return $next($request);
    }
}
