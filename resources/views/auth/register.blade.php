@extends('layouts.auth')

@section('content')
<div class="row justify-content-center authentication authentication-basic align-items-center h-100">
    <div class="">
        <div class="card custom-card">
            <div class="card-body p-5">
                <p class="h5 fw-semibold mb-2 text-center">REGISTRARSE</p>
                <p class="mb-4 text-muted op-7 fw-normal text-center">
                    ¡BIENVENIDO! ÚNETE CREANDO UNA CUENTA GRATUITA
                </p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Nombre -->
                    <div class="col-xl-12 mb-3">
                        <label for="signup-name" class="form-label text-default">NOMBRE:</label>
                        <input type="text" class="form-control form-control-lg" id="signup-name" name="name"
                               value="{{ old('name') }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Apellido -->
                    <div class="col-xl-12 mb-3">
                        <label for="last_name" class="form-label">APELLIDO:</label>
                        <input type="text" class="form-control form-control-lg" id="last_name" name="last_name"
                               value="{{ old('last_name') }}" required>
                    </div>

                    <!-- Email -->
                    <div class="col-xl-12 mb-3">
                        <label for="email" class="form-label text-default">CORREO ELECTRÓNICO:</label>
                        <input type="email" class="form-control form-control-lg" id="email" name="email"
                               value="{{ old('email') }}" required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                   
                    <!-- Contraseña -->
                    <div class="col-xl-12 mb-3">
                        <label for="signup-password" class="form-label text-default">CONTRASEÑA:</label>
                        <div class="input-group">
                            <input type="password" class="form-control form-control-lg" id="signup-password" name="password" required>
                            <button type="button" class="btn btn-light"
                                onmousedown="showPassword('signup-password', this)"
                                onmouseup="hidePassword('signup-password', this)"
                                onmouseleave="hidePassword('signup-password', this)">
                                <i class="ri-eye-off-line align-middle"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div class="col-xl-12 mb-3">
                        <label for="signup-confirmpassword" class="form-label text-default">CONFIRMAR CONTRASEÑA:</label>
                        <div class="input-group">
                            <input type="password" class="form-control form-control-lg" id="signup-confirmpassword" name="password_confirmation" required>
                            <button type="button" class="btn btn-light"
                                onmousedown="showPassword('signup-confirmpassword', this)"
                                onmouseup="hidePassword('signup-confirmpassword', this)"
                                onmouseleave="hidePassword('signup-confirmpassword', this)">
                                <i class="ri-eye-off-line align-middle"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Términos y Condiciones -->
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" id="defaultCheck1" required>
                        <label class="form-check-label text-muted fw-normal" for="defaultCheck1">
                            Al crear una cuenta, aceptas nuestros
                            <a href="terms_conditions.html" class="text-success"><u>Términos y Condiciones</u></a>
                            y la <a class="text-success"><u>Política de Privacidad</u></a>
                        </label>
                    </div>

                    <!-- Botón de registro -->
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-lg btn-primary">Crear Cuenta</button>
                    </div>
                </form>

                <!-- Enlace a login -->
                <div class="text-center">
                    <p class="text-muted mt-3">
                        ¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="text-primary">Iniciar Sesión</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script para mostrar/ocultar contraseña con mantener presionado -->
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