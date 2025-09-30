@extends('layouts.cliente')

@section('content')
<div class="container mx-auto px-6 py-12">
    <h1 class="text-4xl font-bold text-center text-amber-700 mb-10">📞 Contáctanos</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        <!-- Información -->
        <div class="bg-white shadow-lg rounded-2xl p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">📍 Dirección</h2>
            <p class="text-gray-600 mb-4">Av. Principal #123, Santa Cruz - Bolivia</p>

            <h2 class="text-2xl font-bold text-gray-800 mb-4">⏰ Horarios</h2>
            <p class="text-gray-600 mb-4">Lunes a Domingo: 11:00 AM - 11:00 PM</p>

            <h2 class="text-2xl font-bold text-gray-800 mb-4">📱 Teléfonos</h2>
            <p class="text-gray-600">+591 700-12345</p>
            <p class="text-gray-600">+591 600-67890</p>

            <a href="https://wa.me/59170012345" target="_blank" 
               class="mt-6 inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg shadow transition">
               💬 WhatsApp
            </a>
        </div>

        <!-- Formulario -->
        <div class="bg-white shadow-lg rounded-2xl p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">✉️ Escríbenos</h2>
            <form action="#" method="POST" class="space-y-4">
                @csrf
                <input type="text" name="nombre" placeholder="Tu Nombre"
                       class="w-full border-gray-300 rounded-lg p-3 focus:ring-amber-500 focus:border-amber-500">
                <input type="email" name="email" placeholder="Tu Correo"
                       class="w-full border-gray-300 rounded-lg p-3 focus:ring-amber-500 focus:border-amber-500">
                <textarea name="mensaje" rows="4" placeholder="Tu Mensaje"
                          class="w-full border-gray-300 rounded-lg p-3 focus:ring-amber-500 focus:border-amber-500"></textarea>
                <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg shadow-md transition">
                       <!-- class="inline-block mt-3 bg-red-700 text-white px-6 py-3 rounded-lg hover:bg-red-700"> -->                   
                        Enviar Mensaje
                </button>
            </form>
        </div>
    </div>
</div>
@endsection