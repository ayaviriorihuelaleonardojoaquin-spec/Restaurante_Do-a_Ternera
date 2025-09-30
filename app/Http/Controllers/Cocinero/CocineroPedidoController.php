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

        return view('cocinero.pedidos.index', compact('pedidos'));
    }

    public function preparados($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->estado = 'preparado';
        $pedido->save();

        return redirect()->route('cocinero.pedidos.index')->with('success', 'Pedido marcado como preparado.');
    }
}
