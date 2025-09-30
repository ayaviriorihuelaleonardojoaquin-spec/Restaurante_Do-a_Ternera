@extends('layouts.cliente')

@section('content')
<h2 class="text-2xl font-bold mb-6">📝 Confirmar Pedido</h2>

@if(count($carrito) > 0)
    <table class="w-full bg-white shadow-md rounded-lg overflow-hidden mb-4">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3">Plato</th>
                <th class="p-3">Cantidad</th>
                <th class="p-3">Precio</th>
                <th class="p-3">Subtotal</th>
                <th class="p-3">Tipo de Pedido</th> <!-- Nueva columna -->
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($carrito as $item)
                @php 
                    $subtotal = $item['cantidad'] * $item['precio']; 
                    $total += $subtotal; 
                @endphp
                <tr>
                    <td class="p-3">{{ $item['nombre'] }}</td>
                    <td class="p-3">{{ $item['cantidad'] }}</td>
                    <td class="p-3">Bs. {{ number_format($item['precio'], 2) }}</td>
                    <td class="p-3">Bs. {{ number_format($subtotal, 2) }}</td>
                    <td class="p-3">{{ $item['tipo'] ?? 'Mesa' }}</td> <!-- Muestra el tipo -->
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="text-right font-bold mb-4">Total: Bs. {{ number_format($total, 2) }}</p>

    <!-- Formulario para confirmar pedido -->
    <form action="{{ route('checkout.procesar') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="font-bold mb-2 block">Selecciona el método de pago:</label>
            <div class="space-x-4">
                <label class="inline-flex items-center">
                    <input type="radio" name="metodo_pago" value="qr" class="form-radio" required>
                    <span class="ml-2">QR</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="metodo_pago" value="efectivo" class="form-radio" required>
                    <span class="ml-2">Efectivo</span>
                </label>
            </div>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            Confirmar Pedido
        </button>
    </form>
@else
    <p>Tu carrito está vacío.</p>
@endif
@endsection
