<?php

namespace App\Http\Controllers;
use App\Models\Plato;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function agregarCarrito($id)
{
    $plato = Plato::findOrFail($id);

    $carrito = session()->get('carrito', []);

    if (isset($carrito[$id])) {
        $carrito[$id]['cantidad']++;
    } else {
        $carrito[$id] = [
            "nombre" => $plato->nombre,
            "cantidad" => 1,
            "precio" => $plato->precio,
            "imagen" => $plato->imagen
        ];
    }

    session()->put('carrito', $carrito);

    return redirect()->back()->with('success', 'Plato añadido al carrito');
}

public function verCarrito()
{
    $carrito = session()->get('carrito', []);
    return view('clientes.carrito', compact('carrito'));
}

public function eliminarCarrito($id)
{
    $carrito = session()->get('carrito', []);

    if (isset($carrito[$id])) {
        unset($carrito[$id]);
        session()->put('carrito', $carrito);
    }

    return redirect()->route('carrito.ver')->with('success', 'Plato eliminado del carrito');
}
    //
    public function index()
    {
        $platos = Plato::all();
        $carrito = session()->get('carrito', []); // 👈 también mandamos carrito
        return view('clientes.index', compact('platos', 'carrito'));
    }

    public function menu()
    {
        $platos = Plato::all();
        $carrito = session()->get('carrito', []); // 👈 igual aquí
        return view('clientes.menu', compact('platos', 'carrito'));
    }

    public function sobre()
    {
        return view('clientes.sobre');
    }

    public function contacto()
    {
        return view('clientes.contacto');
    }
    public function show($id)
    {
        $plato = Plato::findOrFail($id);
        return view('clientes.detalle', compact('plato'));
    }
}

