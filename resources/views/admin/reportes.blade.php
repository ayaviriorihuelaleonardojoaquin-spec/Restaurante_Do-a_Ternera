@extends('layouts.private')

@section('content')
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #101011ff, #131111ff); min-height: 100vh;">
    <h2 class="mb-4 text-white">Reportes</h2>

    <div class="row mb-3 mb-4 text-white">
        <div class="col-md-3">
            <label>Fecha Inicio</label>
            <input type="date" class="form-control">
        </div>
        <div class="col-md-3 mb-4 text-white">
            <label>Fecha Fin</label>
            <input type="date" class="form-control">
        </div>
        <div class="col-md-3 mb-4 align-self-end">
            <button class="btn btn-primary">📊 Generar Reporte</button>
        </div>
    </div>

    <table class="table table-bordered table-striped bg-white">
        <thead class="table-dark">
            <tr>
                <th>ID Pedido</th>
                <th>Mesa</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            {{-- Datos de ejemplo --}}
            <tr>
                <td>1</td>
                <td>5</td>
                <td>Bs. 250.00</td>
                <td>Pagado</td>
                <td>2025-09-14</td>
            </tr>
            <tr>
                <td>2</td>
                <td>2</td>
                <td>Bs. 120.50</td>
                <td>Pagado</td>
                <td>2025-09-13</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
