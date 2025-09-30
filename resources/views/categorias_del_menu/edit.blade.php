@extends('layouts.private')

@section('contenido')

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Editar categoria del menu
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('categorias_del_menu.update', $categoria->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="nombre" class="form-label fs-14 text-dark">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $categoria->nombre }}" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="estado" class="form-label fs-14 text-dark">Estado</label>
                                <select class="form-control" id="estado" name="estado" required>
                                    <option value="Activo" {{ $categoria->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="Inactivo" {{ $categoria->estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label for="descripcion" class="form-label fs-14 text-dark">Descripción</label>
                                <textarea type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Ingrese descripcion">{{ $categoria->descripcion }}</textarea>
                            </div>
                        </div>

                    </div>
                    <button class="btn btn-primary" type="submit">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
