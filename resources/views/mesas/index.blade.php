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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Lista</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Lista de Mesas</h4>
                        <a href="{{ route('mesas.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Agregar
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display datatable" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>Número</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mesas as $mesa)
                                        <tr>
                                            <td>{{ $mesa->numero }}</td>
                                            <td>
                                                @if($mesa->estado == 'libre')
                                                    <span class="badge badge-success">Libre</span>
                                                @elseif($mesa->estado == 'ocupada')
                                                    <span class="badge badge-warning">Ocupada</span>
                                                @else
                                                    <span class="badge badge-info">Reservada</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('mesas.edit', $mesa) }}" class="btn btn-primary" title="Editar mesa">
                                                    <i class="fa fa-pencil"></i> Editar
                                                </a>
                                                <a href="javascript:;" class="btn btn-danger btn-delete"
                                                   data-id="{{ $mesa->id }}"
                                                   data-name="Mesa {{ $mesa->numero }}"
                                                   data-url="{{ route('mesas.destroy', $mesa->id) }}">
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
