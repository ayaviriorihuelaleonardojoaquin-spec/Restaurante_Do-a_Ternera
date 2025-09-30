<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\PDF;// si instalas dompdf
use SimpleSoftwareIO\QrCode\Facades\QrCode; // si instalas paquete QR

class OrderController extends Controller
{
    //
    
    public function checkout()
{
    $carrito = session()->get('carrito', []);
    return view('clientes.checkout', compact('carrito'));
}

public function placeOrder(Request $request)
{
    $carrito = session()->get('carrito', []);

    if(count($carrito) == 0){
        return redirect()->route('carrito.ver')->with('success', 'Tu carrito está vacío.');
    }

    $metodo_pago = $request->input('metodo_pago'); // 'qr' o 'efectivo'

    // Aquí guardar pedido en la DB incluyendo método de pago
    // Ejemplo:
    // $pedido = Pedido::create([
    //     'usuario_id' => auth()->id(),
    //     'total' => $total,
    //     'metodo_pago' => $metodo_pago
    // ]);
    // foreach($carrito as $item){
    //     $pedido->detalles()->create([...]);
    // }

    // Vaciar carrito
    session()->forget('carrito');

    return redirect()->route('carrito.ver')->with('success', 'Pedido confirmado correctamente con pago: ' . strtoupper($metodo_pago));
}



    public function index()
    {
        $orders = auth()->user()->orders()->latest()->paginate(10);
        return view('orders.show', ['order' => $orders]);
    }

    public function show(Order $order)
    {
        if (!auth()->check()) {
    abort(403, 'No autorizado');
}

        //$this->authorize('view', $order); // si usas policies
        return view('orders.show', compact('order'));
    }

    // Generar y descargar comprobante PDF (usa barryvdh/laravel-dompdf)
    public function downloadReceipt(Order $order)
    {
        if (!auth()->check()) {
    abort(403, 'No autorizado');
}

        //$this->authorize('view', $order);
        $pdf = \PDF::loadView('orders.receipt', compact('order'));
        return $pdf->download("pedido_{$order->id}.pdf");
    }
    
}
