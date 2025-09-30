@extends('layouts.private')

@section('content')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Platos</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Platos</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Editar</a></li>
                </ol>
            </div>
        </div>

        @include('components.alerts.errors')

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Editar Plato</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('platos.update', $plato->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $plato->nombre) }}" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="precio">Precio</label>
                                        <input type="number" step="0.01" name="precio" class="form-control" value="{{ old('precio', $plato->precio) }}" required>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="descripcion">Descripción</label>
                                        <textarea name="descripcion" class="form-control" rows="3" required>{{ old('descripcion', $plato->descripcion) }}</textarea>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="disponible">Disponible</label>
                                        <select name="disponible" class="form-control" required>
                                            <option value="1" {{ old('disponible', $plato->disponible) == "1" ? 'selected' : '' }}>Sí</option>
                                            <option value="0" {{ old('disponible', $plato->disponible) == "0" ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="imagen">Imagen</label>
                                        <input type="file" name="imagen" class="form-control" accept="image/*">
                                        @if ($plato->imagen)
                                            <small class="form-text text-muted mt-2">Imagen actual:</small>
                                            <img src="{{ asset('storage/' . $plato->imagen) }}" alt="Imagen actual" width="100">
                                        @endif
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
