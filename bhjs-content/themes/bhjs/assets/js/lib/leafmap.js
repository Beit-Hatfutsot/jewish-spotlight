var map = L.map( 'communities_map', {
  center:  [_map_center_lng, _map_center_lat],
  minZoom: _map_zoom,
  maxZoom: _map_zoom + 2,
  zoom:    _map_zoom
})

L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
  subdomains: ['a', 'b', 'c']
}).addTo( map )

var markers = JSON.parse(_map_markers);

for ( var i=0; i < markers.length; ++i ) {
  L.marker( [markers[i].lat, markers[i].lng]/*, {icon: myIcon}*/ )
  .bindPopup( '<a href="' + markers[i].url + '" target="_blank">' + markers[i].name + '</a>' )
  .addTo( map );
}