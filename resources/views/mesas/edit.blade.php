@extends('layouts.private')

@section('content')
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #101011ff, #131111ff); min-height: 100vh;">
    <!-- 🧭 Encabezado -->
    <div class="row page-titles mx-0 mb-4">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4 class="text-primary fw-bold">Editar Mesa</h4>
                <p class="mb-0 text-light">Modifica la información de una mesa existente</p>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('mesas.index') }}">Mesas</a></li>
                <li class="breadcrumb-item active text-light">Editar</li>
            </ol>
        </div>
    </div>

    <!-- 📝 Formulario de edición -->
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-8 col-md-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-secondary text-white rounded-top-4">
                    <h4 class="card-title mb-0 fw-semibold text-white">
                        <i class="fa fa-edit me-2"></i> Editar Mesa
                    </h4>
                </div>

                <div class="card-body bg-light p-5" style="border-radius: 0 0 1rem 1rem;">
                    <form action="{{ route('mesas.update', $mesa->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Número de mesa -->
                        <div class="mb-4">
                            <label for="numero" class="form-label fw-semibold text-dark">Número o nombre de mesa:</label>
                            <input type="text" name="numero" id="numero"
                                   class="form-control form-control-lg rounded-3 shadow-sm"
                                   placeholder="Ej: Mesa Principal, A1, VIP, etc."
                                   value="{{ old('numero', $mesa->numero) }}" required>
                        </div>

                        <!-- Capacidad -->
                        <div class="mb-4">
                            <label for="capacidad" class="form-label fw-semibold text-dark">Capacidad de personas:</label>
                            <input type="number" name="capacidad" id="capacidad"
                                   class="form-control form-control-lg rounded-3 shadow-sm"
                                   placeholder="Ej: 4" min="1"
                                   value="{{ old('capacidad', $mesa->capacidad) }}" required>
                        </div>

                        <!-- Estado -->
                        <div class="mb-4">
                            <label for="estado" class="form-label fw-semibold text-dark">Estado actual:</label>
                            <select name="estado" id="estado"
                                    class="form-select form-select-lg rounded-3 shadow-sm bg-white" required>
                                <option value="libre" {{ old('estado', $mesa->estado) == 'libre' ? 'selected' : '' }}>Libre</option>
                                <option value="ocupada" {{ old('estado', $mesa->estado) == 'ocupada' ? 'selected' : '' }}>Ocupada</option>
                                <option value="reservada" {{ old('estado', $mesa->estado) == 'reservada' ? 'selected' : '' }}>Reservada</option>
                            </select>
                        </div>

                        <!-- Botones -->
                        <div class="d-flex justify-content-center mt-5">
                            <a href="{{ route('mesas.index') }}" class="btn btn-secondary btn-lg rounded-3 px-4 bg-red">
                                <i class="fa fa-arrow-left"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg rounded-3 px-4">
                                <i class="fa fa-save"></i> Actualizar Mesa
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
    .btn-primary {
        background-color: #2563eb;
        border-color: #2563eb;
        transition: all 0.2s ease;
    }

    .btn-primary:hover {
        background-color: #3152acff;
        border-color: #3152acff;
    }

    .btn-secondary {
        background-color: #6b7280;
        border-color: #6b7280;
    }

    .btn-secondary:hover {
        background-color: #4b5563;
        border-color: #4b5563;
    }

    .card {
        border-radius: 1rem !important;
    }

    .form-label {
        font-size: 1.1rem;
    }

    input::placeholder {
        color: #9ca3af;
    }
</style>
@endsection
