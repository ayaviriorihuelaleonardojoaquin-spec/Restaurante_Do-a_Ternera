<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use Illuminate\Http\Request;

class MesaController extends Controller
{
    public function index()
    {
        $mesas = Mesa::all();
        return view('mesas.index', compact('mesas'));
    }

    public function create()
    {
        return view('mesas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required|unique:mesas,numero',
            'estado' => 'required|in:libre,ocupada,reservada',
        ]);

        Mesa::create($request->all());

        return redirect()->route('mesas.index')->with('success', 'Mesa creada correctamente.');
    }

    public function show(Mesa $mesa)
    {
        return view('mesas.show', compact('mesa'));
    }

    public function edit(Mesa $mesa)
    {
        return view('mesas.edit', compact('mesa'));
    }

    public function update(Request $request, Mesa $mesa)
    {
        $request->validate([
            'numero' => 'required|unique:mesas,numero,' . $mesa->id,
            'estado' => 'required|in:libre,ocupada,reservada',
        ]);

        $mesa->update($request->all());

        return redirect()->route('mesas.index')->with('success', 'Mesa actualizada correctamente.');
    }

    public function destroy(Mesa $mesa)
    {
        $mesa->delete();
        return redirect()->route('mesas.index')->with('success', 'Mesa eliminada correctamente.');
    }
}
