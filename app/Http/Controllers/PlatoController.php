<?php

namespace App\Http\Controllers;

use App\Models\Plato;
use Illuminate\Http\Request;

class PlatoController extends Controller
{
    public function index()
    {
        $platos = Plato::all();
        return view('platos.index', compact('platos'));
    }

    public function create()
    {
        return view('platos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'disponible' => 'required|boolean',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            // Guardar imagen en storage/app/public/platos
            $data['imagen'] = $request->file('imagen')->store('platos', 'public');
        }

        Plato::create($data);

        return redirect()->route('platos.index')->with('success', 'Plato creado correctamente.');
    }

    public function show(Plato $plato)
    {
        return view('platos.show', compact('plato'));
    }

    public function edit(Plato $plato)
    {
        return view('platos.edit', compact('plato'));
    }

    public function update(Request $request, Plato $plato)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'disponible' => 'required|boolean',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            // Guardar imagen en storage/app/public/platos
            $data['imagen'] = $request->file('imagen')->store('platos', 'public');
        }

        $plato->update($data);

        return redirect()->route('platos.index')->with('success', 'Plato actualizado correctamente.');
    }

    public function destroy(Plato $plato)
    {
        $plato->delete();

        return redirect()->route('platos.index')->with('success', 'Plato eliminado correctamente.');
    }
}