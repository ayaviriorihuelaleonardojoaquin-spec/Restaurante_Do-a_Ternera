@extends('layouts.private')

@section('content')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Mesas</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Mesas</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Crear</a></li>
                </ol>
            </div>
        </div>

        @include('components.alerts.errors')

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Datos de la Mesa</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('mesas.store') }}">
                                @csrf
                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="numero">Número de Mesa</label>
                                        <input type="text" name="numero" class="form-control" placeholder="Ej: M01"
                                            value="{{ old('numero') }}" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="estado">Estado</label>
                                        <select name="estado" class="form-control" required>
                                            <option value="libre" {{ old('estado') == 'libre' ? 'selected' : '' }}>Libre</option>
                                            <option value="ocupada" {{ old('estado') == 'ocupada' ? 'selected' : '' }}>Ocupada</option>
                                            <option value="reservada" {{ old('estado') == 'reservada' ? 'selected' : '' }}>Reservada</option>
                                        </select>
                                    </div>

                                </div>

                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
