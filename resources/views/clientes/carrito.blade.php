@extends('layouts.cliente')

@section('content')
<h2 class="text-2xl font-bold mb-6">🛒 Carrito de Compras</h2>

@if(session('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if(count($carrito) > 0)
    <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3">Plato</th>
                <th class="p-3">Cantidad</th>
                <th class="p-3">Precio</th>
                <th class="p-3">Subtotal</th>
                <th class="p-3">Tipo de Pedido</th> <!-- Nueva columna -->
                <th class="p-3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($carrito as $id => $item)
                @php $subtotal = $item['cantidad'] * $item['precio']; $total += $subtotal; @endphp
                <tr>
                    <td class="p-3">{{ $item['nombre'] }}</td>
                    <td class="p-3">{{ $item['cantidad'] }}</td>
                    <td class="p-3">Bs. {{ number_format($item['precio'], 2) }}</td>
                    <td class="p-3">Bs. {{ number_format($subtotal, 2) }}</td>
                    <td class="p-3">{{ $item['tipo'] ?? 'Mesa' }}</td> <!-- Muestra el tipo -->
                    <td class="p-3">
                        <form action="{{ route('carrito.eliminar', $id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot class="bg-gray-100">
            <tr>
                <td colspan="4" class="p-3 font-bold text-right">Total:</td>
                <td class="p-3 font-bold">Bs. {{ number_format($total, 2) }}</td>
                <td class="p-3">
                    <a href="{{ route('checkout') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                        Proceder al Pago
                    </a>
                </td>
            </tr>
        </tfoot>
    </table>
@else
    <p class="text-gray-600">Tu carrito está vacío.</p>
@endif
@endsection
