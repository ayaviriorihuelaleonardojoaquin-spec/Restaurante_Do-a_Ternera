@extends('layouts.private')

@section('contenido')

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Datos de tipo de platos
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('tipos_de_platos.store') }}">
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
                                <label for="estado" class="form-label fs-14 text-dark">Estado</label>
                                <select class="form-control" id="estado" name="estado" required>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label for="descripcion" class="form-label fs-14 text-dark">Descripción</label>
                                <textarea type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Ingrese descripcion"></textarea>
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
