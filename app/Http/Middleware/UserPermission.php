<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Permission;

class UserPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        session()->forget('user_permissions');

        if (Auth::user()) {
            $permissions = Permission::with(['roles' =>function ($query) {
                $query->where('role_id', Auth::user()->role->id);
            }])->with('menu')->get()->groupBy('menu_id');

            session(['user_permissions' => $permissions]);
        } else {
            session(['user_permissions' => []]);
        }

        return $next($request);
    }
}
