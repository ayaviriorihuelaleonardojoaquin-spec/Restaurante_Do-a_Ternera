@extends('layouts.private')

@section('content')
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #101011ff, #131111ff); min-height: 100vh;">
    <!-- 🧭 Encabezado -->
    <div class="row page-titles mx-0 mb-4">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4 class="text-primary fw-bold">🍽️ Nuevo Plato</h4>
                <p class="mb-0">Agrega un nuevo plato al menú del restaurante</p>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('platos.index') }}">Platos</a></li>
                <li class="breadcrumb-item active">Nuevo</li>
            </ol>
        </div>
    </div>

    <!-- 🧾 Formulario -->
    <div class="row justify-content-center mt-3">
        <div class="col-xl-8 col-lg-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-secondary text-white rounded-top-4">
                    <h4 class="card-title mb-0 fw-semibold text-white">
                        <i class="fa fa-utensils me-2"></i> Registrar nuevo plato
                    </h4>
                </div>

                <div class="card-body p-5" style="background-color: #b3b3b3; border-radius: 0 0 1rem 1rem;">
                    <form method="POST" action="{{ route('platos.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <!-- Nombre -->
                            <div class="form-group col-md-6">
                                <label for="nombre" class="form-label fw-semibold text-black">Nombre del plato</label>
                                <input type="text" name="nombre" id="nombre" class="form-control shadow-sm border rounded-3 p-3"
                                    placeholder="Ej. Milanesa con papas" value="{{ old('nombre') }}" required>
                            </div>

                            <!-- Precio -->
                            <div class="form-group col-md-6">
                                <label for="precio" class="form-label fw-semibold text-black">Precio (Bs.)</label>
                                <input type="number" step="0.01" name="precio" id="precio" class="form-control shadow-sm border rounded-3 p-3"
                                    placeholder="Ej. 25.00" value="{{ old('precio') }}" required>
                            </div>

                            <!-- Descripción -->
                            <div class="form-group col-md-12">
                                <label for="descripcion" class="form-label fw-semibold text-black">Descripción</label>
                                <textarea name="descripcion" id="descripcion" rows="3" class="form-control shadow-sm border rounded-3 p-3"
                                    placeholder="Describe brevemente el plato..." required>{{ old('descripcion') }}</textarea>
                            </div>

                            <!-- Disponible -->
                            <div class="form-group col-md-6">
                                <label for="disponible" class="form-label fw-semibold text-black">Disponible</label>
                                <select name="disponible" id="disponible" class="form-control shadow-sm border rounded-3 p-0" required>
                                    <option value="" disabled selected>Seleccione una opción</option>
                                    <option value="1" {{ old('disponible') == '1' ? 'selected' : '' }}>Sí</option>
                                    <option value="0" {{ old('disponible') == '0' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>

                            <!-- Imagen -->
                            <div class="form-group col-md-6">
                                <label for="imagen" class="form-label fw-semibold text-black">Imagen del plato</label>
                                <input type="file" name="imagen" id="imagen" class="form-control shadow-sm border rounded-3 p-3">
                                <small class="text-dark">Formatos permitidos: JPG, PNG, JPEG.</small>
                            </div>
                        </div>

                        <!--  Botones -->
                        <div class="d-flex justify-content-center mt-5">
                            <a href="{{ route('platos.index') }}" class="btn btn-secondary btn-lg rounded-3 px-4">
                                <i class="fa fa-arrow-left"></i> Cancelar
                            </a>

                            <button type="submit" class="btn btn-primary btn-lg rounded-3 px-4"
                                style="background: linear-gradient(135deg); border: none;">
                                Guardar Plato
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

    .btn-primary {
        background-color: #2563eb;
        border-color: #2563eb;
    }

    .btn-primary:hover {
        background-color: #3152acff;
        border-color: #3152acff;
    }

    .btn-secondary {
        background-color: #dd1212ff;
        border-color: #dd1212ff;
    }

    .btn-secondary:hover {
        background-color: #c52e2eff;
        border-color: #c52e2eff;
    }
</style>
@endsection
