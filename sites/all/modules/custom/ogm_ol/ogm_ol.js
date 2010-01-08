// iterate over all widgets in page:
for ( i = 0; i < Drupal.settings.ogm_ol.length; i = i + 1 ) {
  // grab the map settings for the page
  var s = Drupal.settings.ogm_ol[i];

  // define the map object
  var map = OL.maps.['openlayers-cck-widget-map-field_test_poly'];
// console.debug(map);

  // set the lat lng and zoom based on the first group map this node is part of
  //requires: Drupal.settings.ogm_ol[i].gmap_poly_group_map
  var lat = s.ogm_ol_group_map.lat;
  var lng = s.ogm_ol_group_map.lng;
  var zoom = s.ogm_ol_group_map.zoom;

  zoom = parseInt(zoom);
  var center = new OpenLayers.LonLat(parseFloat(lng),parseFloat(lat));

  //pass settings to the map.
//   map.setCenter(center, zoom);
}

