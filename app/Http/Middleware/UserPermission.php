<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

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
            $role = Role::with('permissions')->where('id', Auth::user()->role->id)->first();
            $permissions = $role->permissions->groupBy('menu_id');

            session(['user_permissions' => $permissions]);
        } else {
            session(['user_permissions' => []]);
        }

        return $next($request);
    }
}
