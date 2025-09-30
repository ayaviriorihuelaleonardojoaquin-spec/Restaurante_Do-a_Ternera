<?php

namespace App\Http\Controllers;
use App\Models\Personal;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $personal = Personal::all();
        return view('personal.index', compact('personal'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('personal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'required|string|email|max:255|unique:personas',
            'tipo' => 'required|string|max:255',
            'estado' => 'required|string',
        ]);

        Personal::create($request->all());

        return redirect()->route('personal.index')->with('success', 'Personal creado exitosamente');

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
        $personal = Personal::findOrFail($id);
        return view('personal.edit', compact('personal'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'required|string|email|max:255',
            'tipo' => 'required|string|max:255',
            'estado' => 'required|string',
        ]);

        $personal = Personal::findOrFail($id);
        $personal->update($request->all());

        return redirect()->route('personal.index')->with('success', 'Personal actualizado exitosamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $personal = Personal::findOrFail($id);
        $personal->eliminado = true;
        $personal->save();

        return redirect()->route('personal.index')->with('success', 'Personal eliminada exitosamente.');

    }
}
