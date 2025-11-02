<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlatoController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Cajero\FacturaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Cajero\CajeroController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\Admin\ReporteController;
use App\Http\Controllers\Admin\ConfiguracionController;
use App\Http\Controllers\Cocinero\CocineroPedidoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Página principal = Login
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('auth.login'); // pantalla de login como inicio
});

/*
|--------------------------------------------------------------------------
| Rutas públicas (accesibles sin login)
|--------------------------------------------------------------------------
*/
Route::view('/sobre', 'clientes.sobre')->name('clientes.sobre');
Route::view('/contacto', 'clientes.contacto')->name('clientes.contacto');
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/{id}', [ClienteController::class, 'detalle'])->name('clientes.detalle');
/*
|--------------------------------------------------------------------------
| Rutas privadas para clientes (requiere login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('cajero')->name('cajero.')->group(function () {
    Route::post('/pedido', [PedidoController::class, 'store'])->name('pedido.store');
    Route::get('/facturas', [FacturaController::class, 'index'])->name('facturas.index');
    Route::post('/facturas/{pedido}', [FacturaController::class, 'store'])->name('facturas.store');
});

Route::middleware(['auth'])->group(function () {

    // Cocinero
    Route::get('/cocinero/pedidos', [CocineroPedidoController::class, 'index'])->name('pedidos.index');
    Route::get('/cocinero/pedidos/preparados', [CocineroPedidoController::class, 'preparados'])->name('pedidos.preparados');
    Route::get('/cocinero/pedidos/historial', [CocineroPedidoController::class, 'historial'])->name('pedidos.historial');
    Route::post('/cocinero/pedidos/{pedido}/preparar', [CocineroPedidoController::class, 'marcarPreparado'])->name('pedidos.marcarPreparado');

    // Menú y platos
    Route::get('/menu-clientes', [ClienteController::class, 'menu'])->name('clientes.menu');
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/plato/{id}', [ClienteController::class, 'show'])->name('clientes.detalle');
    
    Route::get('/factura-cajero', [CajeroController::class, 'facturas'])->name('cajero.facturas');
    Route::get('/cobros-cajero', [CajeroController::class, 'cobros'])->name('cajero.cobros');
    Route::get('/cierre-cajero', [CajeroController::class, 'cierre-caja'])->name('cajero.cierre-caja');
    Route::get('/historial-cajero', [CajeroController::class, 'historial'])->name('cajero.historial');
    // Carrito
    Route::post('/carrito/agregar/{id}', [ClienteController::class, 'agregarCarrito'])->name('carrito.agregar');
    Route::get('/carrito', [ClienteController::class, 'verCarrito'])->name('carrito.ver');
    Route::post('/carrito/eliminar/{id}', [ClienteController::class, 'eliminarCarrito'])->name('carrito.eliminar');

    // Checkout y pedidos
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/procesar', [OrderController::class, 'placeOrder'])->name('checkout.procesar');
    

});

/*
|--------------------------------------------------------------------------
| Rutas protegidas del sistema interno (Admin, Mesero, Cocina)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Gestión interna
    Route::resource('roles', RolController::class)->parameters(['roles' => 'rol']);
    Route::resource('users', UserController::class);
    Route::resource('platos', PlatoController::class);
    Route::resource('mesas', MesaController::class);
    Route::resource('pedidos', PedidoController::class);
    

    // Órdenes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{order}/receipt', [OrderController::class, 'downloadReceipt'])->name('orders.receipt');
});

// Cajero
Route::prefix('cajero')->name('cajero')->group(function () {
    Route::get('/cobros', [CajeroController::class, 'cobros'])->name('cobros');
    Route::get('/facturas', [CajeroController::class, 'facturas'])->name('facturas');
    Route::get('/cierre-caja', [CajeroController::class, 'cierreCaja'])->name('cierre-caja');
    Route::get('/cajero/historial', [CajeroController::class, 'historial'])->name('cajero.historial');
    
    Route::get('/historial', [CajeroController::class, 'historial'])->name('historial');
});
// Admin
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes');
    Route::get('/configuracion', [ConfiguracionController::class, 'index'])->name('configuracion');
});
Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place');

require __DIR__.'/auth.php';
