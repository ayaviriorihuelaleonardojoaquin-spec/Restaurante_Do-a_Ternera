<?php

namespace App\Http\Controllers\Cajero;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
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
        return view('cajero.facturas');
    }

    // Página de Cierre de Caja
    public function cierreCaja()
    {
        return view('cajero.cierre-caja');
    }

    // Historial de pagos / facturas
    public function historial()
    {
        return view('cajero.historial');
    }
}
