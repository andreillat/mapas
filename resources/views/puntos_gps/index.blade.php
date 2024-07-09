@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        <div id="map"></div>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Puntos GPS Registrados</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Dispositivo</th>
                                <th>IMEI</th>
                                <th>Tiempo</th>
                                <th>Placa</th>
                                <th>Versión</th>
                                <th>Longitud</th>
                                <th>Latitud</th>
                                <th>Fecha Recepción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($puntosGps as $puntoGps)
                            <tr>
                                <td>{{ $puntoGps->dispositivo }}</td>
                                <td>{{ $puntoGps->imei }}</td>
                                <td>{{ $puntoGps->tiempo }}</td>
                                <td>{{ $puntoGps->placa }}</td>
                                <td>{{ $puntoGps->version }}</td>
                                <td>{{ $puntoGps->longitud }}</td>
                                <td>{{ $puntoGps->latitud }}</td>
                                <td>{{ $puntoGps->fecha_recepcion }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    // Inicializar el mapa
    var map = L.map('map').setView([4.7110, -74.0721], 12);

    // Agregar capa de OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Obtener los puntos desde Blade
    var puntos = @json($puntosGps);

     // Crear una lista de coordenadas
     var latlngs = puntos.map(function(punto) {
        return [punto.longitud, -(punto.latitud)];
    });

    // Crear un polyline y agregarlo al mapa
    var polyline = L.polyline(latlngs, {color: 'blue'}).addTo(map);

    // Ajustar la vista del mapa para incluir toda la polyline
    map.fitBounds(polyline.getBounds());

    // Agregar marcadores individuales si es necesario
    puntos.forEach(function(punto) {
       L.marker([punto.longitud, -(punto.latitud)]).addTo(map)
            .bindPopup('Longitud: ' + punto.longitud + '<br>Latitud: ' + -(punto.latitud));
    });
</script>
@endsection
@section('css')

