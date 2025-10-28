@extends('layouts.auth')

@section('content')
<div class="row justify-content-center authentication authentication-basic align-items-center h-100">
    <div class="">
        <div class="card" 
            style="background: linear-gradient(135deg, #a5a562ff, #914521ff); color: white; box-shadow: 0 4px 15px rgba(8, 3, 3, 0.3); border-radius: 1rem;" 
                   border-radius: 1rem; 
                   max-width: 600px; 
                   margin: auto;>
            <div class="card-body p-5">
                
                

                <!-- Foto o inicial -->
                
                <div class="text-center mb-3">
            <img class="logo-abbr" src="{{ asset('images/logo.png') }}" alt="">
            <img class="logo-compact" src="{{ asset('images/logo-text.png') }}" alt="">
        </div>
        <hr class="my-2" style="border-color: rgba(255,255,255,0.2);">
            <p class="mb-1 text-muted fw-normal text-center" style="color: #cfcfcf !important;">
                   PERFIL
                </p>

                <p class="mb-4 text-muted fw-normal text-center" style="color: #cfcfcf !important;">
                    AQUI PUEDES VER Y ACTUALIZAR TU INFORMACIÓN PERSONAL
                </p>
                <!-- Formulario de actualización -->
                 <hr class="my-2" style="border-color: rgba(255,255,255,0.2);">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <!-- Nombre -->
                    <div class="col-xl-12 mb-2">
                        <label for="name" class="form-label">NOMBRE:</label>
                        <input type="text" class="form-control form-control-lg" id="name" name="name"
                               value="{{ old('name', Auth::user()->name) }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-xl-12 mb-3">
                        <label for="email" class="form-label">CORREO ELECTRÓNICO:</label>
                        <input type="email" class="form-control form-control-lg" id="email" name="email"
                               value="{{ old('email', Auth::user()->email) }}" required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Contraseña (opcional) -->
                    <div class="col-xl-12 mb-3">
                        <label for="password" class="form-label">NUEVA CONTRASEÑA (opcional):</label>
                        <div class="input-group">
                            <input type="password" class="form-control form-control-lg" id="password" name="password">
                            <button type="button" class="btn btn-light"
                                onmousedown="showPassword('password', this)"
                                onmouseup="hidePassword('password', this)"
                                onmouseleave="hidePassword('password', this)">
                                <i class="ri-eye-off-line align-middle"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-lg btn-primary px-5">Guardar Cambios</button>
                    </div>
                </form>
                <hr class="my-3" style="border-color: rgba(255,255,255,0.2);">
                <!-- Botón para volver -->
                <div class="text-center mt-4">
    <a href="{{ route('dashboard') }}" 
       class="btn px-4"
       style="background-color: #7caee0ff; color: black; border: 1px solid #6c757d;">
        <i class="ri-arrow-left-line align-middle me-1"></i> Volver al inicio
    </a>
</div>

            </div>
        </div>
    </div>
</div>

<!-- Script para mostrar/ocultar contraseña -->
<script>
function showPassword(inputId, button) {
    const input = document.getElementById(inputId);
    const icon = button.querySelector('i');
    input.type = "text";
    icon.classList.remove("ri-eye-off-line");
    icon.classList.add("ri-eye-line");
}
function hidePassword(inputId, button) {
    const input = document.getElementById(inputId);
    const icon = button.querySelector('i');
    input.type = "password";
    icon.classList.remove("ri-eye-line");
    icon.classList.add("ri-eye-off-line");
}
</script>
@endsection
