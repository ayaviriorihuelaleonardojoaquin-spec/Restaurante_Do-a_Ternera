<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\DetallePedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    // Mostrar lista de pedidos
    public function index()
    {
        // Cargar pedidos con detalles y mesas para mostrar en la lista
        $pedidos = Pedido::with(['detallePedidos', 'mesa'])->orderBy('created_at', 'desc')->get();
        return view('pedidos.index', compact('pedidos'));
        
    }

    // Mostrar formulario para crear pedido + detalles
    public function create()
    {
        // Aquí deberías cargar mesas y platos para seleccionar
        $mesas = \App\Models\Mesa::all();
        $platos = \App\Models\Plato::where('disponible', true)->get();

        return view('pedidos.create', compact('mesas', 'platos'));
    }

    // Guardar pedido y detalles en base de datos (transacción)
    public function store(Request $request)
    {
        $request->validate([
            'mesa_id' => 'required|exists:mesas,id',
            'estado' => 'required|string',
            'detalles' => 'required|array|min:1',
            'detalles.*.plato_id' => 'required|exists:platos,id',
            'detalles.*.cantidad' => 'required|integer|min:1',
            'detalles.*.precio' => 'required|numeric|min:0',
            'detalles.*.subtotal' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $mesero_id = auth()->user()->id;
            
            // Crear pedido
            $pedido = Pedido::create([
                'tipo' => $request->tipo,
                'mesa_id' => $request->mesa_id,
                'estado' => $request->estado,
                'mesero_id' => $mesero_id,
                'nombre' => $request->nombre,
                'total' => 0,
            ]);

            // Crear detalles del pedido
            foreach ($request->detalles as $detalle) {
                $pedido->detallePedidos()->create([
                    'plato_id' => $detalle['plato_id'],
                    'cantidad' => $detalle['cantidad'],
                    'precio_unitario' => $detalle['precio'],
                    'subtotal' => $detalle['subtotal']
                ]);
            }

            DB::commit();

            return redirect()->route('pedidos.index')->with('success', 'Pedido creado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors('Error al crear pedido: ' . $e->getMessage())->withInput();
        }
    }

    // Mostrar formulario para editar pedido y sus detalles
    public function edit(Pedido $pedido)
    {
        $mesas = \App\Models\Mesa::all();
        $platos = \App\Models\Plato::where('disponible', true)->get();
        $pedido->load('detallePedidos');

        return view('pedidos.edit', compact('pedido', 'mesas', 'platos'));
    }

    // Actualizar pedido y detalles
    public function update(Request $request, Pedido $pedido)
    {
        $request->validate([
            'mesa_id' => 'required|exists:mesas,id',
            'estado' => 'required|string',
            'detalles' => 'required|array|min:1',
            'detalles.*.id' => 'nullable|exists:detalle_pedidos,id',
            'detalles.*.plato_id' => 'required|exists:platos,id',
            'detalles.*.cantidad' => 'required|integer|min:1',
            'detalles.*.precio' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            // Actualizar pedido
            $pedido->update([
                'mesa_id' => $request->mesa_id,
                'estado' => $request->estado,
            ]);

            // Manejar detalles: actualizar existentes y crear nuevos
            $detalleIds = [];

            foreach ($request->detalles as $detalle) {
                if (!empty($detalle['id'])) {
                    // Actualizar detalle existente
                    $detallePedido = DetallePedido::find($detalle['id']);
                    $detallePedido->update([
                        'plato_id' => $detalle['plato_id'],
                        'cantidad' => $detalle['cantidad'],
                        'precio' => $detalle['precio'],
                    ]);
                    $detalleIds[] = $detallePedido->id;
                } else {
                    // Crear nuevo detalle
                    $nuevoDetalle = $pedido->detallePedidos()->create([
                        'plato_id' => $detalle['plato_id'],
                        'cantidad' => $detalle['cantidad'],
                        'precio' => $detalle['precio'],
                    ]);
                    $detalleIds[] = $nuevoDetalle->id;
                }
            }

            // Eliminar detalles que no estén en el request (opcional)
            $pedido->detallePedidos()->whereNotIn('id', $detalleIds)->delete();

            DB::commit();

            return redirect()->route('pedidos.index')->with('success', 'Pedido actualizado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors('Error al actualizar pedido: ' . $e->getMessage())->withInput();
        }
    }

    // Eliminar pedido junto con sus detalles
    public function destroy(Pedido $pedido)
    {
        try {
            $pedido->detallePedidos()->delete();
            $pedido->delete();

            return redirect()->route('pedidos.index')->with('success', 'Pedido eliminado correctamente.');
        } catch (\Exception $e) {
            return back()->withErrors('Error al eliminar pedido: ' . $e->getMessage());
        }
    }

    
}
