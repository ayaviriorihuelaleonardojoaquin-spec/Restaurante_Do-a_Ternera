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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Editar</a></li>
                </ol>
            </div>
        </div>

        @include('components.alerts.errors')

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Editar Pedido</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('pedidos.store') }}">
                                @csrf

                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="mesa_id">Mesa</label>
                                        <select name="mesa_id" id="mesa_id" class="form-control" required>
                                            <option value="">Seleccione una mesa</option>
                                            @foreach ($mesas as $mesa)
                                                <option value="{{ $mesa->id }}" {{ old('mesa_id') == $mesa->id ? 'selected' : '' }}>
                                                    {{ $mesa->numero }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="estado">Estado</label>
                                        <select name="estado" id="estado" class="form-control" required>
                                            <option value="pendiente" {{ old('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                            <option value="en_proceso" {{ old('estado') == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                                            <option value="finalizado" {{ old('estado') == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
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
        @if(old('detalles'))
            @foreach(old('detalles') as $index => $detalle)
                <tr>
                    <td>
                        <select name="detalles[{{ $index }}][plato_id]" class="form-control plato-select" required>
                            <option value="">Seleccione un plato</option>
                            @foreach ($platos as $plato)
                                <option value="{{ $plato->id }}" data-precio="{{ $plato->precio }}" {{ $detalle['plato_id'] == $plato->id ? 'selected' : '' }}>
                                    {{ $plato->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" name="detalles[{{ $index }}][cantidad]" class="form-control cantidad-input" min="1" value="{{ $detalle['cantidad'] }}" required>
                    </td>
                    <td>
                        <input type="number" step="0.01" name="detalles[{{ $index }}][precio]" class="form-control precio-input" min="0" value="{{ $detalle['precio'] }}" readonly>
                    </td>
                    <td>
                        <input type="number" step="0.01" class="form-control subtotal-input" value="{{ $detalle['cantidad'] * $detalle['precio'] }}" readonly>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm btn-remove">-</button>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                
            </tr>
        @endif
    </tbody>
</table>

<div class="text-right mt-3">
    <h5>Total: Bs. <span id="total-final">0.00</span></h5>
</div>



                                <button type="submit" class="btn btn-primary">Actualizar</button>

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

    // Función para actualizar precio y subtotal al cambiar plato o cantidad
    function actualizarFila(row) {
        let platoSelect = row.querySelector('.plato-select');
        let cantidadInput = row.querySelector('.cantidad-input');
        let precioInput = row.querySelector('.precio-input');
        let subtotalInput = row.querySelector('.subtotal-input');

        let precio = 0;
        let cantidad = parseFloat(cantidadInput.value) || 0;

        // Obtener precio desde el atributo data-precio del plato seleccionado
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

    // Función para actualizar el total final
    function actualizarTotalFinal() {
        let subtotalInputs = detallesTable.querySelectorAll('.subtotal-input');
        let total = 0;
        subtotalInputs.forEach(input => {
            total += parseFloat(input.value) || 0;
        });
        totalFinalEl.textContent = total.toFixed(2);
    }

    // Agregar fila nueva
    addBtn.addEventListener('click', function () {
        let index = detallesTable.rows.length;
        let newRow = document.createElement('tr');

        // Aquí se genera el select de platos con data-precio para cada opción
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

        // Asociar eventos para actualizar al cambiar plato o cantidad
        agregarEventosFila(newRow);
    });

    // Remover fila y reindexar
    detallesTable.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('btn-remove')) {
            let row = e.target.closest('tr');
            if (detallesTable.rows.length > 1) {
                row.remove();
                reindexarFilas();
                actualizarTotalFinal();
            } else {
                alert('Debe haber al menos un detalle.');
            }
        }
    });

    // Función para reindexar inputs al eliminar fila
    function reindexarFilas() {
        Array.from(detallesTable.rows).forEach((row, i) => {
            row.querySelectorAll('select, input').forEach(input => {
                let name = input.name;
                if(name) {
                    let newName = name.replace(/\d+/, i);
                    input.name = newName;
                }
            });
        });
    }

    // Agregar eventos a los selects y inputs para actualizar subtotal y total
    function agregarEventosFila(row) {
        let platoSelect = row.querySelector('.plato-select');
        let cantidadInput = row.querySelector('.cantidad-input');

        platoSelect.addEventListener('change', () => actualizarFila(row));
        cantidadInput.addEventListener('input', () => actualizarFila(row));
    }

    // Inicializar eventos para filas ya existentes
    Array.from(detallesTable.rows).forEach(row => {
        agregarEventosFila(row);
        actualizarFila(row);
    });

});

</script>
@endsection
