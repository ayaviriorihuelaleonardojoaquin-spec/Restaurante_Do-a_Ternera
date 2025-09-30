@extends('layouts.private')

@section('content')
<div class="container">
    <h2 class="mb-4">Cierre de Caja</h2>

    <div class="card p-4 shadow-sm">
        <h4>Resumen del Día</h4>
        <ul>
            <li>Total de ventas: <strong>Bs. 2,450.00</strong></li>
            <li>Total de facturas emitidas: <strong>25</strong></li>
            <li>Efectivo en caja: <strong>Bs. 2,450.00</strong></li>
        </ul>

        <form action="#" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger mt-3">🔒 Cerrar Caja</button>
        </form>
    </div>
</div>
@endsection
