@extends('layouts.app')
@extends('layouts.navbar')
@section('encabezado')
Registrar localización
@endsection
@section('content')
<style>
  #map {
    height: 400px; /* Define una altura para el mapa */
    width: 100%;
  }
</style>
<div class="container">
  <form action="{{ route('editlocation') }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row mb-3">
        <div class="col-sm-3">
            <label for="latitude">Latitud</label>
            <input type="text" name="latitude" id="latitude" class="form-control" readonly value="{{ old('latitude', $user->latitude) }}">
        </div>
        <div class="col-sm-3">
            <label for="longitude">Longitud</label>
            <input type="text" name="longitude" id="longitude" class="form-control" readonly value="{{ old('longitude', $user->longitude) }}">
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <button class="btn btn-primary" type="submit">Registrar</button>
        </div>
    </div>
  </form>
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
            zoom: 8
        };
        const mapdiv = document.getElementById("map");
        map = new google.maps.Map(mapdiv, mapOptions);

        google.maps.event.addListener(map, 'click', function(event) {
            placeMarker(event.latLng);
        });
    }

    function placeMarker(location) {
        if (marker) {
            marker.setPosition(location);
        } else {
            marker = new google.maps.Marker({
                position: location,
                map: map
            });
        }
        document.getElementById("latitude").value = location.lat();
        document.getElementById("longitude").value = location.lng();
    }
</script>
@endsection
