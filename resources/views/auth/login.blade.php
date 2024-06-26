@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4 text-center">
                            <button class="btn btn-outline-primary waves-effect waves-light" type="submit"><i class="bx bx-check label-icon"></i>Iniciar Sesión</button>
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}" style="color: #0d3e66;">Olvidaste tu contraseña?</a>
                            @endif
                        </div>
                        <div class="mt-4 text-center">
                            <ul class="list-inline">
                                <a href="/login-google" class="btn btn-outline-danger waves-effect waves-light"> <img src="/assets/images/google.png" alt="" height="20"> Continuar con Google </a>
                            </ul>
                        </div>
                        <div class="mt-4 text-center">
                            <a href="{{ route('register') }}" style="color: #0d3e66;">¿No tienes una cuenta? <strong>Crear Nueva</strong></a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
