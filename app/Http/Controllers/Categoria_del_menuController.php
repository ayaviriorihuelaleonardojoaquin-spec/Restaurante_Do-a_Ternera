<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria_del_menu;
class Categoria_del_menuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categorias_de_menu = Categoria_del_menu::all();
        return view("categorias_del_menu.index", compact("categorias_del_menu"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("categorias_del_menu.create");
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

        Categoria_del_menu::create($request->all());

        return redirect()->route('categorias_del_menu.index')->with('success', 'Categoría del menu creada correctamente');

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
        $categoria_de_menu = Categoria_del_menu::findOrFail($id);
        return view('categorias_del_menu.edit', compact('categoria_del_menu'));

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

        $categoria_de_menu = Categoria_del_menu::findOrFail($id);
        $categoria_de_menu->update($request->all());

        return redirect()->route('categorias_del_menu.index')->with('success', 'Categoria del menu actualizado exitosamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $categoria_de_menu = Categoria_del_menu::findOrFail($id);
        $categoria_de_menu->eliminado = true;
        $categoria_de_menu->save();

        return redirect()->route('categorias_del_menu.index')->with('success', 'Categoria del menu eliminado exitosamente.');

    }
}
