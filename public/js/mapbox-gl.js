mapboxgl.accessToken = '{{env("MAPBOX_ACCESS_TOKEN")}}';
var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/lucasaguiar12/clhifk76u02s101pa7em01dqd',
    center: [-74.50, 40],
    zoom: 9
});

var marker = new mapboxgl.Marker()
    .setLngLat([-74.50, 40])
    .addTo(map);
