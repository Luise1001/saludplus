<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permissions): Response
    {
        $PermissionsOnSession = session('user_permissions');
        $permissionsArray = explode('-', $permissions);

        $hasPermission = false;
        foreach ($permissionsArray as $row) {
            foreach ($PermissionsOnSession as $permissions) {
                $permission = $permissions->where('name', $row)->first();

                if ($permission) {
                    $hasPermission = true;
                    break;
                }
            }
        }

        if (!$hasPermission) {
            return redirect('/dashboard')->withErrors([
                'error' => 'No tienes permiso para acceder a esta sección.',
            ]);
        }

        return $next($request);
    }
}
