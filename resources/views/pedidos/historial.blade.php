@extends('layouts.private')

@section('content')
    <div class="container">
        <h2 class="mb-4">Historial de Pedidos</h2>

        @if ($pedidos->isEmpty())
            <p>No hay pedidos en el historial.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Mesa</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedidos as $pedido)
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            <td>{{ $pedido->mesa_id ?? 'Para llevar' }}</td>
                            <td>{{ $pedido->tipo }}</td>
                            <td>{{ $pedido->estado }}</td>
                            <td>{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
