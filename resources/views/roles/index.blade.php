@extends('layouts.private')

@section('content')
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #101011ff, #131111ff); min-height: 100vh;">
    <div class="row page-titles mx-0 mb-4">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4 class="text-primary fw-bold">Roles</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Lista</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-center bg-secondary rounded-top-4">
                    <h4 class="card-title mb-0 fw-semibold text-white">
                        <i class="fa fa-user-shield me-2"></i> Lista de Roles
                    </h4>

                    <div class="d-flex align-items-center gap-2">
                        <input type="text" id="buscarRol" class="form-control" placeholder="Buscar" style="width: 200px;">
                        <a href="{{ route('roles.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Agregar
                        </a>
                    </div>
                </div>

                <div class="card-body bg-secondary">
                    <div class="table-responsive">
                        <table id="tablaRoles" class="table align-middle mb-0" style="min-width: 845px; border-radius: 12px; overflow: hidden;">
                            <thead class="bg-black text-white">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $rol)
                                <tr class="user-row text-black">
                                    <td>{{ $rol->id }}</td>
                                    <td>{{ $rol->nombre }}</td>
                                    <td>{{ $rol->descripcion }}</td>
                                    <td>
                                        <a href="{{ route('roles.edit', $rol) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-pencil"></i> Editar
                                        </a>
                                        <a href="javascript:;" class="btn btn-sm btn-danger btn-delete"
                                            data-id="{{ $rol->id }}"
                                            data-name="{{ $rol->nombre }}"
                                            data-url="{{ route('roles.destroy', $rol->id) }}">
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

{{-- 🎨 Estilos personalizados --}}
<style>
    .table thead th {
        background-color: #1f2937 !important;
        color: white !important;
        font-weight: 600;
    }
    thead tr th {
        border-right: 1px solid white !important; /* Línea blanca vertical */
        border-bottom: 2px solid white !important; /* Línea inferior */
        color: #ffffff !important; /* Letras blancas */
        background-color: #000000 !important; /* Fondo negro */
        
    }
    /* Diseño general de las filas */
    .user-row {
        background-color: #f6f8f3ff;
        border: 2px solid #dcdcdc;
        border-radius: 12px;
        box-shadow: 0 3px 8px rgba(241, 239, 239, 0.08);
        transition: all 0.2s ease-in-out;
    }

    .user-row:hover {
        background-color: #f7f9fc;
        border-color: #b3b3b3;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.12);
        transform: scale(1.01);
    }

    .table thead th {
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-primary {
        background-color: #2563eb;
        border-color: #2563eb;
    }

    .btn-primary:hover {
        background-color: #1d4ed8;
        border-color: #1d4ed8;
    }

    .btn-danger {
        background-color: #dc2626;
        border-color: #dc2626;
    }

    .btn-danger:hover {
        background-color: #b91c1c;
        border-color: #b91c1c;
    }
</style>

{{-- 🔎 Buscador en tiempo real --}}
<script>
    document.getElementById('buscarRol').addEventListener('keyup', function () {
        let filtro = this.value.toLowerCase();
        let filas = document.querySelectorAll('#tablaRoles tbody tr');

        filas.forEach(fila => {
            let textoFila = fila.textContent.toLowerCase();
            fila.style.display = textoFila.includes(filtro) ? '' : 'none';
        });
    });
</script>
@endsection
