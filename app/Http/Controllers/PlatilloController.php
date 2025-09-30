<?php

namespace App\Http\Controllers;

use App\Models\Platillo;
use Illuminate\Http\Request;

class PlatilloController extends Controller
{
    // Mostrar todos los platillos
    public function index()
    {
        $platillos = Platillo::all();  // Obtener todos los platillos de la base de datos
        return response()->json($platillos);
    }

    // Mostrar un platillo específico
    public function show($id)
    {
        $platillo = Platillo::findOrFail($id);  // Buscar un platillo por su ID
        return response()->json($platillo);
    }

    // Crear un nuevo platillo
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric',
        ]);

        $platillo = Platillo::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
        ]);

        return response()->json($platillo, 201);  // Responder con el platillo recién creado
    }

    // Actualizar un platillo existente
    public function update(Request $request, $id)
    {
        $platillo = Platillo::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric',
        ]);

        $platillo->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
        ]);

        return response()->json($platillo);
    }

    // Eliminar un platillo
    public function destroy($id)
    {
        $platillo = Platillo::findOrFail($id);
        $platillo->delete();

        return response()->json(['message' => 'Platillo eliminado con éxito']);
    }
}