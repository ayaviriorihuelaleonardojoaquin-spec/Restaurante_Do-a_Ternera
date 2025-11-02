@extends('layouts.private')

@section('content')
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #101011ff, #131111ff); min-height: 100vh;">
    <!-- 🧭 Encabezado -->
    <div class="row page-titles mx-0 mb-4">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4 class="text-primary fw-bold">🧾 Nuevo Pedido</h4>
                <p class="mb-0">Registra un nuevo pedido en el sistema</p>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pedidos.index') }}">Pedidos</a></li>
                <li class="breadcrumb-item active">Nuevo</li>
            </ol>
        </div>
    </div>

    @include('components.alerts.errors')

    <!-- 🧾 Formulario -->
    <div class="row justify-content-center mt-3">
        <div class="col-xl-10 col-lg-11">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-secondary text-white rounded-top-4">
                    <h4 class="card-title mb-0 fw-semibold text-white">
                        <i class="fa fa-receipt me-2"></i> Datos del Pedido
                    </h4>
                </div>

                <div class="card-body p-5" style="background-color: #b3b3b3; border-radius: 0 0 1rem 1rem;">
                    <form method="POST" action="{{ route('pedidos.store') }}">
                        @csrf

                        <div class="row g-4">
                            <!-- Tipo de pedido -->
                            <div class="form-group col-md-4">
                                <label for="tipo" class="form-label fw-semibold text-black">Tipo de Pedido</label>
                                <select name="tipo" id="tipo" class="form-control shadow-sm border rounded-3 p-0" required>
                                    <option value="">Seleccione su pedido</option>
                                    <option value="mesa" {{ old('tipo') == 'mesa' ? 'selected' : '' }}>Para la mesa</option>
                                    <option value="llevar" {{ old('tipo') == 'llevar' ? 'selected' : '' }}>Para llevar</option>
                                </select>
                            </div>

                            <!-- Nombre del cliente -->
                            <div class="form-group col-md-4" >
                                <label for="nombre" class="form-label fw-semibold text-black" >Nombre del Cliente</label>
                                <input type="text" name="nombre" id="nombre"
                                       class="form-control shadow-sm border rounded-3 p-3" required
                                       value="{{ old('nombre') }}" placeholder="Ej: Juan Pérez">
                            </div>

                            <!-- Mesa -->
                            <div class="form-group col-md-4">
                                <label for="mesa_id" class="form-label fw-semibold text-black">Mesa</label>
                                <select name="mesa_id" id="mesa_id" class="form-control shadow-sm border rounded-3 p-0" required>
                                    <option value="">Seleccione una mesa</option>
                                    @foreach ($mesas as $mesa)
                                        <option value="{{ $mesa->id }}" {{ old('mesa_id') == $mesa->id ? 'selected' : '' }}>
                                            Mesa {{ $mesa->numero }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Estado -->
                            <div class="form-group col-md-4">
                                <label for="estado" class="form-label fw-semibold text-black">Estado</label>
                                <select name="estado" id="estado" class="form-control shadow-sm border rounded-3 p-0" required>
                                    <option value="pendiente" {{ old('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="en_proceso" {{ old('estado') == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                                    <option value="finalizado" {{ old('estado') == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                                </select>
                            </div>

                            <!-- Método de pago -->
                            <div class="form-group col-md-4">
                                <label for="metodo_pago" class="form-label fw-semibold text-black">Método de Pago</label>
                                <select name="metodo_pago" id="metodo_pago" class="form-control shadow-sm border rounded-3 p-0" required>
                                    <option value="">Seleccione...</option>
                                    <option value="efectivo" {{ old('metodo_pago', $pedido->metodo_pago ?? '') == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                                    <option value="transferencia" {{ old('metodo_pago', $pedido->metodo_pago ?? '') == 'transferencia' ? 'selected' : '' }}>Transferencia</option>
                                    <option value="qr" {{ old('metodo_pago', $pedido->metodo_pago ?? '') == 'qr' ? 'selected' : '' }}>QR</option>
                                </select>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- 🧾 Detalles del Pedido -->
                        <h5 class="fw-bold text-dark mb-3"><i class="fa fa-utensils me-2"></i> Detalles del Pedido</h5>

                        <div class="table-responsive">
                            <table class="table table-bordered align-middle text-center" id="detalles-table">
                                <thead class="table-dark text-white">
                                    <tr>
                                        <th>Plato</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Subtotal</th>
                                        <th>
                                            <button type="button" id="addDetalle" class="btn btn-success btn-sm rounded-3">+</button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr></tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="text-end mt-4">
                            <h5 class="fw-bold text-dark">Total: Bs. <span id="total-final">0.00</span></h5>
                        </div>

                        <!-- Botones -->
                        <div class="d-flex justify-content-center mt-5 gap-3">
                            <a href="{{ route('pedidos.index') }}" class="btn btn-secondary btn-lg rounded-3 px-4">
                                <i class="fa fa-arrow-left"></i> Cancelar
                            </a>

                            <button type="submit" class="btn btn-primary btn-lg rounded-3 px-4"
                                style="background: linear-gradient(135deg); border: none;">
                                Guardar Pedido
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- 🎨 Estilos personalizados --}}
<style>
    .form-control {
        border-radius: 10px;
        border: 2px solid #cbd5e1;
        transition: all 0.2s ease;
    }

    .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 6px rgba(37, 99, 235, 0.3);
    }

    .btn-primary {
        background-color: #2563eb;
        border-color: #2563eb;
    }

    .btn-primary:hover {
        background-color: #3152acff;
        border-color: #3152acff;
    }

    .btn-secondary {
        background-color: #dd1212ff;
        border-color: #dd1212ff;
    }

    .btn-secondary:hover {
        background-color: #c52e2eff;
        border-color: #c52e2eff;
    }

    table th, table td {
        vertical-align: middle;
    }
</style>
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
                    <select name="detalles[${index}][plato_id]" class="form-control plato-select shadow-sm border rounded-3" required>
                        <option value="">Seleccione un plato</option>
                        ${platosOptions}
                    </select>
                </td>
                <td>
                    <input type="number" name="detalles[${index}][cantidad]" class="form-control cantidad-input shadow-sm border rounded-3" min="1" value="1" required>
                </td>
                <td>
                    <input type="number" step="0.01" name="detalles[${index}][precio]" class="form-control precio-input shadow-sm border rounded-3" min="0" value="0" readonly>
                </td>
                <td>
                    <input type="number" step="0.01" name="detalles[${index}][subtotal]" class="form-control subtotal-input shadow-sm border rounded-3" value="0" readonly>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm rounded-3 btn-remove">-</button>
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
