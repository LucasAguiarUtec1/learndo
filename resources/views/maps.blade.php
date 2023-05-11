<!DOCTYPE html>
<html>
<head>
    <title>Mapbox Example</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
</head>
<body>

<div id='map'></div>

<script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
<script>
    mapboxgl.accessToken = '{{env("MAPBOX_ACCESS_TOKEN")}}';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/lucasaguiar12/clhifk76u02s101pa7em01dqd',
        center: [-74.50, 40],
        zoom: 9
    });

    // Agregar marcador al hacer doble clic
//Agregar doble-click para añadir marcador
map.on('dblclick', function(e) {    
    var marker = new mapboxgl.Marker()
        .setLngLat(e.lngLat)
        .addTo(map);
    
    //Agregar click para ver las coordenadas
    
});
marker.on('click', function() {
        alert("Latitud: " + marker.getLngLat().lat + "\nLongitud: " + marker.getLngLat().lng);
    });

	
</script>

</body>
</html>
