/**
 * @file add js handlers for ogm lines and areas
 */
Drupal.gmap.addHandler('gmap',function(elem) {
  var map = this;
  map.bind("ready", function() {
    // loop through the line coordinates passed from the module for the map
    for ( i = 0; i < Drupal.settings.ogm_ol_lines.length; i = i + 1 ) {
      var coords = [];
      var line = Drupal.settings.ogm_ol_lines[i];
      // since there are multiple points in a line, loop through those,
      // turn them into Google GLatLng objects, and add that to an array
      for ( var j=line.length-1; j>=0; --j ) {
        var latlon = new GLatLng(parseFloat(line[j][1]), parseFloat(line[j][0]));
        coords.push(latlon);
      }
      // create the line instance
      var polyline = new GPolyline(coords, "#000000", 5);
      // add it to the map
      map.map.addOverlay(polyline);
    }

    // loop through the area coordinates passed from the module for the map
    for ( i = 0; i < Drupal.settings.ogm_ol_areas.length; i = i + 1 ) {
      var coords = [];
      var line = Drupal.settings.ogm_ol_areas[i];
      // since there are multiple points in an area, loop through those,
      // turn them into Google GLatLng objects, and add that to an array
      for ( var j=line.length-1; j>=0; --j ) {
        var latlon = new GLatLng(parseFloat(line[j][1]), parseFloat(line[j][0]));
        coords.push(latlon);
      }
      // create the line instance
      var polyarea = new GPolygon(coords, "#000000", 5);
      // add it to the map
      map.map.addOverlay(polyarea);
    }


  });
});
