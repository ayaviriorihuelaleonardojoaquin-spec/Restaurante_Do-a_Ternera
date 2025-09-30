@extends('layouts.private')

@section('content')
<div class="container">
    <h2 class="mb-4">Facturas Emitidas</h2>

    {{-- Ejemplo de tabla de facturas, en el futuro la llenaremos desde BD --}}
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>ID Pedido</th>
                <th>Cliente</th>
                <th>Monto</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            {{-- Ejemplo quemado --}}
            <tr>
                <td>1</td>
                <td>15</td>
                <td>Juan Pérez</td>
                <td>120.50</td>
                <td>2025-09-14</td>
                <td><a href="#" class="btn btn-primary btn-sm">🔍 Ver</a></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
