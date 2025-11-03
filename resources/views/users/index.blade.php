@extends('layouts.private')

@section('content')
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #101011ff, #131111ff); min-height: 100vh;">
    <div class="row page-titles mx-0 mb-4">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4 class="text-primary fw-bold">Usuarios</h4>
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
                    <h4 class="card-title mb-0 fw-semibold text-white"><i class="fa fa-users-cog me-2"></i>Lista de Usuarios</h4>
                    
                    <div class="d-flex align-items-center gap-2">
                        <input type="text" id="buscarUsuario" class="form-control" placeholder="Buscar" style="width: 200px;">
                        <a href="{{ route('users.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Agregar
                        </a>
                    </div>
                </div>

                <div class="card-body bg-secondary">
                    <div class="table-responsive">
                        <table id="tablaUsuarios" class="table table align-middle mb-0" style="min-width: 845px; border-radius: 12px; overflow: hidden;">
                            <thead class="bg-black text-white">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Correo electronico</th>
                                    <th>Rol</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr class="user-row text-black">
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->rol->nombre ?? 'Usuario' }}</td>
                                    <td>
                                        <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-pencil"></i> Editar
                                        </a>
                                        <a href="javascript:;" class="btn btn-sm btn-danger btn-delete"
                                            data-id="{{ $user->id }}"
                                            data-name="{{ $user->name }} {{ $user->last_name }}"
                                            data-url="{{ route('users.destroy', $user->id) }}">
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

{{-- Estilos personalizados --}}
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
    /* Cuadros de usuarios */
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

{{-- Buscador en tiempo real --}}
<script>
    document.getElementById('buscarUsuario').addEventListener('keyup', function () {
        let filtro = this.value.toLowerCase();
        let filas = document.querySelectorAll('#tablaUsuarios tbody tr');

        filas.forEach(fila => {
            let textoFila = fila.textContent.toLowerCase();
            fila.style.display = textoFila.includes(filtro) ? '' : 'none';
        });
    });
</script>
@endsection
