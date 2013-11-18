/**
 * @file add js handlers for ogm lines and areas
 */

var allPolygons = [];

if ( null == Drupal.gmap ) {
} else {
Drupal.gmap.addHandler('gmap',function(elem) {
  var map = this;
  var coords = [];
  var nid;
  var color;
  var line;
  var line_opacity;
  var area_opacity;
  var tid;

  function avgLatLng(path) {
      var sumLat = 0;
      var sumLng = 0;
      for (var i=0; i<path.getLength(); i++) {
        sumLat += path.getAt(i).lat();
        sumLng += path.getAt(i).lng();
      }
      var avgLat = sumLat / path.getLength();
      var avgLng = sumLng / path.getLength();
      return new google.maps.LatLng(avgLat, avgLng);
  }

  if ( undefined != Drupal.settings.ogm_ol_lines ) {
  map.bind("ready", function() {
    // loop through the line coordinates passed from the module for the map
    for ( i = 0; i < Drupal.settings.ogm_ol_lines.length; i = i + 1 ) {
      coords = [];
      nid = Drupal.settings.ogm_ol_lines[i]['nid'];
      color = Drupal.settings.ogm_ol_lines[i]['color'];
      line = Drupal.settings.ogm_ol_lines[i]['coords'];
      line_opacity = Drupal.settings.ogm_ol_lines[i]['line_opacity'];
      tid = Drupal.settings.ogm_ol_lines[i]['tid'];
      // since there are multiple points in a line, loop through those,
      // turn them into google.maps.LatLng objects, and add that to an array
      for ( var j=line.length-1; j>=0; --j ) {
        var latlon = new google.maps.LatLng(parseFloat(line[j][1]), parseFloat(line[j][0]));
        coords.push(latlon);
      }
      // create the line instance
      var polyline = new google.maps.Polyline({
        path: coords,
        strokeColor: color,
        strokeWeight: 2,
        strokeOpacity: line_opacity,
      });
      allPolygons.push([tid,polyline]);

      var path = polyline.getPath();
      var center = avgLatLng(path)

      // single left click on the line
      google.maps.event.addListener(polyline, "click", OgmOlOnClick(nid, center));
      // add it to the map
      polyline.setMap(map.map);
    }

    // loop through the area coordinates passed from the module for the map
    for ( i = 0; i < Drupal.settings.ogm_ol_areas.length; i = i + 1 ) {
      coords = [];
      nid = Drupal.settings.ogm_ol_areas[i]['nid'];
      color = Drupal.settings.ogm_ol_areas[i]['color'];
      line = Drupal.settings.ogm_ol_areas[i]['coords'];
      line_opacity = Drupal.settings.ogm_ol_areas[i]['line_opacity'];
      area_opacity = Drupal.settings.ogm_ol_areas[i]['area_opacity'];
      tid = Drupal.settings.ogm_ol_areas[i]['tid'];
      // since there are multiple points in an area, loop through those,
      // turn them into google.maps.LatLng objects, and add that to an array
      for ( var j=line.length-1; j>=0; --j ) {
        var latlon = new google.maps.LatLng(parseFloat(line[j][1]), parseFloat(line[j][0]));
        coords.push(latlon);
      }
      // create the area instance
      var polyarea = new google.maps.Polygon({
        paths: coords,
        strokeColor: color,
        strokeWeight: 3,
        strokeOpacity: line_opacity,
        fillColor: color,
        fillOpacity: area_opacity
      });
      allPolygons.push([tid,polyarea]);
      
      var path = polyarea.getPath();
      var center = avgLatLng(path)

      // single left click on the area
      google.maps.event.addListener(polyarea, "click", OgmOlOnClick(nid, center));
      // add it to the map
      polyarea.setMap(map.map);
    }
 });
 } // end outer if
});
} // end else wrapped around whole block above

function OgmOlOnClick(nid, point) {
  return function() {
    showInfoWindow(nid, point);
  };
};

function ogmOlRemovePolies(map, tid) {
  if (allPolygons) {
    allPolygons.map(function(poly) {
      if (poly[0] === tid) {
        poly[1].setMap(null);
      }
    });
  }
}

function ogmOlAddPolies(map, tid) {
  if (allPolygons) {
    allPolygons.map(function(poly) {
      if (poly[0] === tid) {
        poly[1].setMap(map);
      }
    });
  }
}
