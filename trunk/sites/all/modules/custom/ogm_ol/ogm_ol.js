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
      // turn them into Google GLatLng objects, and add that to an array
      for ( var j=line.length-1; j>=0; --j ) {
        var latlon = new GLatLng(parseFloat(line[j][1]), parseFloat(line[j][0]));
        coords.push(latlon);
      }
      // create the line instance
      var polyline = new GPolyline(coords, color, 2, line_opacity);
      allPolygons.push([tid,polyline]);

      // single left click on the line
      GEvent.addListener(polyline, "click", OgmOlOnClick(nid, polyline.getBounds().getCenter()));
      // add it to the map
      map.map.addOverlay(polyline);
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
      // turn them into Google GLatLng objects, and add that to an array
      for ( var j=line.length-1; j>=0; --j ) {
        var latlon = new GLatLng(parseFloat(line[j][1]), parseFloat(line[j][0]));
        coords.push(latlon);
      }
      // create the area instance
      var polyarea = new GPolygon(coords, color, 3, line_opacity, color, area_opacity);
      allPolygons.push([tid,polyarea]);
      // single left click on the area
      GEvent.addListener(polyarea, "click", OgmOlOnClick(nid, polyarea.getBounds().getCenter()));
      // add it to the map
      map.map.addOverlay(polyarea);
    }
 });
 } // end outer if
});
} // end else wrapped around whole block above

function OgmOlOnClick(nid, point) {
  return function() {
    var html = Drupal.makeReq(Drupal_base_path + Drupal_language + '/' + 'node/gmap_marker/getMiniBubble/' + nid,'');

    html.onreadystatechange = function() {
      if (html.readyState != 4) {
        return;
      }
      if (html.status == 200) {// success
        maxContentDiv = document.createElement('div');
        // somewhere in here is a problem which results in two <html> tags
        maxContentDiv.id = 'maxcontentdiv';
        maxContentDiv.innerHTML = '<iframe frameborder="0" src="' + Drupal_base_path + Drupal_language + '/node/' + nid + '/simple" width="670" height="360"></    iframe>';
        GlobalMap.openInfoWindowHtml(point, html.responseText,
        {maxContent: maxContentDiv, maxTitle: ''});
      }
    };
  };
};

function ogmOlRemovePolies(map, tid) {
  if (allPolygons) {
    allPolygons.map(function(poly) {
      if (poly[0] === tid) {
        map.removeOverlay(poly[1]);
      }
    });
  }
}

function ogmOlAddPolies(map, tid) {
  if (allPolygons) {
    allPolygons.map(function(poly) {
      if (poly[0] === tid) {
        map.addOverlay(poly[1]);
      }
    });
  }
}
