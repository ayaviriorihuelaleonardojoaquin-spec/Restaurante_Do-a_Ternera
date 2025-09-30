@extends('layouts.auth')

@section('content')

    <div class="auth-form">

        <div class="text-center mb-5">
            <img class="logo-abbr" src="{{ asset('images/logo.png') }}" alt="">
            <img class="logo-compact" src="{{ asset('images/logo-text.png') }}" alt="">
        </div>
        
        <h3 class="text-center mb-4">{{ __( 'Sign In') }}</h3>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email" class="mb-1"><strong>{{ __(key: 'Email') }}</strong></label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
                
            </div>
            <div class="form-group">
                <label for="password" class="mb-1"><strong>{{ __(key: 'Password') }}</strong></label>
                <input type="password" id="password" name="password" class="form-control" value="">
                @error('password')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-row d-flex justify-content-between mt-4 mb-2">
                <div class="form-group">
                    <div class="custom-control custom-checkbox ml-1">
                        
                    </div>
                </div>
                <!--
                <div class="form-group">
                    <a href="{{ route('password.request') }}">{{ __(key: 'Forgot your password?') }}</a>
                </div>
                -->
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-block">{{ __(key: 'Sign In') }}</button>
            </div>
        </form>
        <!--
        <div class="new-account mt-3">
            <p>{{ __('Dont have an account?') }} <a class="text-primary" href="#">{{ __('Register') }}</a></p>
        </div>
        -->
        <style>
    .texto-grande {
        font-size: 20px; /* Cambia el valor según quieras */
    }
    
</style>
    </div>
    <div class="text-center mt-100">
    <small class="texto-grande">¿Eres nuevo?</small>
    <a href="{{ route('register') }}" class="fw-bold texto-grande"> Crear una cuenta</a>
</div>

@endsection