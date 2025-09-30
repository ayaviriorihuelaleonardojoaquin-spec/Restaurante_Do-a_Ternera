@extends('layouts.private')

@section('content')
<div class="container">
    <h2 class="mb-4">Historial de Cobros</h2>

    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Monto</th>
                <th>Método de Pago</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            {{-- Datos de ejemplo --}}
            <tr>
                <td>1</td>
                <td>María López</td>
                <td>85.00</td>
                <td>Efectivo</td>
                <td>2025-09-14 19:20</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Carlos Ramírez</td>
                <td>150.00</td>
                <td>Tarjeta</td>
                <td>2025-09-14 18:50</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
