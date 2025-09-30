<?php

namespace App\Http\Controllers;
use App\Models\Plato;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    //
     public function index()
    {
        $platos = Plato::all();
        return view('clientes.index', compact('platos'));
    }

    public function agregarAlCarrito($id)
    {
        $plato = Plato::findOrFail($id);
        $carrito = session()->get('carrito', []);
        
        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
        } else {
            $carrito[$id] = [
                "nombre" => $plato->nombre,
                "precio" => $plato->precio,
                "cantidad" => 1,
                "tipo" => $request->tipo ?? 'Mesa',
            ];
        }

        session()->put('carrito', $carrito);

        return redirect()->route('menu.index')->with('success', 'Plato agregado al carrito');
    }
}
