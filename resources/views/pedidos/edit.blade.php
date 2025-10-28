@extends('layouts.private')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Editar Pedido #{{ $pedido->id }}</h4>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('pedidos.update', $pedido->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="estado" class="form-label">Estado del Pedido</label>
                    <select name="estado" id="estado" class="form-control" required>
                        <option value="pendiente" {{ $pedido->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="en_proceso" {{ $pedido->estado == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                        <option value="finalizado" {{ $pedido->estado == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                    </select>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
