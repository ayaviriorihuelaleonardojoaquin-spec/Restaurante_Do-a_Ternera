@extends('layouts.private')

@section('content')
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #101011ff, #131111ff); min-height: 100vh;">
    <!-- 🧭 Encabezado -->
    <div class="row page-titles mx-0 mb-4">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4 class="text-primary fw-bold">Mesas</h4>
                <p class="mb-0 text-light">Lista de mesas del restaurante</p>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                <li class="breadcrumb-item active text-light">Lista</li>
            </ol>
        </div>
    </div>

    <!-- 📋 Lista de Mesas -->
    <div class="row justify-content-center mt-3">
        <div class="col-xl-10 col-lg-11">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-secondary text-white rounded-top-4 d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0 fw-semibold text-white">
                        <i class="fa fa-chair me-2"></i> Lista de Mesas
                    </h4>
                    <div class="d-flex align-items-center gap-2">
                        <input type="text" id="buscarMesa" class="form-control" placeholder="Buscar mesa..." style="width: 220px;">
                        <a href="{{ route('mesas.create') }}" class="btn btn-primary btn-lg rounded-3 px-4">
                            <i class="fa fa-plus"></i> Agregar
                        </a>
                    </div>
                </div>

                <div class="card-body p-5" style="background-color: #b3b3b3; border-radius: 0 0 1rem 1rem;">
                    <div class="table-responsive bg-white">
                        <table id="tablaMesas" class="table table-bordered align-middle text-center text-white shadow-sm" style="min-width: 845px; border-radius: 12px; overflow: hidden;">
                            <thead class="table-dark text-white">
                                <tr>
                                    <th>Número</th>
                                    <th>Capacidad</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mesas as $mesa)
                                    <tr>
                                        <td class="fw-semibold text-dark">{{ $mesa->numero }}</td>
                                        <td class="fw-semibold text-dark">{{ $mesa->capacidad }} personas</td>
                                        <td>
                                            @if($mesa->estado == 'libre')
                                                <span class="badge bg-success px-3 py-2 fs-6">Libre</span>
                                            @elseif($mesa->estado == 'ocupada')
                                                <span class="badge bg-warning text-white px-3 py-2 fs-6">Ocupada</span>
                                            @else
                                                <span class="badge bg-info px-3 py-2 fs-6">Reservada</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('mesas.edit', $mesa) }}" class="btn btn-primary btn-sm rounded-3 px-3 me-2" title="Editar mesa">
                                                <i class="fa fa-pencil"></i> Editar
                                            </a>
                                            <a href="javascript:;" 
                                               class="btn btn-danger btn-sm rounded-3 px-3 btn-delete"
                                               data-id="{{ $mesa->id }}"
                                               data-name="Mesa {{ $mesa->numero }}"
                                               data-url="{{ route('mesas.destroy', $mesa->id) }}">
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

<!-- 🔍 Buscador en tiempo real -->
<script>
    document.getElementById('buscarMesa').addEventListener('keyup', function () {
        let filtro = this.value.toLowerCase();
        let filas = document.querySelectorAll('#tablaMesas tbody tr');

        filas.forEach(fila => {
            let textoFila = fila.textContent.toLowerCase();
            fila.style.display = textoFila.includes(filtro) ? '' : 'none';
        });
    });
</script>

{{-- 🎨 Estilos personalizados --}}
<style>
    .table tbody tr {
        background-color: #f6f8f3ff;
        border: 2px solid #dcdcdc;
        border-radius: 12px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
        transition: all 0.25s ease-in-out;
    }
    /* 🌟 Efecto hover de fila completa */
    .table tbody tr:hover {
        background-color: #d9dcdfff;
        border-color: #b3b3b3;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.12);
        transform: scale(1.01);
        cursor: pointer;
    }
    
    .btn-primary {
        background-color: #2563eb;
        border-color: #2563eb;
        
    }

    .btn-primary:hover {
        background-color: #3152acff;
        border-color: #3152acff;
    }

    .btn-danger {
        background-color: #dd1212ff;
        border-color: #dd1212ff;
    }

    .btn-danger:hover {
        background-color: #c52e2eff;
        border-color: #c52e2eff;
    }

    .table th, .table td {
        vertical-align: middle !important;
    }

    .card {
        border-radius: 1rem !important;
    }

    .table thead th {
        background-color: #1f2937 !important;
        color: white !important;
        font-weight: 600;
    }

    .breadcrumb-item a {
        color: #9ca3af;
        text-decoration: none;
    }

    .breadcrumb-item.active {
        color: #ffffff;
    }

    .badge {
        font-size: 0.95rem;
    }
</style>
@endsection
