<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')
@extends('layouts.navbar')
@section('encabezado')
Usuarios
@endsection
@section('content')
    <div class="container">
    <table class="table mt-5">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Edad</th>
            <th scope="col">Cumpleaños</th>
            <th scope="col">Telefono</th>
            <th scope="col">Correo</th>
            <th scope="col">Acciones</th>

        </tr>
    </thead>
    <tbody>
        @if (count($users) > 0)
            @foreach ($users as $cont)
                <tr>
                    <th>{{ $cont->id }}</th>
                    <th>{{ $cont->name }} {{$cont->lastname_p}} {{$cont->lastname_m}}</th>
                    <th>{{ $cont->age }}</th>
                    <th>{{ $cont->birthdate }}</th>
                    <th>{{ $cont->phone }}</th>
                    <th>{{ $cont->email }}</th>
                    <th><a href="/show/{{ $cont->id }}" class="btn btn-primary">Edit</a>                    </th>
                </tr>
            @endforeach
        @else
            <tr>
                <th>No Data</th>
            </tr>
        @endif
    </tbody>
</table>
    </div>
@endsection