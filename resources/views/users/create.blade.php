@extends('layouts.private')

@section('content')
<div class="container-fluid py-4" style="background: linear-gradient(135deg, #101011ff, #131111ff); min-height: 100vh; padding-top: 20px;">
    <!-- Encabezado -->
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4 class="text-primary fw-bold">👤 Nuevo Usuario</h4>
                <span class="text-muted">Registra un nuevo usuario en el sistema</span>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
                <li class="breadcrumb-item active">Nuevo</li>
            </ol>
        </div>
    </div>

    <!-- Contenedor del formulario -->
    <div class="row justify-content-center mt-3">
        <div class="col-xl-8 col-lg-10">
            <div class="card shadow-lg border-0 rounded-4">
            
                <div class="card-header bg-secondary text-white rounded-top-4">
                    <h4 class="card-title mb-0 fw-semibold text-white"><i class="fa fa-users-cog me-2"></i>crear nuevo usuario</h4>
                </div>
                <div class="card-body p-5" style="background-color: #b3b3b3; border-radius: 0 0 1rem 1rem;">
                    <form method="POST" action="{{ route('users.store') }}" onsubmit="return validarPassword()">
                        @csrf
                        <div class="row g-4">
                            <!-- Nombre -->
                            <div class="form-group col-md-6">
                                <label for="name" class="form-label fw-semibold text-black">Nombre</label>
                                <input type="text" name="name" class="form-control shadow-sm border rounded-3 p-3"
                                    placeholder="Ej. Juan" value="{{ old('name') }}" required>
                            </div>

                            <!-- Apellido -->
                            <div class="form-group col-md-6">
                                <label for="last_name" class="form-label fw-semibold text-black">Apellido</label>
                                <input type="text" name="last_name" class="form-control shadow-sm border rounded-3 p-3"
                                    placeholder="Ej. Pérez" value="{{ old('last_name') }}" required>
                            </div>

                            <!-- Correo -->
                            <div class="form-group col-md-6">
                                <label for="email" class="form-label fw-semibold text-black">Correo electrónico</label>
                                <input type="email" name="email" class="form-control shadow-sm border rounded-3 p-3"
                                    placeholder="ejemplo@correo.com" value="{{ old('email') }}" required>
                            </div>

                            <!-- Rol -->
                            <div class="form-group col-md-6">
                                <label for="rol_id" class="form-label fw-semibold text-black">Rol</label>
                                <select name="rol_id" class="form-control shadow-sm border rounded-6 " required>
                                    <option value="{{ old('rol_id') }}" disabled {{ old('rol_id') ? '' : 'selected' }}>Seleccione un rol</option>
                                    @foreach ($roles as $rol)
                                        <option value="{{ $rol->id }}" {{ old('rol_id') == $rol->id ? 'selected' : '' }}>
                                            {{ $rol->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Contraseña -->
                            <div class="form-group col-md-6 position-relative">
                                <label for="password" class="form-label fw-semibold text-black">Contraseña</label>
                                <div class="input-group">
                                    <input type="password" id="password" name="password" class="form-control shadow-sm border rounded-3 p-3"
                                        placeholder="Ingrese una contraseña" required>
                                    <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password', this)">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                                <small class="text-dark">Debe tener mínimo 8 caracteres.</small>
                            </div>

                            <!-- Confirmar Contraseña -->
                            <div class="form-group col-md-6 position-relative">
                                <label for="password_confirmation" class="form-label fw-semibold text-black">Confirmar contraseña</label>
                                <div class="input-group">
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control shadow-sm border rounded-3 p-3"
                                        placeholder="Repita la contraseña" required>
                                    <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password_confirmation', this)">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="d-flex justify-content-center align-items-between ">
                            @csrf
                            <button type="button" class="btn btn-secondary btn-lg rounded-3 px-4 bg-red"
                                onclick="javascript:history.back()">
                                <i class="fa fa-arrow-left"></i> Cancelar
                            </button>
                            
                            
                            <button type="submit" class="btn btn-primary btn-lg rounded-3 px-4"
                                style="background: linear-gradient(135deg, #4e73df, #3751c7); border: none;">
                                Guardar Usuario
                            </button>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
function togglePassword(id, btn) {
    const input = document.getElementById(id);
    const icon = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    }
}

function validarPassword() {
    const password = document.getElementById('password').value;
    if (password.length < 8 ) {
        alert('La contraseña debe tener al menos 8 caracteres.');
        return false;
    }
    return true;
}
</script>
@endsection