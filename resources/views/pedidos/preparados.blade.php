@extends('layouts.private')

@section('content')
    <h3>Pedidos Preparados</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Platos</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{ $pedido->cliente->name ?? 'N/A' }}</td>
                    <td>
                        @foreach($pedido->platos as $plato)
                            {{ $plato->nombre }} <br>
                        @endforeach
                    </td>
                    <td><span class="badge bg-success">{{ ucfirst($pedido->estado) }}</span></td>
                </tr>
            @empty
                <tr><td colspan="4">No hay pedidos preparados 🚫</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
