@extends('layouts.private')

@section('content')
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #101011ff, #131111ff); min-height: 100vh;">
    <div class="row page-titles mx-0 mb-4">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4 class="text-primary fw-bold">Historial de Pedidos</h4>
                <p class="text-light mb-0">Resumen de platos solicitados</p>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Historial</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-header bg-secondary rounded-top-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
                    <h4 class="card-title mb-0 fw-semibold text-white">
                        <i class="fa fa-clipboard-list me-2"></i> Resumen de Pedidos por Comida
                    </h4>
                    <input type="text" id="buscarPlato" class="form-control" placeholder="Buscar plato..." style="width: 220px;">
                </div>

                <div class="card-body p-5" style="background-color: #b3b3b3; border-radius: 0 0 1rem 1rem;">
                    <div class="table-responsive">
                        <table id="tablaHistorial" class="table table align-middle mb-0" style="min-width: 845px; border-radius: 12px; overflow: hidden;">
                            <thead class="bg-black text-white">
                                <tr>
                                    <th>#</th>
                                    <th>Plato</th>
                                    <th>Cantidad Total Vendida</th>
                                    <th>Ventas Totales (Bs)</th>
                                    <th>Pedidos en los que aparece</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($resumenPlatos as $index => $plato)
                                <tr class="pedido-row text-black">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $plato->nombre }}</td>
                                    <td>{{ $plato->total_cantidad }}</td>
                                    <td>Bs. {{ number_format($plato->total_venta, 2) }}</td>
                                    <td>{{ $plato->total_pedidos }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4 text-end">
                        <h5 class="fw-bold text-dark">
                            Total general: Bs. {{ number_format($resumenPlatos->sum('total_venta'), 2) }}
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- 🎨 Estilos --}}
<style>
    .table thead th {
        background-color: #1f2937 !important;
        color: white !important;
        font-weight: 600;
    }

    thead tr th {
        border-right: 1px solid white !important;
        border-bottom: 2px solid white !important;
        background-color: #000000 !important;
        color: #ffffff !important;
    }

    .pedido-row {
        background-color: #f6f8f3ff;
        border: 2px solid #dcdcdc;
        border-radius: 12px;
        box-shadow: 0 3px 8px rgba(241, 239, 239, 0.08);
        transition: all 0.2s ease-in-out;
    }

    .pedido-row:hover {
        background-color: #f7f9fc;
        border-color: #b3b3b3;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.12);
        transform: scale(1.01);
    }
</style>

{{-- 🔍 Buscador --}}
<script>
    document.getElementById('buscarPlato').addEventListener('keyup', function () {
        let filtro = this.value.toLowerCase();
        let filas = document.querySelectorAll('#tablaHistorial tbody tr');

        filas.forEach(fila => {
            let textoFila = fila.textContent.toLowerCase();
            fila.style.display = textoFila.includes(filtro) ? '' : 'none';
        });
    });
</script>
@endsection
