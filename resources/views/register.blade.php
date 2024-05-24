@extends('layouts.app')
@section('encabezado')
Registro
@endsection
@section('content')
<script src="https://www.google.com/recaptcha/api.js?render=6Lc1JuUpAAAAAHNJwJzMZnzTylJlVZ4tP6P1KXwD"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registro de Usuario') }}</div>

                <div class="card-body">
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                    <form method="POST" action="{{ route('registerpost') }}">
                        @csrf

                        <div class="row mb-3">
                            
                            <div class="col">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus placeholder="Nombre">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col">
                                <input id="lastname_p" type="text" class="form-control @error('lastname_p') is-invalid @enderror" name="lastname_p" value="{{ old('lastname_p') }}"  autocomplete="lastname_p" placeholder="Apellido Paterno">
                                @error('lastname_p')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col">
                                <input id="lastname_m" type="text" class="form-control @error('lastname_m') is-invalid @enderror" name="lastname_m" value="{{ old('lastname_m') }}"  autocomplete="lastname_m" placeholder="Apellido Materno">
                                @error('lastname_m')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <input id="age" type="number" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}"  autocomplete="age" placeholder="Edad">
                                @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <input id="birthdate" type="date" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" value="{{ old('birthdate') }}"  autocomplete="birthdate">
                                @error('birthdate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" placeholder="Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col">
                                <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"  autocomplete="phone" placeholder="Teléfono">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" placeholder="Contraseña">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password" placeholder="Confirmar Contraseña">
                            </div>
                        </div>
                        @error('g-recaptcha-response')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrarse') }}
                                </button>
                            </div>
                            <div>
            <a href="{{ route('login') }}">Login</a>
        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('submit',function(e)
    {
        e.preventDefault();
        grecaptcha.ready(function() {
          grecaptcha.execute('6Lc1JuUpAAAAAHNJwJzMZnzTylJlVZ4tP6P1KXwD', {action: 'submit'}).then(function(token) {
              let form = e.target;
              let input = document.createElement('input');
              input.type = 'hidden';
              input.name = 'g-recaptcha-response';
              input.value = token;
              form.appendChild(input);
              form.submit();
          });
        });
    });
</script>
@endsection