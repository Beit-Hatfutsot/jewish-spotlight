var map = L.map( 'communities_map', {
  center:  [_map_center_lng, _map_center_lat],
  minZoom: _map_zoom,
  maxZoom: _map_zoom + 2,
  zoom:    _map_zoom
})

L.tileLayer( 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
  subdomains: ['a', 'b', 'c']
}).addTo( map )

var map_markers = [];