// // iterate over all widgets in page:
// for ( i = 0; i < Drupal.settings.ogm_ol.length; i = i + 1 ) {
//   // grab the map settings for the page
//   var s = Drupal.settings.ogm_ol[i];
//
//   // define the map object
//   var map = OL.maps.['openlayers-cck-widget-map-field_test_poly'];
// // console.debug(map);
//
//   // set the lat lng and zoom based on the first group map this node is part of
//   //requires: Drupal.settings.ogm_ol[i].gmap_poly_group_map
//   var lat = s.ogm_ol_group_map.lat;
//   var lng = s.ogm_ol_group_map.lng;
//   var zoom = s.ogm_ol_group_map.zoom;
//
//   zoom = parseInt(zoom);
//   var center = new OpenLayers.LonLat(parseFloat(lng),parseFloat(lat));
//
//   //pass settings to the map.
// //   map.setCenter(center, zoom);
// }
// console.log('here');
// console.debug(Drupal.settings.gmap);
//
// //define the line
// var polyline = new GPolyline([
// new GLatLng(parseFloat(40.72085157020638), parseFloat(-73.99309158325195)),
// new GLatLng(parseFloat(40.728078), parseFloat(-74))
// ], "#000000", 5);
//
// console.debug(polyline);
// // add the line to the map
//   Drupal.gmap.addOverlay(polyline);



// function initialize() {
// console.log('init');
//   var m = Drupal.gmap.getMap('gmap-auto1map-gmap0');
// console.debug(m);
//   if (m.map) {
// console.log('got here');
// //     OgmOlAddPoly(m.map);
//   }
// }
//
// $(document).ready(function(){
//   initialize();
// })
//
// function OgmOlAddPoly(map) {
// }

console.debug(Drupal.gmap.map);
Drupal.gmap.addHandler('gmap',function(elem) {
console.log('in the handler');
  var map = this;
console.debug(map);
  GEvent.addListener(map, "click", function() {
console.log('mouse over');
    //define the line
    var polyline = new GPolyline([
    new GLatLng(parseFloat(40.72085157020638), parseFloat(-73.99309158325195)),
    new GLatLng(parseFloat(40.728078), parseFloat(-74))
    ], "#000000", 5);

    // add the line to the map
      map.map.addOverlay(polyline);
  });
});