@extends('layouts.cliente')

@section('content')
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Imagen -->
        @if($plato->imagen)
            <img src="{{ asset('storage/'.$plato->imagen) }}" 
                 alt="{{ $plato->nombre }}" 
                 class="w-full h-96 object-cover">
        @else
            <img src="https://via.placeholder.com/800x400" 
                 alt="Sin imagen" 
                 class="w-full h-96 object-cover">
        @endif

        <!-- Información del plato -->
        <div class="p-6">
            <h2 class="text-3xl font-bold text-red-600 mb-4">{{ $plato->nombre }}</h2>
            <p class="text-gray-700 text-lg mb-4">{{ $plato->descripcion }}</p>
            <p class="text-2xl font-bold text-red-700 mb-6">Bs. {{ number_format($plato->precio, 2) }}</p>

            <!-- Botones de acción -->
            <div class="flex space-x-4">
                <a href="{{ route('clientes.menu') }}" 
                   class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                   ⬅️ Volver al Menú
                </a>

                <button class="bg-red-600 text-white px-5 py-2 rounded-lg hover:bg-red-700">
                    🛒 Añadir al Pedido
                </button>
            </div>
        </div>
    </div>
@endsection