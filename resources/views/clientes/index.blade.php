@extends('layouts.cliente')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Nuestro Menú</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
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
                    
                    <p class="text-red-600 font-bold text-xl mt-2">Bs. {{ number_format($plato->precio, 2) }}</p>

                    <a href="{{ route('clientes.detalle',  $plato->id) }}" 
                       class="inline-block mt-3 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                        Ver Detalle
                    </a>
                    <form action="{{ route('carrito.agregar', $plato->id) }}" method="POST" class="inline-block">
    @csrf
    <button type="submit" 
        class="inline-block mt-3 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        🛒 Añadir al Pedido
    </button>
</form>
                </div>
            </div>
        @empty
            <p>No hay platos disponibles en este momento.</p>
        @endforelse
    </div>
@endsection