@extends('layouts.private')

@section('contenido')
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title">
                        Lista de tipos de platos
                    </div>
                    <div>
                        <div class="breadcrumb mb-0">
                            <a aria-label="anchor" href="{{ route('tipos_de_platos.create') }}" class="btn btn-primary ms-auto"><i class="ti ti-circle-plus me-2"></i>Agregar</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-basic" class="table table-bordered text-nowrap w-100  table-sm">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Estado</th>
                                    <th>Eliminado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tipos as $tipo)
                                    <tr>
                                        <td>{{ $tipo->id }}</td>
                                        <td>{{ $tipo->nombre }}</td>
                                        <td>{{ $tipo->estado }}</td>
                                        <td>{{ $tipo->eliminado ? 'Sí' : 'No' }}</td>
                                        <td>
                                            <div class="hstack gap-2 fs-15">
                                                <a href="{{ route('tipos_de_platos.edit', $tipo->id) }}" class="btn btn-icon btn-sm btn-info"><i class="ri-edit-line"></i></a>
                                                <form action="{{ route('tipos_de_platos.destroy', $tipo->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-icon btn-sm btn-danger"><i class="ri-delete-bin-line"></i></button>
                                                </form>
                                            </div>
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
@endsection
