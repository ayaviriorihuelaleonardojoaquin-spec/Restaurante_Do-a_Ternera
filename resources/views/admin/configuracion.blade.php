@extends('layouts.private')

@section('content')
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #101011ff, #131111ff); min-height: 100vh;">
    <h2 class="mb-4 text-white">Configuración</h2>

    <form>
        
        <div class="mb-3 mb-4 text-white">
            <label class="form-label">Nombre del Restaurante</label>
            <input type="text" class="form-control" value="Doña Ternera">
        </div>

        <div class="mb-3 mb-4 text-white">
            <label class="form-label">Dirección</label>
            <input type="text" class="form-control" value="Calle Principal #123">
        </div>

        <div class="mb-3 mb-4 text-white">
            <label class="form-label">Teléfono</label>
            <input type="text" class="form-control" value="+591 70000000">
        </div>

        <div class="mb-3 mb-4 text-white">
            <label class="form-label">Correo de Contacto</label>
            <input type="email" class="form-control" value="contacto@donaternera.com">
        </div>

        <button type="submit" class="btn btn-success">💾 Guardar Cambios</button>
    </form>
    
</div>

@endsection
