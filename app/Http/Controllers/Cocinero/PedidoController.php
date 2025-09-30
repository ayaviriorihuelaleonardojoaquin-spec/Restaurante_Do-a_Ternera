<?php

namespace App\Http\Controllers\Cocinero;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;
class PedidoController extends Controller
{
    //
    public function index()
    {
        $pedidos = Pedido::where('estado', 'pendiente')->get();
        return view('cocinero.pedidos.index', compact('pedidos'));
    }

    public function preparados()
    {
        $pedidos = Pedido::where('estado', 'preparado')->get();
        return view('pedidos.preparados', compact('pedidos'));
    }

    public function historial()
    {
        $pedidos = Pedido::whereIn('estado', ['preparado', 'entregado'])->get();
        return view('pedidos.historial', compact('pedidos'));
    }

    public function marcarPreparado(Pedido $pedido)
    {
        $pedido->update(['estado' => 'preparado']);
        return redirect()->route('pedidos.index')->with('success', 'Pedido marcado como preparado ✅');
    }
}
