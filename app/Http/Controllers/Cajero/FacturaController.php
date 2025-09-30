<?php

namespace App\Http\Controllers\Cajero;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Models\Factura;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    // Lista de facturas
    public function index()
    {
        $facturas = Factura::with('pedido')->latest()->get();
        return view('cajero.facturas', compact('facturas'));
    }

    // Generar factura desde un pedido
    public function store(Request $request, $pedidoId)
    {
        $pedido = Pedido::findOrFail($pedidoId);

        // Crear factura
        $factura = Factura::create([
            'pedido_id'   => $pedido->id,
            'cliente'     => $request->cliente ?? 'Consumidor Final',
            'monto_total' => $pedido->total,
            'metodo_pago' => $request->metodo_pago ?? 'Efectivo',
        ]);

        // Actualizar estado del pedido
        $pedido->update(['estado' => 'Pagado']);

        return redirect()->route('cajero.facturas.index')->with('success', 'Factura generada correctamente.');
    }
}
