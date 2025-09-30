<?php

namespace App\Http\Controllers;

use App\Models\Transaccion;
use App\Models\DetalleTransaccion;
use App\Models\Persona;
use App\Models\Producto;
use App\Models\Lote;
use App\Models\Configuracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class TransaccionController extends Controller
{
    // Funciones para Entradas

    public function index_entrada()
    {

        $user = auth()->user(); // Obtener el usuario autenticado

        if ($user->role == 'auxiliar') {
            // Si el usuario es "Auxiliar", mostrar solo sus transacciones
            $entradas = Transaccion::where('tipo', 'Compra')
                                    ->where('user_id', $user->id)
                                    ->get();
        } else if ($user->role == 'administrador') {
            // Si no es "Auxiliar", mostrar todas las transacciones
            $entradas = Transaccion::where('tipo', 'Compra')->get();
        }

        return view('transacciones.entradas.index', compact('entradas'));
    }

    public function create_entrada()
    {
        $personas = Persona::where('tipo', 'Proveedor')->get();
        $productos = Producto::where('eliminado', false)->get();
        return view('transacciones.entradas.create', compact('personas','productos'));
    }

    public function store_entrada(Request $request)
    {
        // Validar los datos principales de la transacción
        $validatedData = $request->validate([
            'tipo' => 'required|string',
            'persona_id' => 'required|exists:personas,id',
            'fecha' => 'required|date',
            //'nombre_comprobante' => 'required|string',
            //'numero_comprobante' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'total' => 'required|numeric|min:0',
            // Validación para los detalles de transacción
            'detalles' => 'required|array',
            'detalles.*.producto_id' => 'required|exists:productos,id',
            'detalles.*.cantidad' => 'required|numeric|min:1',
            'detalles.*.costo' => 'required|numeric|min:0',
            'detalles.*.codigo_lote' => 'string',
            'detalles.*.fecha_vencimiento_lote' => 'required',
        ]);

        DB::beginTransaction();
        try {

            // Crear la transacción principal
            $transaccion = Transaccion::create([
                'tipo' => $validatedData['tipo'],
                'persona_id' => $validatedData['persona_id'],
                'fecha' => $validatedData['fecha'],
                //'nombre_comprobante' => $validatedData['nombre_comprobante'],
                //'numero_comprobante' => $validatedData['numero_comprobante'],
                'user_id' => $validatedData['user_id'],
                'total' => $validatedData['total'],
                'estado' => 'Aprobado',
                'eliminado' => false,
            ]);

            // Procesar los detalles de la transacción
            foreach ($validatedData['detalles'] as $detalle) {

                // Crear el lote
                $lote = Lote::Create([
                    'producto_id' => $detalle['producto_id'],
                    'codigo' => $detalle['codigo_lote'],
                    'fecha_vencimiento' => $detalle['fecha_vencimiento_lote'],
                    'cantidad_actual' => $detalle['cantidad'],
                    'cantidad_inicial' => $detalle['cantidad'],
                    'costo_unitario' => $detalle['costo'],
                ]);

                // Crear el detalle de la transacción
                DetalleTransaccion::create([
                    'transaccion_id' => $transaccion->id,
                    'producto_id' => $detalle['producto_id'],
                    'lote_id' => $lote->id,
                    'cantidad' => $detalle['cantidad'],
                    'precio_unitario' => $detalle['costo'],
                    'subtotal' => $detalle['cantidad'] * $detalle['costo'],
                ]);
            }

            DB::commit();

            return redirect()->route('transacciones.entradas.index')->with('success', 'La compra ha sido registrada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al registrar la compra. Intente nuevamente.');
        }
    }

    public function edit_entrada($id)
    {
        $entrada = Transaccion::findOrFail($id);
        $personas = Persona::where('tipo', 'Proveedor')->get();
        $productos = Producto::all();
        return view('transacciones.entradas.edit', compact('entrada', 'personas','productos'));
    }

    public function update_entrada(Request $request, $id)
    {
        // Validar los datos principales de la transacción
        $validatedData = $request->validate([
            'tipo' => 'required|string',
            'persona_id' => 'required|exists:personas,id',
            'fecha' => 'required|date',
            //'nombre_comprobante' => 'string',
            //'numero_comprobante' => 'string',
            'user_id' => 'required|exists:users,id',
            'total' => 'required|numeric|min:0',
            // Validación para los detalles de transacción
            'detalles' => 'required|array',
            'detalles.*.producto_id' => 'required|exists:productos,id',
            'detalles.*.cantidad' => 'required|numeric|min:1',
            'detalles.*.costo' => 'required|numeric|min:0',
            'detalles.*.codigo_lote' => 'string',
            'detalles.*.fecha_vencimiento_lote' => 'required|date',
        ]);

        DB::beginTransaction();
        try {
            // Buscar la transacción existente
            $transaccion = Transaccion::findOrFail($id);

            // Actualizar los datos de la transacción
            $transaccion->update([
                'tipo' => $validatedData['tipo'],
                'persona_id' => $validatedData['persona_id'],
                'fecha' => $validatedData['fecha'],
                //'nombre_comprobante' => $validatedData['nombre_comprobante'],
                //'numero_comprobante' => $validatedData['numero_comprobante'],
                'user_id' => $validatedData['user_id'],
                'total' => $validatedData['total'],
            ]);

            // Eliminar los detalles existentes relacionados con la transacción
            DetalleTransaccion::where('transaccion_id', $transaccion->id)->delete();

            // Procesar los nuevos detalles de la transacción
            foreach ($validatedData['detalles'] as $detalle) {
                // Si el lote ya existe, actualizarlo, si no, crear uno nuevo
                $lote = Lote::updateOrCreate(
                    [
                        'producto_id' => $detalle['producto_id'],
                        'codigo' => $detalle['codigo_lote'],
                    ],
                    [
                        'fecha_vencimiento' => $detalle['fecha_vencimiento_lote'],
                        'cantidad_actual' => DB::raw("cantidad_actual + " . $detalle['cantidad']),
                        'cantidad_inicial' => DB::raw("cantidad_inicial + " . $detalle['cantidad']),
                        'costo_unitario' => $detalle['costo'],
                    ]
                );

                // Crear los nuevos detalles de la transacción
                DetalleTransaccion::create([
                    'transaccion_id' => $transaccion->id,
                    'producto_id' => $detalle['producto_id'],
                    'lote_id' => $lote->id,
                    'cantidad' => $detalle['cantidad'],
                    'precio_unitario' => $detalle['costo'],
                    'subtotal' => $detalle['cantidad'] * $detalle['costo'],
                ]);
            }

            DB::commit();

            return redirect()->route('transacciones.entradas.index')->with('success', 'La compra ha sido actualizada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al actualizar la compra. Intente nuevamente.');
        }
    }

    public function destroy_entrada($id)
    {
        DB::beginTransaction();
        try {
            // Buscar la transacción existente
            $transaccion = Transaccion::findOrFail($id);

            // Obtener los detalles de la transacción
            $detalles = DetalleTransaccion::where('transaccion_id', $transaccion->id)->get();

            // Verificar si los lotes están en uso en otras ventas
            foreach ($detalles as $detalle) {
                // Obtener el lote correspondiente
                $lote = Lote::find($detalle->lote_id);
                if ($lote) {
                    // Verificar si el lote está en uso en una venta activa
                    $loteEnUso = Transaccion::whereHas('detalles', function ($query) use ($lote) {
                        $query->where('lote_id', $lote->id)
                            ->where('transacciones.eliminado', false);
                    })->exists();

                    if ($loteEnUso) {
                        // Lanzar una excepción si el lote está en uso
                        throw new \Exception('El lote con código ' . $lote->codigo . ' está en uso en otra transacción y no se puede eliminar.');
                    }
                }
            }

            // Actualizar el stock de los lotes
            foreach ($detalles as $detalle) {
                $lote = Lote::find($detalle->lote_id);
                if ($lote) {
                    $lote->cantidad_actual -= $detalle->cantidad;
                    $lote->save();
                }
            }

            // Marcar la transacción principal como eliminada
            $transaccion->update(['eliminado' => true]);

            DB::commit();

            return redirect()->route('transacciones.entradas.index')->with('success', 'La compra ha sido eliminada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function generarPDF_entrada($id){
        $transaccion = Transaccion::findOrFail($id);

        // datos que quieres pasar a la vista para el PDF
        $data = [
            'transaccion' => $transaccion,
            // otros datos que necesites pasar
        ];

        // carga la vista y pasa los datos
        $pdf = PDF::loadView('reportes.entrada', $data);

        // elegir entre descargar el PDF o mostrarlo en el navegador
        //return $pdf->download('reporte_entrada_'.$id.'.pdf'); // Para descargar
        return $pdf->stream(); // Para mostrar en el navegador
    }

    // Funciones para Salidas

    public function index_salida()
    {
        $user = auth()->user(); // Obtener el usuario autenticado

        if ($user->role == 'auxiliar') {
            // Si el usuario es "Auxiliar", mostrar solo sus transacciones
            $salidas = Transaccion::where('tipo', 'Venta')
                                    ->where('user_id', $user->id)
                                    ->get();
        } else if ($user->role == 'administrador') {
            // Si no es "Auxiliar", mostrar todas las transacciones
            $salidas = Transaccion::where('tipo', 'Venta')->get();
        }

        //$salidas = Transaccion::where('tipo', 'Venta')->get();
        return view('transacciones.salidas.index', compact('salidas'));
    }

    public function create_salida()
    {
        $personas = Persona::where('tipo', 'Cliente')->get();

         // Filtrar productos que tienen lotes con stock mayor a 0
        $lotes = Lote::where('cantidad_actual', '>', 0)->get();

        // Agrupa los lotes por producto_id
        $lotesPorProducto = [];
        foreach ($lotes as $lote) {
            $lotesPorProducto[$lote->producto_id][] = $lote;
        }

        // Obtén los IDs de productos que tienen lotes con stock mayor a 0
        $productosConLotesIds = array_keys($lotesPorProducto);

        // Filtrar productos para solo incluir aquellos que tienen lotes con stock mayor a 0
        $productos = Producto::whereIn('id', $productosConLotesIds)
        ->where('eliminado',false)
        ->get();

        // Obtener precios válidos por producto
        $preciosPorProducto = [];
        foreach ($productos as $producto) {
            $preciosPorProducto[$producto->id] = $producto->precios; // Suponiendo que tienes la relación definida
        }

$numeroComprobante = 1;

        return view('transacciones.salidas.create', compact('personas','productos', 'lotesPorProducto', 'preciosPorProducto', 'numeroComprobante'));
    }

    public function store_salida(Request $request)
    {
        // Validar los datos principales de la transacción
        $validatedData = $request->validate([
            'tipo' => 'required|string',
            'persona_id' => 'required|exists:personas,id',
            'fecha' => 'required|date',
            'nombre_comprobante' => 'nullable|string',
            'numero_comprobante' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'total' => 'required|numeric|min:0',
            // Validación para los detalles de transacción
            'detalles' => 'required|array',
            'detalles.*.producto_id' => 'required|exists:productos,id',
            'detalles.*.lote_id' => 'required|exists:lotes,id',
            'detalles.*.cantidad' => 'required|numeric|min:1',
            'detalles.*.precio_unitario' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            // Crear la transacción principal
            $transaccion = Transaccion::create([
                'tipo' => $validatedData['tipo'],
                'persona_id' => $validatedData['persona_id'],
                'fecha' => $validatedData['fecha'],
                'nombre_comprobante' => $validatedData['nombre_comprobante'],
                'numero_comprobante' => $validatedData['numero_comprobante'],
                'user_id' => $validatedData['user_id'],
                'total' => $validatedData['total'],
                'estado' => 'Aprobado',
                'eliminado' => false,
            ]);

            // Procesar los detalles de la transacción
            foreach ($validatedData['detalles'] as $detalle) {
                // Actualizar la cantidad de los productos en el lote
                $lote = Lote::find($detalle['lote_id']);
                $lote->cantidad_actual -= $detalle['cantidad'];
                $lote->save();

                // Crear el detalle de la transacción
                DetalleTransaccion::create([
                    'transaccion_id' => $transaccion->id,
                    'producto_id' => $detalle['producto_id'],
                    'lote_id' => $lote->id,
                    'cantidad' => $detalle['cantidad'],
                    'precio_unitario' => $detalle['precio_unitario'],
                    'subtotal' => $detalle['cantidad'] * $detalle['precio_unitario'],
                ]);
            }

            DB::commit();

            return redirect()->route('transacciones.salidas.index')->with('success', 'Salida creada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al crear la Salida. Intente nuevamente.');
        }
    }

    public function edit_salida($id)
    {
        // Obtener la transacción por ID
        $salida = Transaccion::with('detalles')->findOrFail($id);

        // Obtener las personas (clientes)
        $personas = Persona::where('tipo', 'Cliente')->get();

        // Filtrar productos que tienen lotes con stock mayor a 0
        //$lotes = Lote::where('cantidad_actual', '>', 0)->get();
        $lotes = Lote::all();

        // Agrupa los lotes por producto_id
        $lotesPorProducto = [];
        foreach ($lotes as $lote) {
            $lotesPorProducto[$lote->producto_id][] = $lote;
        }

        // Obtén los IDs de productos que tienen lotes con stock mayor a 0
        $productosConLotesIds = array_keys($lotesPorProducto);

        // Filtrar productos para solo incluir aquellos que tienen lotes con stock mayor a 0
        $productos = Producto::whereIn('id', $productosConLotesIds)->get();

        // Cargar los detalles de la transacción para el formulario
        $detallesTransaccion = $salida->detalles;

        // Retornar la vista con los datos necesarios
        return view('transacciones.salidas.edit', compact('salida', 'detallesTransaccion', 'personas', 'productos', 'lotesPorProducto'));
    }

    public function update_salida(Request $request, $id)
    {
        // Validar los datos principales de la transacción
        $validatedData = $request->validate([
            'tipo' => 'required|string',
            'persona_id' => 'required|exists:personas,id',
            'fecha' => 'required|date',
            'nombre_comprobante' => 'required|string',
            'numero_comprobante' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'total' => 'required|numeric|min:0',
            // Validación para los detalles de transacción
            'detalles' => 'required|array',
            'detalles.*.producto_id' => 'required|exists:productos,id',
            'detalles.*.lote_id' => 'required|exists:lotes,id',
            'detalles.*.cantidad' => 'required|numeric|min:1',
            'detalles.*.precio_unitario' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            // Obtener la transacción existente
            $transaccion = Transaccion::findOrFail($id);

            // Revertir los cambios en los lotes anteriores
            foreach ($transaccion->detalles as $detalle) {
                $lote = Lote::find($detalle->lote_id);
                if ($lote) {
                    $lote->cantidad_actual += $detalle->cantidad; // Restablecer el stock
                    $lote->save();
                }
            }

            // Eliminar los detalles anteriores
            $transaccion->detalles()->delete();

            // Actualizar los datos de la transacción principal
            $transaccion->update([
                'tipo' => $validatedData['tipo'],
                'persona_id' => $validatedData['persona_id'],
                'fecha' => $validatedData['fecha'],
                'nombre_comprobante' => $validatedData['nombre_comprobante'],
                'numero_comprobante' => $validatedData['numero_comprobante'],
                'user_id' => $validatedData['user_id'],
                'total' => $validatedData['total'],
                'estado' => 'Aprobado', // Puedes mantener el estado o permitir actualizarlo
                'eliminado' => false,
            ]);

            // Procesar los nuevos detalles de la transacción
            foreach ($validatedData['detalles'] as $detalle) {
                // Actualizar la cantidad de los productos en el lote
                $lote = Lote::find($detalle['lote_id']);
                $lote->cantidad_actual -= $detalle['cantidad']; // Restar la nueva cantidad
                $lote->save();

                // Crear el detalle de la transacción
                DetalleTransaccion::create([
                    'transaccion_id' => $transaccion->id,
                    'producto_id' => $detalle['producto_id'],
                    'lote_id' => $lote->id,
                    'cantidad' => $detalle['cantidad'],
                    'precio_unitario' => $detalle['precio_unitario'],
                    'subtotal' => $detalle['cantidad'] * $detalle['precio_unitario'],
                ]);
            }

            DB::commit();

            return redirect()->route('transacciones.salidas.index')->with('success', 'Venta actualizada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al actualizar la Venta. Intente nuevamente.');
        }
    }

    public function destroy_salida($id)
    {
        DB::beginTransaction();
        try {
            // Buscar la transacción de salida
            $transaccion = Transaccion::findOrFail($id);

            // Marcar la transacción como eliminada (lógica de eliminación lógica)
            $transaccion->update(['eliminado' => true]);

            // Obtener los detalles de la transacción
            $detalles = DetalleTransaccion::where('transaccion_id', $transaccion->id)->get();

            // Actualizar las cantidades de los lotes asociados
            foreach ($detalles as $detalle) {
                $lote = Lote::find($detalle->lote_id);
                if ($lote) {
                    // Incrementar la cantidad actual del lote
                    $lote->cantidad_actual += $detalle->cantidad;
                    $lote->save();
                }
            }

            DB::commit();
            return redirect()->route('transacciones.salidas.index')->with('success', 'Venta eliminada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al eliminar la venta. Intente nuevamente.');
        }
    }

    public function generarPDF_salida($id){
        $transaccion = Transaccion::findOrFail($id);

        // datos que quieres pasar a la vista para el PDF
        $data = [
            'transaccion' => $transaccion,
            // otros datos que necesites pasar
        ];

        // carga la vista y pasa los datos
        $pdf = PDF::loadView('reportes.salida', $data);

        // elegir entre descargar el PDF o mostrarlo en el navegador
        //return $pdf->download('reporte_entrada_'.$id.'.pdf'); // Para descargar
        return $pdf->stream(); // Para mostrar en el navegador
    }

}
