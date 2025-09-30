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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Lista</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Lista</h4>

                        <a href="{{ route('platos.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Agregar
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display datatable" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Precio</th>
                                        <th>Disponible</th>
                                        <th>Imagen</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($platos as $plato)
                                        <tr>
                                            <td>{{ $plato->nombre }}</td>
                                            <td>{{ $plato->descripcion }}</td>
                                            <td>Bs. {{ number_format($plato->precio, 2) }}</td>
                                            <td>
                                                @if($plato->disponible)
                                                    <span class="badge badge-success">Sí</span>
                                                @else
                                                    <span class="badge badge-danger">No</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($plato->imagen)
                                                    <img src="{{ asset('storage/' . $plato->imagen) }}" width="150">
                                                @else
                                                    <span>No hay imagen</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('platos.edit', $plato) }}" class="btn btn-primary" title="Editar plato">
                                                    <i class="fa fa-pencil"></i> Editar
                                                </a>
                                                <a href="javascript:;" class="btn btn-danger btn-delete"
                                                   data-id="{{ $plato->id }}"
                                                   data-name="{{ $plato->nombre }}"
                                                   data-url="{{ route('platos.destroy', $plato->id) }}">
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
