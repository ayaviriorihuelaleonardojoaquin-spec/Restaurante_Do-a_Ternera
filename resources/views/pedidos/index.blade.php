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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Lista</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Lista</h4>

                        <a href="{{ route('pedidos.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Agregar
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display datatable" style="min-width: 845px">
                                <thead>
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
                                        <tr>
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
                                                            {{ $detalle->cantidad }} x {{ $detalle->plato->nombre ?? 'Plato no encontrado' }}
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

                                            <td>
                                                <a href="javascript:;" class="btn btn-danger btn-delete"
                                                    data-id="{{ $pedido->id }}"
                                                    data-name="Pedido #{{ $pedido->id }}"
                                                    data-url="{{ route('pedidos.destroy', $pedido->id) }}">
                                                    <i class="fa fa-trash"></i> Eliminar
                                                </a>
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
@endsection
