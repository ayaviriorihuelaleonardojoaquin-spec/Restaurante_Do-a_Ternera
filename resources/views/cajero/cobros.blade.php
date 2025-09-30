@extends('layouts.private')

@section('content')
<div class="container">
    <h2 class="mb-4">Cobros Pendientes</h2>

    @if ($pedidos->isEmpty())
        <div class="alert alert-info">No hay pedidos listos para cobrar.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID Pedido</th>
                    <th>Mesa</th>
                    <th>Tipo</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->id }}</td>
                        <td>{{ $pedido->mesa_id ?? 'Para llevar' }}</td>
                        <td>{{ ucfirst($pedido->tipo) }}</td>
                        <td>{{ number_format($pedido->total, 2) }}</td>
                        <td>
                            {{-- Botón Cobrar (puedes implementar la lógica luego) --}}
                            <a href="#" class="btn btn-success btn-sm">💰 Cobrar</a>

                            {{-- Botón Generar Factura --}}
                            @if(!$pedido->factura) {{-- Solo mostrar si no tiene factura --}}
                                <form action="{{ route('cajero.facturas.store', $pedido->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-info btn-sm">🧾 Generar Factura</button>
                                </form>
                            @else
                                <span class="badge bg-success">Factura Generada</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
