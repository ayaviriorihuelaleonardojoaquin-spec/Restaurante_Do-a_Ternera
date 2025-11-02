@extends('layouts.private')

@section('content')
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #101011ff, #131111ff); min-height: 100vh;">
    <div class="row page-titles mx-0 mb-4">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4 class="text-primary fw-bold">Pedidos</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Lista</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-center bg-secondary rounded-top-4">
                    <h4 class="card-title mb-0 fw-semibold text-white"><i class="fa fa-clipboard-list me-2"></i>Lista de Pedidos</h4>

                    <div class="d-flex align-items-center gap-2">
                        <input type="text" id="buscarPedido" class="form-control" placeholder="Buscar pedido..." style="width: 200px;">
                        <a href="{{ route('pedidos.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Agregar
                        </a>
                    </div>
                </div>

                <div class="card-body p-5" style="background-color: #b3b3b3; border-radius: 0 0 1rem 1rem;">
                    <div class="table-responsive">
                        <table id="tablaPedidos" class="table table align-middle mb-0" style="min-width: 845px; border-radius: 12px; overflow: hidden;">
                            <thead class="bg-black text-white">
                                <tr>
                                    <th>ID</th>
                                    <th>Tipo</th>
                                    <th>Cliente</th>
                                    <th>Mesa</th>
                                    <th>Estado</th>
                                    <th>Método Pago</th>
                                    <th>Fecha</th>
                                    <th>Detalle</th>
                                    <th>Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pedidos as $pedido)
                                <tr class="pedido-row text-black">
                                    <td>{{ $pedido->id }}</td>
                                    <td>
                                        @if(strtolower($pedido->tipo) == 'mesa')
                                            <span class="badge badge-info">En Mesa</span>
                                        @elseif(strtolower($pedido->tipo) == 'llevar')
                                            <span class="badge badge-warning">Para llevar</span>
                                        @else
                                            <span class="badge badge-secondary">{{ $pedido->tipo }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $pedido->nombre ?? 'N/A' }}</td>
                                    <td>{{ $pedido->mesa->numero ?? 'N/A' }}</td>
                                    <td>
                                        @if($pedido->estado == 'pendiente')
                                            <span class="badge badge-warning">Pendiente</span>
                                        @elseif($pedido->estado == 'en_proceso')
                                            <span class="badge badge-info">En Proceso</span>
                                        @elseif($pedido->estado == 'finalizado')
                                            <span class="badge badge-success">Finalizado</span>
                                        @else
                                            <span class="badge badge-secondary">{{ ucfirst($pedido->estado) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($pedido->metodo_pago == 'efectivo')
                                            <span class="badge badge-success">Efectivo</span>
                                        @elseif($pedido->metodo_pago == 'transferencia')
                                            <span class="badge badge-info">Transferencia</span>
                                        @else
                                            <span class="badge badge-secondary">{{ ucfirst($pedido->metodo_pago) }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <ul class="list-unstyled mb-0">
                                            @foreach ($pedido->detallePedidos as $detalle)
                                                <li>
                                                    {{ $detalle->cantidad }} × {{ $detalle->plato->nombre ?? 'Plato no encontrado' }}
                                                    (Bs. {{ number_format($detalle->precio_unitario, 2) }})
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        Bs. {{
                                            number_format(
                                                $pedido->detallePedidos->sum(function($detalle) {
                                                    return $detalle->cantidad * $detalle->precio_unitario;
                                                }), 2)
                                        }}
                                    </td>
                                    <td class="d-flex flex-column gap-1">
                                        <a href="{{ route('pedidos.edit', $pedido->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i> Editar
                                        </a>
                                        <a href="javascript:;" class="btn btn-sm btn-danger btn-delete"
                                           data-id="{{ $pedido->id }}"
                                           data-name="Pedido #{{ $pedido->id }}"
                                           data-url="{{ route('pedidos.destroy', $pedido->id) }}">
                                           <i class="fa fa-trash"></i> Eliminar
                                        </a>
                                        <button class="btn btn-sm btn-success" onclick="imprimirPedido({{ $pedido->id }})">
                                            <i class="fa fa-print"></i> Imprimir
                                        </button>

                                        {{-- 🧾 Contenido oculto para impresión --}}
                                        <div id="ticket-{{ $pedido->id }}" style="display:none;">
                                            <div style="font-family: 'Courier New', monospace; width: 250px; padding:10px;">
                                                <h4 style="text-align:center; margin-bottom:0;">🍽️ Doña Ternera</h4>
                                                <p style="text-align:center; margin:0;">Calle Principal #123</p>
                                                <hr>
                                                <p><strong>Pedido #:</strong> {{ $pedido->id }}</p>
                                                <p><strong>Fecha:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                                                <p><strong>Cliente:</strong> {{ $pedido->nombre ?? 'N/A' }}</p>
                                                <p><strong>Método:</strong> {{ ucfirst($pedido->metodo_pago) }}</p>
                                                @if($pedido->mesa)
                                                    <p><strong>Mesa:</strong> {{ $pedido->mesa->numero }}</p>
                                                @endif
                                                <hr>
                                                <table style="width:100%; font-size:13px;">
                                                    @foreach ($pedido->detallePedidos as $detalle)
                                                    <tr>
                                                        <td>{{ $detalle->cantidad }}x</td>
                                                        <td>{{ $detalle->plato->nombre ?? 'Plato' }}</td>
                                                        <td style="text-align:right;">{{ number_format($detalle->cantidad * $detalle->precio_unitario, 2) }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                                <hr>
                                                @php
                                                    $total = $pedido->detallePedidos->sum(function($d){ return $d->cantidad * $d->precio_unitario; });
                                                @endphp
                                                <p style="text-align:right; font-weight:bold;">TOTAL: Bs. {{ number_format($total, 2) }}</p>
                                                <hr>
                                                <p style="text-align:center;">¡Gracias por su preferencia!</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- 🎨 Estilos personalizados --}}
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
    }
    .pedido-row {
        background-color: #f6f8f3ff;
        border: 2px solid #dcdcdc;
        border-radius: 12px;
        box-shadow: 0 3px 8px rgba(241, 239, 239, 0.08);
        transition: all 0.2s ease-in-out;
    }
    .pedido-row:hover { background-color: #f7f9fc; transform: scale(1.01); }
    .btn-primary { background-color: #2563eb; border-color: #2563eb; }
    .btn-warning { background-color: #f59e0b; border-color: #f59e0b; color:#fff; }
    .btn-danger { background-color: #dc2626; border-color: #dc2626; }
    .btn-success { background-color: #16a34a; border-color: #16a34a; color:#fff; }
</style>

{{-- 🔍 Buscador + 🖨️ Impresor --}}
<script>
    document.getElementById('buscarPedido').addEventListener('keyup', function () {
        let filtro = this.value.toLowerCase();
        let filas = document.querySelectorAll('#tablaPedidos tbody tr');
        filas.forEach(fila => {
            let textoFila = fila.textContent.toLowerCase();
            fila.style.display = textoFila.includes(filtro) ? '' : 'none';
        });
    });

    function imprimirPedido(id) {
        let contenido = document.getElementById('ticket-' + id).innerHTML;
        let ventana = window.open('', '', 'width=400,height=600');
        ventana.document.write('<html><head><title>Imprimir Pedido</title></head><body>');
        ventana.document.write(contenido);
        ventana.document.write('<script>window.onload=function(){window.print();setTimeout(()=>window.close(),1000);}<\/script>');
        ventana.document.write('</body></html>');
        ventana.document.close();
    }
</script>
@endsection
