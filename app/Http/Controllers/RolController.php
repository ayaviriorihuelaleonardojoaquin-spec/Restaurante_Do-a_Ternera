<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Mostrar listado de roles
     */
    public function index()
    {
        $roles = Rol::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Mostrar formulario para crear un nuevo rol
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Guardar un nuevo rol en la base de datos
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:roles',
            'descripcion' => 'nullable|string',
        ]);

        Rol::create($request->only('nombre', 'descripcion'));

        return redirect()->route('roles.index')->with('success', 'Rol creado correctamente.');
    }

    /**
     * Mostrar formulario para editar un rol existente
     */
    public function edit(Rol $rol)
    {
        return view('roles.edit', compact('rol'));
    }

    /**
     * Actualizar un rol existente
     */
    public function update(Request $request, Rol $rol)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:roles,nombre,' . $rol->id,
            'descripcion' => 'nullable|string',
        ]);

        $rol->update($request->only('nombre', 'descripcion'));

        return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente.');
    }

    /**
     * Eliminar un rol
     */
    public function destroy(Rol $rol)
    {
        $rol->delete();

        return redirect()->route('roles.index')->with('success', 'Rol eliminado correctamente.');
    }
}