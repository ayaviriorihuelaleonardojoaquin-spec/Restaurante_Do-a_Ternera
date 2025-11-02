@extends('layouts.private')

@section('content')
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #101011ff, #131111ff); min-height: 100vh; padding-top: 20px;">
    <!-- Encabezado -->
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4 class="text-primary fw-bold">🛠️ Editar Rol</h4>
                <span class="text-muted">Modifica los datos del rol seleccionado</span>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                <li class="breadcrumb-item active">Editar</li>
            </ol>
        </div>
    </div>

    <!-- Contenedor del formulario -->
    <div class="row justify-content-center mt-3">
        <div class="col-xl-8 col-lg-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-secondary text-white rounded-top-4">
                    <h4 class="card-title mb-0 fw-semibold text-white">
                        <i class="fa fa-edit me-2"></i> Editar Rol
                    </h4>
                </div>

                <div class="card-body p-5" style="background-color: #b3b3b3; border-radius: 0 0 1rem 1rem;">
                    <form method="POST" action="{{ route('roles.update', $rol->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row g-4">
                            <!-- Nombre del Rol -->
                            <div class="form-group col-md-6">
                                <label for="nombre" class="form-label fw-semibold text-black">Nombre del Rol</label>
                                <input type="text" name="nombre" id="nombre" 
                                    class="form-control shadow-sm border rounded-3 p-3"
                                    placeholder="Ej. Administrador"
                                    value="{{ old('nombre', $rol->nombre) }}" required>
                            </div>

                            <!-- Descripción -->
                            <div class="form-group col-md-6">
                                <label for="descripcion" class="form-label fw-semibold text-black">Descripción</label>
                                <input type="text" name="descripcion" id="descripcion"
                                    class="form-control shadow-sm border rounded-3 p-3"
                                    placeholder="Ej. Puede gestionar usuarios y roles"
                                    value="{{ old('descripcion', $rol->descripcion) }}" required>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="d-flex justify-content-center align-items-between mt-4">
                            <button type="button" class="btn btn-secondary btn-lg rounded-3 px-4 bg-red"
                                onclick="javascript:history.back()">
                                <i class="fa fa-arrow-left"></i> Cancelar
                            </button>

                            <button type="submit" class="btn btn-primary btn-lg rounded-3 px-4"
                                style="background: linear-gradient(135deg, #4e73df, #3751c7); border: none;">
                                <i class="fa fa-save"></i> Actualizar Rol
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
