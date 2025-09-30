@extends('layouts.private')

@section('page-title', 'Ventas')

@php
    // Definir los breadcrumbs como un array
    $breadcrumbs = [
        ['name' => 'Dashboard', 'url' => route('dashboard')],
        ['name' => 'Ventas', 'url' => route('transacciones.salidas.index')],
    ];
@endphp

@section('contenido')
@if (session('success'))
<div class="alert alert-success d-flex align-items-center" role="alert">
    <svg class="flex-shrink-0 me-2 svg-success" xmlns="http://www.w3.org/2000/svg" height="1.5rem" viewBox="0 0 24 24"
        width="1.5rem" fill="#000000">
        <path d="M0 0h24v24H0V0zm0 0h24v24H0V0z" fill="none"></path>
        <path
            d="M16.59 7.58L10 14.17l-3.59-3.58L5 12l5 5 8-8zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z">
        </path>
    </svg>
    <div>
        {{ session('success') }}
    </div>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger d-flex align-items-center" role="alert">
    <svg class="flex-shrink-0 me-2 svg-danger" xmlns="http://www.w3.org/2000/svg" height="1.5rem" viewBox="0 0 24 24"
        width="1.5rem" fill="#000000">
        <path d="M0 0h24v24H0V0zm0 0h24v24H0V0z" fill="none"></path>
        <path
            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zM11 7h2v6h-2zm0 8h2v2h-2z">
        </path>
    </svg>
    <div>
        {{ session('error') }}
    </div>
</div>
@endif
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title">
                    Lista de salidas
                </div>
                <div>
                    <div class="breadcrumb mb-0">
                        <a aria-label="anchor" href="{{ route('transacciones.salidas.create') }}" class="btn btn-primary ms-auto"><i class="ti ti-circle-plus me-2"></i>Agregar</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable-basic" class="table table-bordered text-nowrap w-100 table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tipo</th>
                                <th>Responsable</th>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Eliminado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salidas as $salida)
                                <tr>
                                    <td>{{ $salida->id }}</td>
                                    <td>{{ $salida->tipo }}</td>
                                    <td>{{ $salida->usuario->name }}</td>
                                    <td>{{ $salida->fecha }}</td>
                                    <td>{{ $salida->total }}</td>
                                    <td>{{ $salida->estado }}</td>
                                    <td>{{ $salida->eliminado ? 'Sí' : 'No' }}</td>
                                    <td>
                                        <div class="hstack gap-2 fs-15">
                                            <a href="{{ route('transacciones.salidas.edit', $salida->id) }}" class="btn btn-icon btn-sm btn-info"><i class="ri-edit-line"></i></a>
                                            <form action="{{ route('transacciones.salidas.destroy', $salida->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-icon btn-sm btn-danger"><i class="ri-delete-bin-line"></i></button>
                                            </form>
                                            <a href="{{ route('transacciones.salidas.pdf', $salida->id) }}" class="btn btn-icon btn-sm btn-primary" target="_blank">
                                                <i class="ri-printer-line"></i>
                                            </a>
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

@endsection
