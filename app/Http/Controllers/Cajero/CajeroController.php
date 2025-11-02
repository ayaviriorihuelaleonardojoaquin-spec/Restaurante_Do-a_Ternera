<?php

namespace App\Http\Controllers\Cajero;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CajeroController extends Controller
{
    // Página de Cobros
    public function cobros()
    {
        // Traer pedidos listos para cobrar
        $pedidos = Pedido::where('estado', 'preparado')->get();
        return view('cajero.cobros', compact('pedidos'));
    }

    // Página de Facturas
    public function facturas()
    {
        $pedidos = Pedido::with(['detallePedidos', 'mesa'])->orderBy('created_at', 'asc')->get();
        return view('cajero.facturas', compact('pedidos'));
    }

    // Página de Cierre de Caja
    public function cierreCaja()
    {
        return view('cajero.cierre-caja');
    }

    // Historial de pagos / facturas
    public function historial()
{
    $resumenPlatos = DB::table('detalle_pedidos')
        ->join('platos', 'detalle_pedidos.plato_id', '=', 'platos.id')
        ->select(
            'platos.nombre',
            DB::raw('SUM(detalle_pedidos.cantidad) as total_cantidad'),
            DB::raw('SUM(detalle_pedidos.cantidad * detalle_pedidos.precio_unitario) as total_venta'),
            DB::raw('COUNT(DISTINCT detalle_pedidos.pedido_id) as total_pedidos')
        )
        ->groupBy('platos.nombre')
        ->orderByDesc('total_cantidad')
        ->get();

    return view('cajero.historial', compact('resumenPlatos'));
}


}
