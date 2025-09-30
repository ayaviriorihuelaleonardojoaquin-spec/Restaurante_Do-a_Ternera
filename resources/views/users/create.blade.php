@extends('layouts.private')

@section('content')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Usuarios</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Usuarios</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Nuevo</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Datos del Usuario</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="POST" action="{{ route('users.store') }}">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Nombre</label>
                                        <input type="text" name="name" class="form-control" placeholder="Nombre"
                                            value="{{ old('name') }}" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="last_name">Apellido</label>
                                        <input type="text" name="last_name" class="form-control" placeholder="Apellido"
                                            value="{{ old('last_name') }}" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="email">Correo electrónico</label>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Correo electrónico" value="{{ old('email') }}" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="rol_id">Rol</label>
                                        <select name="rol_id" class="form-control" required>
                                            <option value="" disabled {{ old('rol_id') ? '' : 'selected' }}>Seleccione un rol</option>
                                            @foreach ($roles as $rol)
                                                <option value="{{ $rol->id }}" {{ old('rol_id') == $rol->id ? 'selected' : '' }}>
                                                    {{ $rol->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="password">Contraseña</label>
                                        <input type="password" name="password" class="form-control" placeholder="Contraseña"
                                            required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="password_confirmation">Confirmar contraseña</label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            placeholder="Confirmar contraseña" required>
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
