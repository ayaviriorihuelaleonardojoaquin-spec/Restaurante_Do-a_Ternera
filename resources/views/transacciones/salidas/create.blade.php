@extends('layouts.private')

@section('page-title', 'Registrar Venta')

@php
    // Definir los breadcrumbs como un array
    $breadcrumbs = [
        ['name' => 'Dashboard', 'url' => route('dashboard')],
        ['name' => 'Ventas', 'url' => route('transacciones.salidas.index')],
        ['name' => 'Registrar', 'url' => route('transacciones.salidas.create')],
    ];
@endphp

@section('contenido')

@if (session('error'))
<div class="alert alert-danger d-flex align-items-center" role="alert">
    <svg class="flex-shrink-0 me-2 svg-danger" xmlns="http://www.w3.org/2000/svg" height="1.5rem" viewBox="0 0 24 24"
        width="1.5rem" fill="#000000">
        <path d="M0 0h24v24H0V0zm0 0h24v24H0V0z" fill="none"></path>
        <path
            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zM11 7h2v6h-2zm0 8h2v2h-2z">
        </path>
    </svg>
    <div>
        {{ session('error') }}
    </div>
</div>
@endif

    @error('detalles')
    <div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg class="flex-shrink-0 me-2 svg-danger" xmlns="http://www.w3.org/2000/svg" height="1.5rem" viewBox="0 0 24 24"
        width="1.5rem" fill="#000000">
        <path d="M0 0h24v24H0V0zm0 0h24v24H0V0z" fill="none"></path>
        <path
            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zM11 7h2v6h-2zm0 8h2v2h-2z">
        </path>
    </svg>
        <div>
            Debe tener al menos 1 detalle
        </div>
    </div>
    @enderror

    <div class="row">

        <form id="transaccionForm" method="POST" action="{{ route('transacciones.salidas.store') }}">
            @csrf

            <input type="text" class="form-control" id="user_id" name="user_id" value="{{ Auth::id() }}" hidden>

            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                            Encabezado
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="tipo" class="form-label fs-14 text-dark">Tipo de transacción</label>
                                    <input class="form-control bg-gray-200 readonly-input" type="text" value="Venta" id="tipo" name="tipo" readonly>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="persona_id" class="form-label fs-14 text-dark">Cliente <span class="text-danger font-weight-bold"> *</span></label>
                                    <select class="form-control js-example-basic-single" id="persona_id" name="persona_id" required>
                                        <option value="">Seleccione</option>
                                        @foreach ($personas as $persona)
                                            <option value="{{ $persona->id }}">{{ $persona->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="fecha" class="form-label fs-14 text-dark ">Fecha</label>
                                    <input type="date" class="form-control bg-gray-200 readonly-input" id="fecha" name="fecha" value="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="nombre_comprobante" class="form-label fs-14 text-dark">Nombre
                                        Comprobante </label>
                                    <input type="text" class="form-control" id="nombre_comprobante"
                                        name="nombre_comprobante" placeholder="" value="General">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="numero_comprobante" class="form-label fs-14 text-dark">Numero
                                        Comprobante</label>
                                    <input type="text" class="form-control" id="numero_comprobante"
                                        name="numero_comprobante" placeholder="" value="{{ $numeroComprobante }}">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="total" class="form-label fs-14 text-dark">Total</label>
                                    <input type="text" class="form-control bg-gray-200 readonly-input" id="total" name="total" placeholder=""
                                        required readonly value="0.00">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                            Detalle
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" id="detallesTable">
                            <thead>
                                <tr>
                                    <th class="w-25">Producto <span class="text-danger font-weight-bold"> *</span></th>
                                    <th class="w-20">Lote <span class="text-danger font-weight-bold"> *</span></th>
                                    <th>Cantidad <span class="text-danger font-weight-bold"> *</span></th>
                                    <th>Precio unitario <span class="text-danger font-weight-bold"> *</span></th>
                                    <th>Subtotal</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se agregarán dinámicamente los detalles -->
                            </tbody>
                        </table>

                        <div class="my-2">
                            <button type="button" class="btn btn-success" id="addDetalle">+</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="my-2">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <a href="{{ route('transacciones.salidas.index') }}" class="btn btn-light">Cancelar</a>
            </div>
        </form>
    </div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const lotesPorProducto = @json($lotesPorProducto);
        const preciosPorProducto = @json($preciosPorProducto);
        const detallesTableBody = document.querySelector('#detallesTable tbody');
        const addDetalleBtn = document.getElementById('addDetalle');
        let detalleIndex = 0;

        addDetalleBtn.addEventListener('click', function() {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>
                    <select id="detalles[${detalleIndex}][producto_id]" name="detalles[${detalleIndex}][producto_id]" aria-label="Seleccione"
                        data-control="select2" data-placeholder="Seleccione..."
                        class="form-select producto form-select-solid form-select-lg">
                            <option value="">Seleccione</option>
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                            @endforeach
                    </select>
                </td>
                <td>
                    <select id="detalles[${detalleIndex}][lote_id]" class="form-control lote" name="detalles[${detalleIndex}][lote_id]" required>
                        <option value="">Seleccione</option>
                    </select>
                </td>
                <td>
                    <input type="number" class="form-control cantidad" name="detalles[${detalleIndex}][cantidad]" required min="1" value="1">
                </td>
                <td>
                    <select id="detalles[${detalleIndex}][precio_unitario]" class="form-control precio_unitario" name="detalles[${detalleIndex}][precio_unitario]" required>
                        <option value="">Seleccione Precio</option>
                    </select>
                </td>
                <td>
                    <input type="number" class="form-control readonly-input subtotal" name="detalles[${detalleIndex}][subtotal]" value="0.00" readonly>
                </td>
                <td>
                    <button type="button" class="btn btn-danger removeDetalle">-</button>
                </td>
            `;

            detallesTableBody.appendChild(newRow);

            // Inicializa select2 para el select de producto
            $(`#detalles\\[${detalleIndex}\\]\\[producto_id\\]`).select2();
            $(`#detalles\\[${detalleIndex}\\]\\[lote_id\\]`).select2();
            $(`#detalles\\[${detalleIndex}\\]\\[precio_unitario\\]`).select2();

            // Vuelve a asociar el evento change después de inicializar select2
            $(`#detalles\\[${detalleIndex}\\]\\[producto_id\\]`).on('change', function() {
                const productoId = this.value;
                const selectLote = newRow.querySelector('.lote');
                const selectPrecio = newRow.querySelector('.precio_unitario');

                selectLote.innerHTML = '<option value="">Seleccione</option>'; // Limpiar lotes anteriores
                selectPrecio.innerHTML = '<option value="">Seleccione Precio</option>'; // Limpiar precios anteriores

                if (productoId) {
                    const lotes = lotesPorProducto[productoId] || [];
                    lotes.forEach(function(lote) {
                        const option = document.createElement('option');
                        option.value = lote.id;
                        option.dataset.stock = lote.cantidad_actual;
                        option.text = `Lote: ${lote.codigo}, Stock: ${lote.cantidad_actual}`;
                        selectLote.appendChild(option);
                    });

                    // Agregar precios para el producto seleccionado
                    const precios = preciosPorProducto[productoId] || [];
                    precios.forEach(function(precio) {
                        const option = document.createElement('option');
                        option.value = precio.precio;
                        option.text = precio.precio;
                        selectPrecio.appendChild(option);
                    });
                }
            });

            // Añade el evento de eliminación
            newRow.querySelector('.removeDetalle').addEventListener('click', function() {
                newRow.remove();
                calcularTotal();
            });

            // Añade eventos de cálculo del subtotal para los elementos select2
            $(`#detalles\\[${detalleIndex}\\]\\[cantidad\\]`).on('select2:select', calcularSubtotal);
            newRow.querySelector('.cantidad').addEventListener('input', calcularSubtotal);

            $(`#detalles\\[${detalleIndex}\\]\\[precio_unitario\\]`).on('select2:select', calcularSubtotal);
            newRow.querySelector('.precio_unitario').addEventListener('change', calcularSubtotal);

            detalleIndex++;
        });

        // Función para calcular el subtotal en cada fila
        function calcularSubtotal(event) {
            const row = event.target.closest('tr');
            const cantidad = row.querySelector('.cantidad').value;
            const precio_unitario = row.querySelector('.precio_unitario').value;
            const subtotal = row.querySelector('.subtotal');

            subtotal.value = (cantidad * precio_unitario).toFixed(2);
            calcularTotal();
        }

        // Función para calcular el total general
        function calcularTotal() {
            let total = 0;
            document.querySelectorAll('.subtotal').forEach(function(subtotalField) {
                total += parseFloat(subtotalField.value) || 0;
            });

            document.getElementById('total').value = total.toFixed(2);
        }
    });
</script>
@endsection
