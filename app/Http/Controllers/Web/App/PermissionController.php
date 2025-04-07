<?php

namespace App\Http\Controllers\Web\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use App\Models\Menu;

class PermissionController extends Controller
{
    public function index()
    {
        $level = auth()->user()->role->level;
        $permissions = Permission::with('menu')->where('level', '>=', $level)->get();

        return view('app.permission.index', [
            'permissions' => $permissions
        ]);
    }

    public function create()
    {
        $menus = Menu::all();

        return view('app.permission.create', [
            'menus' => $menus,
        ]);
    }

    public function store(PermissionRequest $request)
    {
        Permission::create($request->validated());

        return redirect()->route('permission.index')->withSuccess('Permiso creado correctamente.');
    }

    public function edit(Request $request, $id)
    {
        $request->merge(['id' => $id]);
        $request->validate([
            'id' => 'required|integer|exists:permissions,id'
        ], [
            'id.required' => 'El ID es obligatorio.',
            'id.integer' => 'El ID debe ser un número entero.',
            'id.exists' => 'El ID no existe en la base de datos.'
        ]);

        $permission = Permission::find($id);
        $menus = Menu::all();

        return view('app.permission.edit', [
            'permission' => $permission,
            'menus' => $menus,
        ]);
    }

    public function update(PermissionRequest $request)
    {
        $permission = Permission::find($request->id);

        $active = $request->active ? 1 : 0;
        $request->merge(['active' => $active]);

        $permission->update($request->all());

        return redirect()->route('permission.index')->withSuccess('Permiso actualizado correctamente.');
    }
}
