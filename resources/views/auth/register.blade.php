@extends('layouts.auth')

@section('content')
<div class="row justify-content-center authentication authentication-basic align-items-center h-100" >
    <div class="" >
        <div class="" style="background: linear-gradient(135deg, #a5a562ff, #914521ff); color: white; box-shadow: 0 4px 15px rgba(8, 3, 3, 0.3); border-radius: 1rem;">
            <div class="card-body p-5">
                <div class="text-center mb-5">
            <img class="logo-abbr" src="{{ asset('images/logo.png') }}" alt="">
            <img class="logo-compact" src="{{ asset('images/logo-text.png') }}" alt="">
        </div>
        <p class="form-label text-default text-center">
                    ¡BIENVENIDO! ÚNETE CREANDO UNA CUENTA GRATUITA
                </p>
                <hr class="my-2" style="border-color: rgba(255,255,255,0.2);">
        <p class="form-label text-default text-center">REGISTRARSE</p>
                
    
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
                        
                        <label class="form-check-label text-muted fw-normal" for="defaultCheck1">
                            Al crear una cuenta, aceptas nuestros
                            <a href="terms_conditions.html" class="text-success"><lavel>Términos y Condiciones</lavel></a>
                            y la <a class="text-success"><lavel>Política de Privacidad</lavel></a>
                        </label>
                    </div>

                    <!-- Botón de registro -->
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-lg btn-primary">Crear Cuenta</button>
                    </div>
                </form>
    <hr class="my-3" style="border-color: rgba(255,255,255,0.2);">
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