<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mesas;
class MesasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $laboratorios = Mesas::all();
        return view("mesas.index", compact("mesas"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("mesas.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'numero' => 'required|string',
            'descripcion' => 'nullable|string',
            'estado' => 'required|string',
        ]);
        Mesas::create($request->all());

        return redirect()->route('mesas.index')->with('success', 'Mesas creada correctamente');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $mesas = Mesas::findOrFail($id);
        return view('mesas.edit', compact('mesas'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'numero' => 'required|string',
            'descripcion' => 'nullable|string',
            'estado' => 'required|string',
        ]);

        $mesas = Mesas::findOrFail($id);
        $mesas->update($request->all());

        return redirect()->route('mesas.index')->with('success', 'Mesas actualizado exitosamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $mesas = Mesas::findOrFail($id);
        $mesas->eliminado = true;
        $mesas->save();

        return redirect()->route('mesas.index')->with('success', 'Mesas eliminado exitosamente.');

    }
}
