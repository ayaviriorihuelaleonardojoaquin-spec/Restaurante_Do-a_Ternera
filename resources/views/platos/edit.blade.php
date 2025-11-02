@extends('layouts.private')

@section('content')
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #101011ff, #131111ff); min-height: 100vh;">
    <div class="row page-titles mx-0 mb-4">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4 class="text-primary fw-bold">Editar Plato</h4>
                <p class="mb-0">Modifica la información del plato seleccionado</p>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('platos.index') }}">Platos</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Editar</a></li>
            </ol>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-secondary rounded-top-4 text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 text-white"><i class="fa fa-pen me-2"></i> Actualizar Datos del Plato</h4>
                    
                </div>

                <div class="card-body p-5" style="background-color: #b3b3b3; border-radius: 0 0 1rem 1rem;">
                    <form action="{{ route('platos.update', $plato->id) }}" method="POST" enctype="multipart/form-data" class="row g-4">
                        @csrf
                        @method('PUT')

                        {{-- Nombre --}}
                        <div class="form-group col-md-6">
                            <label for="nombre" class="form-label fw-semibold text-black">Nombre del Plato</label>
                            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $plato->nombre) }}" class="form-control" required>
                        </div>

                        {{-- Precio --}}
                        <div class="form-group col-md-6">
                            <label for="precio" class="form-label fw-semibold text-black">Precio (Bs.)</label>
                            <input type="number" step="0.01" name="precio" id="precio" value="{{ old('precio', $plato->precio) }}" class="form-control" required>
                        </div>

                        {{-- Descripción --}}
                        <div class="form-group col-md-6">
                            <label for="descripcion" class="form-label fw-semibold text-black">Descripción</label>
                            <textarea name="descripcion" id="descripcion" rows="3" class="form-control" required>{{ old('descripcion', $plato->descripcion) }}</textarea>
                        </div>

                        {{-- Disponible --}}
                        <div class="form-group col-md-6">
                            <label for="disponible" class="form-label fw-semibold text-black">Disponibilidad</label>
                            <select name="disponible" id="disponible" class="form-control" required>
                                <option value="1" {{ $plato->disponible ? 'selected' : '' }}>Sí</option>
                                <option value="0" {{ !$plato->disponible ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        {{-- Imagen --}}
                        <div class="form-group col-md-6">
                            <label for="imagen" class="form-label fw-semibold text-black">Imagen del Plato</label>
                            <input type="file" name="imagen" id="imagen" class="form-control shadow-sm border rounded-3 p-3">
                            @if($plato->imagen)
                                <div class="mt-2 text-center">
                                    <img src="{{ asset('storage/' . $plato->imagen) }}" alt="Imagen actual" class="img-thumbnail rounded shadow-sm" width="150">
                                    <p class="text-white small mt-1">Imagen actual</p>
                                </div>
                            @endif
                        </div>

                        {{-- Botones --}}
                        <div class="col-12 d-flex justify-content-center gap-3 mt-3">
                            <a href="{{ route('platos.index') }}" class="btn btn-danger px-4">
                                <i class="fa fa-arrow-left"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-success px-4">
                                <i class=""></i> Actualizar Cambios
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
        background-color: #fff;
    }

    .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 6px rgba(37, 99, 235, 0.3);
    }

    .card {
        background: #f8fafc;
    }

    .btn-success {
        background-color: #3926e7ff;
        border-color: #3926e7ff;
    }

    .btn-success:hover {
        background-color: #312792ff;
        border-color: #312792ff;
    }

    .btn-danger {
        background-color: #dc2626;
        border-color: #dc2626;
    }

    .btn-danger:hover {
        background-color: #b91c1c;
        border-color: #b91c1c;
    }

    .card-header {
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
</style>
@endsection
