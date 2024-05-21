<!-- resources/views/auth/login.blade.php -->
@extends('layouts.app')
@section('encabezado')
Verificar código
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h3>Inserte el código enviado a su correo</h3>
                    <div class="card-body">
                        <form method="POST" action="{{ route('Verifycodepost') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Código') }}</label>

                                <div class="col-md-6">
                                    <input id="code" type="number" class="form-control @error('code') is-invalid @enderror" name="code" required autocomplete="current-code">

                                    @error('code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Verificar') }}
                                    </button>
                                    <a href="{{ route('login') }}" class="btn btn-secondary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Volver al login') }}
                                    </a>
                                </div>
                            </div>
                        </form>

                        <form id="logout-form" action="{{ route('clearCookieAndLogin') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
