<?php

namespace App\Http\Controllers\Cocinero;

use App\Http\Controllers\Controller;
use App\Models\Pedido; // 👈 Importar modelo Pedido
use Illuminate\Http\Request;

class CocineroPedidoController extends Controller
{
    public function index()
    {
        // Traer los pedidos en estado pendiente o en preparación
        $pedidos = Pedido::whereIn('estado', ['pendiente', 'en preparación'])->get();

        return view('pedidos.index', compact('pedidos'));
    }

    public function preparados()
{
    $pedidos = Pedido::where('estado', 'en_proceso')->get();
    return view('pedidos.preparados', compact('pedidos'));
}
public function historial()
    {
        $pedidos = Pedido::whereIn('estado', ['preparado', 'entregado'])->get();
        return view('pedidos.historial', compact('pedidos'));
    }

}
