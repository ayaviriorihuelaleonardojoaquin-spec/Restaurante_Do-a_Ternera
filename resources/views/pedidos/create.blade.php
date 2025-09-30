@extends('layouts.private')

@section('content')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Pedidos</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Pedidos</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Crear</a></li>
                </ol>
            </div>
        </div>

        @include('components.alerts.errors')

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Datos del Pedido</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('pedidos.store') }}">
                                @csrf

                                <div class="form-row">
                                    <!-- Tipo de pedido -->
                                    <div class="form-group col-md-4">
                                        <label for="tipo">Tipo de Pedido</label>
                                        <select name="tipo" id="tipo" class="form-control" required>
                                            <option value="">Seleccione su pedido si es:</option>
                                            <option value="mesa" {{ old('tipo') == 'mesa' ? 'selected' : '' }}>Para la mesa</option>
                                            <option value="llevar" {{ old('tipo') == 'llevar' ? 'selected' : '' }}>Para llevar</option>
                                        </select>
                                    </div>

                                    <!-- Nombre del cliente -->
                                    <div class="form-group col-md-4">
                                        <label for="nombre">Nombre del Cliente</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control"
                                               value="{{ old('nombre') }}" placeholder="Ej: Juan Pérez">
                                    </div>

                                    <!-- Mesa -->
                                    <div class="form-group col-md-4">
                                        <label for="mesa_id">Mesa</label>
                                        <select name="mesa_id" id="mesa_id" class="form-control">
                                            <option value="">Seleccione una mesa</option>
                                            @foreach ($mesas as $mesa)
                                                <option value="{{ $mesa->id }}" {{ old('mesa_id') == $mesa->id ? 'selected' : '' }}>
                                                    Mesa {{ $mesa->numero }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <!-- Estado -->
                                    <div class="form-group col-md-4">
                                        <label for="estado">Estado</label>
                                        <select name="estado" id="estado" class="form-control" required>
                                            <option value="pendiente" {{ old('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                            <option value="en_proceso" {{ old('estado') == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                                            <option value="finalizado" {{ old('estado') == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                                        </select>
                                    </div>

                                    <!-- Método de pago -->
                                    <div class="form-group col-md-4">
                                        <label for="metodo_pago">Método de Pago</label>
                                        <select name="metodo_pago" id="metodo_pago" class="form-control" required>
                                            <option value="">Seleccione un método</option>
                                            <option value="efectivo" {{ old('metodo_pago') == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                                            <option value="transferencia" {{ old('metodo_pago') == 'transferencia' ? 'selected' : '' }}>Transferencia</option>
                                            <option value="tarjeta" {{ old('metodo_pago') == 'tarjeta' ? 'selected' : '' }}>Tarjeta</option>
                                        </select>
                                    </div>
                                </div>

                                <hr>

                                <h5>Detalles del Pedido</h5>

                                <table class="table" id="detalles-table">
                                    <thead>
                                        <tr>
                                            <th>Plato</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Subtotal</th>
                                            <th>
                                                <button type="button" id="addDetalle" class="btn btn-success btn-sm">+</button>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr></tr>
                                    </tbody>
                                </table>

                                <div class="text-right mt-3">
                                    <h5>Total: Bs. <span id="total-final">0.00</span></h5>
                                </div>

                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let detallesTable = document.getElementById('detalles-table').getElementsByTagName('tbody')[0];
        let addBtn = document.getElementById('addDetalle');
        let totalFinalEl = document.getElementById('total-final');

        function actualizarFila(row) {
            let platoSelect = row.querySelector('.plato-select');
            let cantidadInput = row.querySelector('.cantidad-input');
            let precioInput = row.querySelector('.precio-input');
            let subtotalInput = row.querySelector('.subtotal-input');

            let precio = 0;
            let cantidad = parseFloat(cantidadInput.value) || 0;

            if (platoSelect.value) {
                let option = platoSelect.querySelector('option[value="' + platoSelect.value + '"]');
                if (option) {
                    precio = parseFloat(option.getAttribute('data-precio')) || 0;
                }
            }

            precioInput.value = precio.toFixed(2);
            subtotalInput.value = (precio * cantidad).toFixed(2);

            actualizarTotalFinal();
        }

        function actualizarTotalFinal() {
            let subtotalInputs = detallesTable.querySelectorAll('.subtotal-input');
            let total = 0;
            subtotalInputs.forEach(input => {
                total += parseFloat(input.value) || 0;
            });
            totalFinalEl.textContent = total.toFixed(2);
        }

        addBtn.addEventListener('click', function () {
            let index = detallesTable.rows.length;
            let newRow = document.createElement('tr');

            let platosOptions = '';
            @foreach ($platos as $plato)
                platosOptions += `<option value="{{ $plato->id }}" data-precio="{{ $plato->precio }}">{{ $plato->nombre }}</option>`;
            @endforeach

            newRow.innerHTML = `
                <td>
                    <select name="detalles[${index}][plato_id]" class="form-control plato-select" required>
                        <option value="">Seleccione un plato</option>
                        ${platosOptions}
                    </select>
                </td>
                <td>
                    <input type="number" name="detalles[${index}][cantidad]" class="form-control cantidad-input" min="1" value="1" required>
                </td>
                <td>
                    <input type="number" step="0.01" name="detalles[${index}][precio]" class="form-control precio-input" min="0" value="0" readonly>
                </td>
                <td>
                    <input type="number" step="0.01" name="detalles[${index}][subtotal]" class="form-control subtotal-input" value="0" readonly>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm btn-remove">-</button>
                </td>
            `;

            detallesTable.appendChild(newRow);
            agregarEventosFila(newRow);
        });

        detallesTable.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('btn-remove')) {
                let row = e.target.closest('tr');
                row.remove();
                reindexarFilas();
                actualizarTotalFinal();
            }
        });

        function reindexarFilas() {
            Array.from(detallesTable.rows).forEach((row, i) => {
                row.querySelectorAll('select, input').forEach(input => {
                    let name = input.name;
                    if(name) {
                        input.name = name.replace(/\d+/, i);
                    }
                });
            });
        }

        function agregarEventosFila(row) {
            let platoSelect = row.querySelector('.plato-select');
            let cantidadInput = row.querySelector('.cantidad-input');

            platoSelect.addEventListener('change', () => actualizarFila(row));
            cantidadInput.addEventListener('input', () => actualizarFila(row));
        }
    });
</script>
@endsection
