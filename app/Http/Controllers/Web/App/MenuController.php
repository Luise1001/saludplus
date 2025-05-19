<?php

namespace App\Http\Controllers\Web\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function  index()
    {
        $menus = Menu::all();

        return view('app.menu-manage.index', [
            'menus' => $menus
        ]);
    }

    public function create()
    {
        return view('app.menu-manage.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'icon_items' => 'required|numeric|integer|min:1|max:10',
        ], [
            'name.required' => 'El nombre del menú es obligatorio.',
            'icon.required' => 'El icono del menú es obligatorio.',
            'icon_items.required' => 'El número de iconos es obligatorio.',
            'icon_items.numeric' => 'El número de iconos debe ser un número.',
            'icon_items.integer' => 'El número de iconos debe ser un número entero.',
            'icon_items.min' => 'El número de iconos debe ser al menos 1.',
            'icon_items.max' => 'El número de iconos no puede ser mayor a 10.',
        ]);

        Menu::create($request->all());

        return redirect()->route('menu.index')->withSuccess('Menú creado correctamente.');
    }

    public function edit(Request $request, $id)
    {
        $request->merge(['id' => $id]);

        $request->validate([
            'id' => 'required|exists:menu,id',
        ], [
            'id.required' => 'El ID del menú es obligatorio.',
            'id.exists' => 'El menú no existe.',
        ]);

        $menu = Menu::find($id);


        return view('app.menu-manage.edit', [
            'menu' => $menu
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:menu,id',
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'icon_items' => 'required|numeric|integer|min:1|max:10',
        ], [
            'id.required' => 'El ID del menú es obligatorio.',
            'id.exists' => 'El menú no existe.',
            'name.required' => 'El nombre del menú es obligatorio.',
            'icon.required' => 'El icono del menú es obligatorio.',
            'icon_items.required' => 'El número de iconos es obligatorio.',
            'icon_items.numeric' => 'El número de iconos debe ser un número.',
            'icon_items.integer' => 'El número de iconos debe ser un número entero.',
            'icon_items.min' => 'El número de iconos debe ser al menos 1.',
            'icon_items.max' => 'El número de iconos no puede ser mayor a 10.',
        ]);

        $menu = Menu::find($request->id);
        $menu->update($request->all());

        return redirect()->route('menu.index')->withSuccess('Menú actualizado correctamente.');
    }
}
