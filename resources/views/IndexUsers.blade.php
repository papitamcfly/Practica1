<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')
@extends('layouts.navbar')
@section('encabezado')
Usuarios
@endsection
@section('content')
<style>
  #map {
    height: 400px; /* Define una altura para el mapa */
    width: 100%;
  }
</style>
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
            <th scope="col">Estado</th>
            <th scope="col">latitud</th>
            <th scope="col">longitud</th>
            <th scope="col">Acciones</th>

        </tr>
    </thead>
    <tbody>
        @if (count($users) > 0)
            @foreach ($users as $cont)
                <tr onclick="showMap( {{ $cont->latitude }} , {{$cont->longitude}}) ">
                    <td>{{ $cont->id }}</td>
                    <td>{{ $cont->name }} {{$cont->lastname_p}} {{$cont->lastname_m}}</td>
                    <td>{{ $cont->age }}</td>
                    <td>{{ $cont->birthdate }}</td>
                    <td>{{ $cont->phone }}</td>
                    <td>{{ $cont->email }}</td>
                    <td>{{ $cont->active }}</td>
                    <td>{{ $cont->latitude }}</td>
                    <td>{{ $cont->longitude }}</td>
                    <td><a href="/show/{{ $cont->id }}" class="btn btn-primary">Edit</a>      
                    <form action="{{ route('desactivaruser', $cont->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary">Desactivar</button>
                                </form>    
                </td>
                </tr>
            @endforeach
        @else
            <tr>
                <th>No Data</th>
            </tr>
        @endif
    </tbody>
</table>
<div id="map"></div>
    </div>
    <script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJaFDtQn1qn_OCy-o80iBjFI2CB5tiKiM&callback=initMap">
</script>
<script>
    let map;
    let marker;

    function initMap() {
        const mapOptions = {
            center: {lat: 25.532605917035117, lng: -103.32169532775879},
            zoom: 10
        };
        const mapdiv = document.getElementById("map");
    map = new google.maps.Map(mapdiv, mapOptions);

    }
    function showMap(lat,long)
    {
        var coord = {lat:lat,lng:long}
        map.setCenter(coord);
        if (marker) {
            marker.setPosition(coord);
        } else {
            marker = new google.maps.Marker({
                position: coord,
                map: map
            });
        }
    }
    showMap(0,0)
</script>
@endsection