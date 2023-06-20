<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi página con Bootstrap</title>
    <!-- Agregamos los estilos de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <link rel="stylesheet" href="{{asset('css/styleMapita.css')}}">
</head>
<body>
@extends('layouts.app')
@section('content')
  
    <div class="container rounded border border-secondary p-4 mt-4">
        <div id="mapa" style="width: 100%; height: 400px; margin-top: 10px;"></div>
    </div>


    <div class="modal fade" id="seminarioModal" tabindex="-1" role="dialog" aria-labelledby="seminarioModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="seminarioModalLabel">Detalles del Seminario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>Nombre del seminario:</label>
                    <h6 id="seminarioTitulo"></h6>
                    <br>
                    <label>Descripción:</label>
                    <p id="seminarioDescripcion"></p>
                    <br>
                    <label>Precio:</label>
                    <p id="precio"></p>
                    <br>
                    <label>Fecha:</label>
                    <p id="fecha"></p>
                    <!-- Agrega aquí los demás campos del seminario que deseas mostrar -->
                    <a href="" class="btn-like-link" id="enlaceSeminarioModal">Enlace como botón</a>
                  </div>
            </div>
        </div>
    </div>


    <!-- Agregamos los scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4CBnz1IbIRqZQ-NULt4Ygcyh-R9D0Qu8&callback=initMap" async defer></script>
 <script>
 

  function initMap() {

    var ubicaciones = {!! json_encode($ubicaciones) !!};
  var ubicacionesObj = [];

  ubicaciones.forEach(function(coord) {
    var latitud = parseFloat(coord.ubicacion.split(',')[0]);
    var longitud = parseFloat(coord.ubicacion.split(',')[1]);
    ubicacionesObj.push({lat: latitud, lng: longitud});
  });

  var ubicacionInput = document.getElementById("ubicacion");
  var mapaDiv = document.getElementById("mapa");

  var map;
  var marker;



    map = new google.maps.Map(mapaDiv, {
      center: ubicacionesObj[0],
      zoom: 15
    });

    marker = new google.maps.Marker({
      map: map,
      draggable: true
    });

    google.maps.event.addListener(map, 'click', function(event) {
      marker.setPosition(event.latLng);
      ubicacionInput.value = event.latLng.lat() + ', ' + event.latLng.lng();
    });

    var marcador;
    ubicacionesObj.forEach(function(coordenada) {
      marcador = new google.maps.Marker({
        position: coordenada,
        map: map,
        title: 'Ubicacion'
      });

      var enlaceSeminarioModal = document.getElementById("enlaceSeminarioModal");

      marcador.addListener('click', function() {
        var latitud = this.getPosition().lat();
        var longitud = this.getPosition().lng();

        $.ajax({
  url: 'http://localhost/learndo/public/encontrarSeminario',
  type: 'GET',
  data: {
    latitud: latitud,
    longitud: longitud,
    _token: '{{csrf_token()}}'
  },
  success: function(response) {
    var data = response.response;
    $('#seminarioTitulo').text(data.titulo);
    $('#seminarioDescripcion').text(data.descripcion);
    $('#precio').text(data.precio);
    $('#fecha').text(data.fecha);
    var titulo = data.titulo;
    // Asignar el título al atributo data-nombre del enlace
    var enlaceSeminarioModal = document.getElementById("enlaceSeminarioModal");
    enlaceSeminarioModal.setAttribute("data-nombre", titulo);
    // Actualizar el enlace con la URL correcta incluyendo el parámetro nombre
    enlaceSeminarioModal.href = "{{ route('verSeminario', ':titulo') }}".replace(':titulo', encodeURIComponent(titulo));
    $('#seminarioModal').modal('show');
  }
});

      });
    });
  }

    window.onload = function() {
      initMap();
    };
</script>
@endsection
</body>
</html>
