<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('token'))
                            <p>Tu token de acceso es: {{ session('token') }}</p>
                        @endif

                        <a href="{{ route('logout') }}">Cerrar sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection