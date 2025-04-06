<?php

namespace App\Http\Controllers\Web\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return view('app.role.index', [
            'roles' => $roles
        ]);
    }

    public function create()
    {
        return view('app.role.create');
    }

    public function store(RoleRequest $request)
    {
        Role::create($request->all());

        return redirect()->route('role.index')->withSuccess('Rol creado correctamente.');
    }

    public function edit(Request $request, $id)
    {
        $request->merge(['id' => $id]);

        $request->validate([
            'id' => 'required|integer|exists:roles,id',
        ], [
            'id.required' => 'El ID es obligatorio.',
            'id.integer' => 'El ID debe ser un número entero.',
            'id.exists' => 'El rol no existe.',
        ]);

        $role = Role::find($id);

        return view('app.role.edit', [
            'role' => $role
        ]);
    }

    public function update(RoleRequest $request)
    {
        $active = $request->active ? 1 : 0;
        $request->merge(['active' => $active]);

        Role::find($request->id)->update($request->all());

        return redirect()->route('role.index')->withSuccess('Rol actualizado correctamente.');
    }

    public function detail(Request $request, $id)
    {
        $request->merge(['id' => $id]);

        $request->validate([
            'id' => 'required|integer|exists:roles,id',
        ], [
            'id.required' => 'El ID es obligatorio.',
            'id.integer' => 'El ID debe ser un número entero.',
            'id.exists' => 'El rol no existe.',
        ]);

        $role = Role::with('permissions')->find($id);
        $permissions = Permission::where('level', '>=', $role->level)->get();

        return view('app.role.detail', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    public function PermissionAssign(Request $request)
    {
        $request->validate([
            'role_id' => 'required|integer|exists:roles,id',
            'permissions' => 'required|array',
            'permissions.*' => 'integer|exists:permissions,id',
        ], [
            'role_id.required' => 'El ID del rol es obligatorio.',
            'role_id.integer' => 'El ID del rol debe ser un número entero.',
            'role_id.exists' => 'El rol no existe.',
            'permissions.required' => 'Los permisos son obligatorios.',
            'permissions.array' => 'Los permisos deben ser un arreglo.',
            'permissions.*.integer' => 'Cada permiso debe ser un número entero.',
            'permissions.*.exists' => 'Uno o más permisos no existen.',
        ]);

        Role::find($request->role_id)->permissions()->sync($request->permissions);

        return redirect()->back()->withSuccess('Permisos asignados correctamente.');
    }
}
