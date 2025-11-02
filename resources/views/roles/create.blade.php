@extends('layouts.private')

@section('content')
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #101011ff, #131111ff); min-height: 100vh;">
    <div class="row page-titles mx-0 mb-4">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4 class="text-primary fw-bold">Roles</h4>
                <p class="mb-0">Agregar un nuevo rol al sistema</p>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Nuevo</a></li>
            </ol>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-header bg-secondary text-white rounded-top-4">
                    <h4 class="card-title mb-0 fw-semibold text-white">
                        <i class="fa fa-users-cog me-2"></i>Registrar nuevo rol
                    </h4>
                </div>
            
                <div class="card-body p-5" style="background-color: #b3b3b3; border-radius: 0 0 1rem 1rem;">
                    
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label fw-bold text-black">Nombre del Rol</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" 
                                placeholder="Ejemplo: Administrador, Mesero, Cajero..." 
                                value="{{ old('nombre') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label fw-bold text-black">Descripción</label>
                            <textarea name="descripcion" id="descripcion" rows="3" class="form-control"
                                placeholder="Breve descripción del rol" required>{{ old('descripcion') }}</textarea>
                        </div>

                        <div class="d-flex justify-content-center mt-4 ">
                            <a href="{{ route('roles.index') }}" class="btn btn-secondary bg-red">
                                <i class="fa fa-arrow-left me-1"></i> Volver
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-save me-1"></i> Guardar Rol
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- 🎨 Estilos personalizados --}}
<style>
    .form-control {
        border-radius: 10px;
        border: 2px solid #cbd5e1;
        transition: all 0.2s ease;
    }

    .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 6px rgba(37, 99, 235, 0.3);
    }

    .btn-success {
        background-color: #16a34a;
        border-color: #16a34a;
        font-weight: 500;
    }

    .btn-success:hover {
        background-color: #15803d;
        border-color: #15803d;
    }

    .btn-secondary {
        background-color: #6b7280;
        border-color: #6b7280;
    }

    .btn-secondary:hover {
        background-color: #4b5563;
        border-color: #4b5563;
    }
</style>
@endsection
