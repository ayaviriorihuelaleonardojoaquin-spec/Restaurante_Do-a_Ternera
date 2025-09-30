@extends('layouts.private')

@section('contenido')

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Editar persona
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('personas.update', $persona->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="nombre" class="form-label fs-14 text-dark">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $persona->nombre }}" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="telefono" class="form-label fs-14 text-dark">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $persona->telefono }}" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="email" class="form-label fs-14 text-dark">Correo</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $persona->email }}" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="tipo" class="form-label fs-14 text-dark">Tipo</label>
                                <select class="form-control" id="tipo" name="tipo" required>
                                    <option value="Cliente" {{ $persona->tipo == 'Cliente' ? 'selected' : '' }}>Cliente</option>
                                    <option value="Proveedor" {{ $persona->tipo == 'Proveedor' ? 'selected' : '' }}>Proveedor</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="estado" class="form-label fs-14 text-dark">Estado</label>
                                <select class="form-control" id="estado" name="estado" required>
                                    <option value="activo" {{ $persona->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="inactivo" {{ $persona->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                </select>
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
