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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Lista</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Lista</h4>

                        <a href="{{ route('users.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Agregar
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display datatable" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Email</th>
                                        <th>Rol</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->last_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->rol->nombre ?? 'Usuario' }}</td>
                                            <td>
                                                
                                                <a href="{{ route('users.edit', $user) }}" class="btn btn-primary"
                                                    title="Editar usuario"><i class="fa fa-pencil"></i> Editar </a>
                                                <a href="javascript:;" class="btn btn-danger btn-delete"
                                                    data-id="{{ $user->id }}"
                                                    data-name="{{ $user->name }} {{ $user->last_name }}"
                                                    data-url="{{ route('users.destroy', $user->id) }}">
                                                    <i class="fa fa-trash"></i> Eliminar
                                                </a>
                                            </td>
                                        </tr>
                                        
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection