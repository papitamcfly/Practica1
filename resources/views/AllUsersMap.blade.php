<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')
@extends('layouts.navbar')
@section('encabezado')
Ubicaciones
@endsection
@section('content')
<style>
  #map {
    height: 400px; /* Define una altura para el mapa */
    width: 100%;
  }
</style>
    <div class="container">

<div id="map"></div>
<div id="address"></div>

    </div>
    <script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJaFDtQn1qn_OCy-o80iBjFI2CB5tiKiM&callback=initMap">
</script>
<script>
    let map;
    let markers = [];
    let infoWindow;

    function initMap() {
        const mapOptions = {
            center: {lat: 25.532605917035117, lng: -103.32169532775879},
            zoom: 10
        };
        const mapdiv = document.getElementById("map");
        map = new google.maps.Map(mapdiv, mapOptions);
        infoWindow = new google.maps.InfoWindow();

        const users = @json($users);

        users.forEach(user => {
            addMarker({ lat: parseFloat(user.latitude), lng: parseFloat(user.longitude) }, user);
            
        });
    }

    function addMarker(location, user) {
        const marker = new google.maps.Marker({
            position: location,
            map: map,
        });

        markers.push(marker);

        marker.addListener('click', () => {
            const contentString = `
                <div>
                    <h4>${user.name} ${user.lastname_p} ${user.lastname_m}</h4>
                    <p>Edad: ${user.age}</p>
                    <p>Cumpleaños: ${user.birthdate}</p>
                    <p>Teléfono: ${user.phone}</p>
                    <p>Correo: ${user.email}</p>
                    <p>Estado: ${user.active}</p>
                </div>
            `;
            infoWindow.setContent(contentString);
            infoWindow.open(map, marker);
        });

    }
    function geocodeLatLng(latLng) {
            geocoder.geocode({'location': latLng}, (results, status) => {
                if (status === 'OK') {
                    if (results[0]) {
                        map.setCenter(latLng);
                        const marker = new google.maps.Marker({
                            position: latLng,
                            map: map
                        });
                        document.getElementById('address').innerText = results[0].formatted_address;
                    } else {
                        alert('No results found');
                    }
                } else {
                    alert('Geocoder failed due to: ' + status);
                }
            });
        }
</script>
@endsection
