@extends('layouts.private')

@section('page-title', 'Editar Compra')

@php
    // Definir los breadcrumbs como un array
    $breadcrumbs = [
        ['name' => 'Dashboard', 'url' => route('dashboard')],
        ['name' => 'Compras', 'url' => route('transacciones.entradas.index')],
        ['name' => 'Editar', 'url' => route('transacciones.entradas.edit',$entrada->id)],
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

        <form id="transaccionForm" method="POST" action="{{ route('transacciones.entradas.update', $entrada->id) }}">
            @csrf
            @method('PUT') <!-- Método PUT para la actualización -->

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
                                    <label for="id" class="form-label fs-14 text-dark">ID</label>
                                    <input class="form-control bg-gray-200" type="text" value="{{ $entrada->id }}" id="id" name="id"
                                        readonly>
                                    @error('id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="tipo" class="form-label fs-14 text-dark">Tipo de transacción</label>
                                    <input class="form-control bg-gray-200" type="text" value="Compra" id="tipo" name="tipo"
                                        readonly>
                                    @error('tipo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="persona_id" class="form-label fs-14 text-dark">Proveedor <span class="text-danger font-weight-bold"> *</span></label>
                                    <select class="form-control js-example-basic-single" id="persona_id" name="persona_id" required>
                                        <option value="">Seleccione</option>
                                        @foreach ($personas as $persona)
                                            <option value="{{ $persona->id }}" {{ $persona->id == $entrada->persona_id ? 'selected' : '' }}>
                                                {{ $persona->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('persona_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="fecha" class="form-label fs-14 text-dark">Fecha <span class="text-danger font-weight-bold"> *</span></label>
                                    <input type="date" class="form-control bg-gray-200" id="fecha" name="fecha"
                                        value="{{ $entrada->fecha }}" required>
                                    @error('fecha')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="total" class="form-label fs-14 text-dark">Total</label>
                                    <input type="text" class="form-control bg-gray-200" id="total" name="total"
                                        placeholder="" required readonly value="{{ $entrada->total }}">
                                    @error('total')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
                                    <th class="w-20">Cantidad <span class="text-danger font-weight-bold"> *</span></th>
                                    <th>Costo <span class="text-danger font-weight-bold"> *</span></th>
                                    <th>Codigo Lote <span class="text-danger font-weight-bold"> *</span></th>
                                    <th>Fecha Venc. Lote <span class="text-danger font-weight-bold"> *</span></th>
                                    <th>Subtotal</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($entrada->detalles as $index => $detalle)
                                    <tr>
                                        <td>
                                            <select class="form-control js-example-basic-single" name="detalles[{{ $index }}][producto_id]" required>
                                                <option value="">Seleccione</option>
                                                @foreach ($productos as $producto)
                                                    <option value="{{ $producto->id }}" {{ $producto->id == $detalle->producto_id ? 'selected' : '' }}>
                                                        {{ $producto->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control cantidad" name="detalles[{{ $index }}][cantidad]" required min="1" value="{{ $detalle->cantidad }}">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control costo" name="detalles[{{ $index }}][costo]" required min="0" step="0.01" value="{{ $detalle->precio_unitario }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control codigo_lote" name="detalles[{{ $index }}][codigo_lote]" required value="{{ $detalle->lote->codigo }}">
                                        </td>
                                        <td>
                                            <input type="date" class="form-control fecha_vencimiento_lote" name="detalles[{{ $index }}][fecha_vencimiento_lote]" required value="{{ $detalle->lote->fecha_vencimiento }}">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control bg-gray-200 subtotal" name="detalles[{{ $index }}][subtotal]" readonly value="{{ $detalle->subtotal }}">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger removeDetalle">-</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="my-2">
                            <button type="button" class="btn btn-success" id="addDetalle">+</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="my-2">
                <button class="btn btn-primary" type="submit">Actualizar</button>
                <a href="{{ route('transacciones.entradas.index') }}" class="btn btn-light">Cancelar</a>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const detallesTableBody = document.querySelector('#detallesTable tbody');
            const addDetalleBtn = document.getElementById('addDetalle');
            let detalleIndex = {{ count($entrada->detalles) }}; // Empezamos con el número de detalles ya existentes

            addDetalleBtn.addEventListener('click', function() {
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                <td>
                    <select id="detalles[${detalleIndex}][producto_id]" name="detalles[${detalleIndex}][producto_id]" aria-label="Seleccione"
                        data-control="select2" data-placeholder="Seleccione..."
                        class="form-select form-select-solid form-select-lg">
                            <option value="">Seleccione</option>
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                            @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" class="form-control cantidad" name="detalles[${detalleIndex}][cantidad]" required min="1" value="1">
                </td>
                <td>
                    <input type="number" class="form-control costo" name="detalles[${detalleIndex}][costo]" required min="0" step="0.01">
                </td>
                <td>
                    <input type="text" class="form-control codigo_lote" name="detalles[${detalleIndex}][codigo_lote]" required>
                </td>
                <td>
                    <input type="date" class="form-control fecha_vencimiento_lote" name="detalles[${detalleIndex}][fecha_vencimiento_lote]" required>
                </td>
                <td>
                    <input type="number" class="form-control bg-gray-200 subtotal" name="detalles[${detalleIndex}][subtotal]" readonly>
                </td>
                <td>
                    <button type="button" class="btn btn-danger removeDetalle">-</button>
                </td>
                `;
                detallesTableBody.appendChild(newRow);

                $(`#detalles\\[${detalleIndex}\\]\\[producto_id\\]`).select2();

                detalleIndex++;
            });

            detallesTableBody.addEventListener('click', function(e) {
                if (e.target.classList.contains('removeDetalle')) {
                    e.target.closest('tr').remove();
                }
            });

            // Calcula el subtotal cuando se cambian cantidad o costo
            detallesTableBody.addEventListener('input', function(e) {
                if (e.target.classList.contains('cantidad') || e.target.classList.contains('costo')) {
                    const row = e.target.closest('tr');
                    const cantidad = row.querySelector('.cantidad').value || 0;
                    const costo = row.querySelector('.costo').value || 0;
                    const subtotal = row.querySelector('.subtotal');
                    subtotal.value = (cantidad * costo).toFixed(2);
                    calcularTotal();
                }
            });

            function calcularTotal() {
                let total = 0;
                document.querySelectorAll('.subtotal').forEach(function(subtotalInput) {
                    total += parseFloat(subtotalInput.value) || 0;
                });
                document.getElementById('total').value = total.toFixed(2);
            }
        });
    </script>
@endsection
