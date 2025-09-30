<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante - Cliente</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Navbar -->
    <nav class="bg-red-600 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center h-16">
            <a href="{{ route('clientes.menu') }}" class="text-xl font-bold">🍽 Restaurante Doña Ternera</a>
            <div class="space-x-6">
                <a href="{{ route('clientes.menu') }}" class="hover:text-yellow-300">🍱 MENÚ</a>
                <a href="{{ route('clientes.sobre') }}" class="hover:text-yellow-300">🥘 SOBRE NOSOTROS</a>
                <a href="{{ route('clientes.contacto') }}" class="hover:text-yellow-300">📞 CONTACTO</a>
                <a href="{{ route('carrito.ver') }}" class="hover:text-yellow-300">🛒 VER CARRITO</a>
            </div>

            <!-- User Dropdown -->
<div x-data="{ open: false }" class="relative">
    <button @click="open = !open" class="flex items-center text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
        @auth
        @if(Auth::user()->avatar)
            <img class="h-10 w-10 rounded-full object-cover" 
                 src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                 alt="{{ Auth::user()->name }}" />
        @else
            <img class="h-10 w-10 rounded-full object-cover" 
                 src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}" 
                 alt="{{ Auth::user()->name }}" />
        @endif
        <span class="text-lg font-semibold">{{ Auth::user()->name }}</span>
    @endauth

    @guest
        <img class="h-10 w-10 rounded-full object-cover" 
             src="https://via.placeholder.com/40" 
             alt="Invitado" />
        <span class="text-lg font-semibold">Invitado</span>
    @endguest

        <svg class="ml-1 h-4 w-4 fill-current text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0-1.414z" clip-rule="evenodd" />
        </svg>
    </button>

    <!-- Opciones -->
    <div x-show="open" @click.away="open = false" 
         class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50">
        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
            👤 Ver Perfil
        </a>
        <script src="//unpkg.com/alpinejs" defer></script>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                🚪 Finalizar sesión
            </button>
        </form>
    </div>
</div>

                        
        </div>
    </nav>

    <!-- Contenido dinámico -->
    <main class="max-w-7xl mx-auto p-6">
        @yield('content')
    </main>

    <!-- Footer -->
     
    <footer class="bg-gray-900 text-gray-300 mt-10">
        <div class="max-w-7xl mx-auto px-6 py-6 text-center">
            <p>© {{ date('Y') }} Restaurante Doña Ternera. Todos los derechos reservados.</p>
        </div>
    </footer>

    
</body>
</html>