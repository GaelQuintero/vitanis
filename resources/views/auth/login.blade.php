@extends('templates.base')

@section('title', 'Inicio')

@section('body')
<div class="container-fluid d-flex justify-content-center align-items-center vh-100 bg-dark animate__animated animate__fadeIn">
    <div class="row w-100 justify-content-center">
        <!-- Columna del formulario -->
        <div class="col-md-5 col-lg-4">
            <div class="card shadow-lg p-4 border-0 rounded">
                <!-- Logo y título -->
                <div class="text-center mb-4">
                    <img src="{{ asset('vitanis-inventory-logo.png') }}" alt="vitanis-inventory-logo" class="mb-3 img-fluid rounded-circle mx-auto d-block">
                    <p class="text-muted">Gestor de inventario eficiente y moderno</p>
                </div>

                <!-- Mensaje de estado -->
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <!-- Formulario de inicio de sesión -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Correo electrónico') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Contraseña -->
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Recordar sesión -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                        <label class="form-check-label" for="remember_me">{{ __('Recordar sesión') }}</label>
                    </div>

                    <!-- Botón de inicio de sesión -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">{{ __('Iniciar sesión') }}</button>
                    </div>

                    <!-- Enlace de recuperación de contraseña -->
                    {{-- @if (Route::has('password.request'))
                    <div class="text-center mt-3">
                        <a href="{{ route('password.request') }}" class="text-decoration-none text-muted">{{ __('¿Olvidaste tu contraseña?') }}</a>
                    </div>
                    @endif --}}
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
