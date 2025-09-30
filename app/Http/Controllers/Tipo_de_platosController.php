<?php

namespace App\Http\Controllers;
use App\Models\Tipo_de_platos;
use Illuminate\Http\Request;

class Tipo_de_platosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tipos_de_platos = Tipo_de_platos::all();
        return view("tipos_de_platos.index", compact("tipos_de_platos"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("tipos_de_platos.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
            'estado' => 'required|string',
        ]);

        Tipo_de_platos::create($request->all());

        return redirect()->route('tipos_de_platos.index')->with('success', 'Tipo de platos creado correctamente');

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
        $tipo_de_platos = Tipo_de_platos::findOrFail($id);
        return view('tipos_de_platos.edit', compact('tipo_de_platos'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
            'estado' => 'required|string',
        ]);

        $tipo_de_platos = Tipo_de_platos::findOrFail($id);
        $tipo_de_platos->update($request->all());

        return redirect()->route('tipos_de_platos.index')->with('success', 'Tipo de platos actualizado exitosamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $tipo_de_platos = Tipo_de_platos::findOrFail($id);
        $tipo_de_platos->eliminado = true;
        $tipo_de_platos->save();

        return redirect()->route('tipos_de_platos.index')->with('success', 'Tipo de platos eliminado exitosamente.');

    }
}
