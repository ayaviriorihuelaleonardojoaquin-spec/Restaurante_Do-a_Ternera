@extends('layouts.cliente')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Nuestro Menú</h2>

    <!-- Menú de platos -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        @forelse($platos as $plato)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <!-- Imagen -->
                @if($plato->imagen)
                    <img src="{{ asset('storage/'.$plato->imagen) }}" alt="{{ $plato->nombre }}" class="w-full h-48 object-cover">
                @else
                    <img src="https://via.placeholder.com/400x300" alt="Sin imagen" class="w-full h-48 object-cover">
                @endif

                <!-- Info -->
                <div class="p-4">
                    <h3 class="font-bold text-lg">{{ $plato->nombre }}</h3>
                    <p class="text-gray-600">{{ $plato->descripcion }}</p>
                    <p class="text-blue-600 font-bold text-xl mt-2">Bs. {{ number_format($plato->precio, 2) }}</p>

                    <!-- Botón de añadir -->
                    <form action="{{ route('carrito.agregar', $plato->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="mt-3 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            Añadir al pedido
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p>No hay platos disponibles en este momento.</p>
        @endforelse
    </div>

    <!-- Carrito de compras en la misma página -->
    <h2 class="text-2xl font-bold mb-4">🛒 Carrito de Compras</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @php $carrito = session()->get('carrito', []); @endphp

    @if(count($carrito) > 0)
        <table class="w-full bg-white shadow-md rounded-lg overflow-hidden mb-6">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3">Plato</th>
                    <th class="p-3">Cantidad</th>
                    <th class="p-3">Precio</th>
                    <th class="p-3">Subtotal</th>
                    <th class="p-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($carrito as $id => $item)
                    @php 
                        $subtotal = $item['cantidad'] * $item['precio']; 
                        $total += $subtotal; 
                    @endphp
                    <tr>
                        <td class="p-3">{{ $item['nombre'] }}</td>
                        <td class="p-3">{{ $item['cantidad'] }}</td>
                        <td class="p-3">Bs. {{ number_format($item['precio'], 2) }}</td>
                        <td class="p-3">Bs. {{ number_format($subtotal, 2) }}</td>
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
                    <td colspan="3" class="p-3 font-bold text-right">Total:</td>
                    <td class="p-3 font-bold">Bs. {{ number_format($total, 2) }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>

        <!-- Formulario de datos personales y pago -->
        <h2 class="text-xl font-bold mb-4">📋 Datos del Pedido</h2>

        <form action="{{ route('checkout.procesar') }}" method="POST" class="bg-white p-6 shadow-md rounded-lg">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Nombre -->
                <div>
                    <label class="block font-bold">Nombre completo:</label>
                    <input type="text" name="nombre" class="w-full border rounded-lg p-2 mt-1" required>
                </div>

                <!-- Teléfono -->
                <div>
                    <label class="block font-bold">Teléfono:</label>
                    <input type="text" name="telefono" class="w-full border rounded-lg p-2 mt-1" required>
                </div>

                <!-- Dirección -->
                <div class="md:col-span-2">
                    <label class="block font-bold">Dirección de entrega:</label>
                    <textarea name="direccion" rows="2" class="w-full border rounded-lg p-2 mt-1" required></textarea>
                </div>

                <!-- Método de pago -->
                <div class="md:col-span-2">
                    <label class="block font-bold">Método de pago:</label>
                    <select name="metodo_pago" class="w-full border rounded-lg p-2 mt-1" required>
                        <option value="">Seleccione una opción</option>
                        <option value="efectivo">Efectivo</option>
                        <option value="transferencia">Transferencia bancaria</option>
                    </select>
                </div>
            </div>
            
            <!-- Botón final -->
            <form action="{{ route('order.place') }}" method="POST">
    @csrf
    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
        Confirmar Pedido
    </button>
</form>
    @else
        <p class="text-gray-600">Tu carrito está vacío.</p>
    @endif
@endsection
