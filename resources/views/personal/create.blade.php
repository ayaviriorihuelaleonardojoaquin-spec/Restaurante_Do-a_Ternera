@extends('layouts.private')

@section('contenido')

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Datos de persona
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('personas.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="nombre" class="form-label fs-14 text-dark">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="telefono" class="form-label fs-14 text-dark">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Ingrese el teléfono" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="email" class="form-label fs-14 text-dark">Correo</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese el correo" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="tipo" class="form-label fs-14 text-dark">Tipo</label>
                                <select class="form-control" id="tipo" name="tipo" required>
                                    <option value="Cliente">Cliente</option>
                                    <option value="Proveedor">Proveedor</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="estado" class="form-label fs-14 text-dark">Estado</label>
                                <select class="form-control" id="estado" name="estado" required>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Agregar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
