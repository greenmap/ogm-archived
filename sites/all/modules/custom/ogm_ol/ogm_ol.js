/**
 * @file add js handlers for ogm lines and areas
 */
Drupal.gmap.addHandler('gmap',function(elem) {
  var map = this;
  map.bind("ready", function() {
    // loop through the line coordinates passed from the module for the map
    for ( i = 0; i < Drupal.settings.ogm_ol_lines.length; i = i + 1 ) {
      var coords = [];
      var nid = Drupal.settings.ogm_ol_lines[i]['nid'];
      var color = Drupal.settings.ogm_ol_lines[i]['color'];
      var line = Drupal.settings.ogm_ol_lines[i]['coords'];
      // since there are multiple points in a line, loop through those,
      // turn them into Google GLatLng objects, and add that to an array
      for ( var j=line.length-1; j>=0; --j ) {
        var latlon = new GLatLng(parseFloat(line[j][1]), parseFloat(line[j][0]));
        coords.push(latlon);
      }
      // create the line instance
      var polyline = new GPolyline(coords, color, 5);
      // single left click on the line
      GEvent.addListener(polyline, "click", OgmOlOnClick(nid, polyline.getBounds().getCenter()));
      // add it to the map
      map.map.addOverlay(polyline);
    }

    // loop through the area coordinates passed from the module for the map
    for ( i = 0; i < Drupal.settings.ogm_ol_areas.length; i = i + 1 ) {
      var coords = [];
      var nid = Drupal.settings.ogm_ol_areas[i]['nid'];
      var color = Drupal.settings.ogm_ol_areas[i]['color'];
      var line = Drupal.settings.ogm_ol_areas[i]['coords'];
      // since there are multiple points in an area, loop through those,
      // turn them into Google GLatLng objects, and add that to an array
      for ( var j=line.length-1; j>=0; --j ) {
        var latlon = new GLatLng(parseFloat(line[j][1]), parseFloat(line[j][0]));
        coords.push(latlon);
      }
      // create the line instance
      var polyarea = new GPolygon(coords, color, 5);
      // single left click on the area
      GEvent.addListener(polyarea, "click", OgmOlOnClick(nid, polyarea.getBounds().getCenter()));
      // add it to the map
      map.map.addOverlay(polyarea);
    }
 });
});

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

//         jQuery(function(){
//           jQuery('.maximize').click(function() {
//             var rel = jQuery(this).attr('rel');             GlobalMap.getInfoWindow().maximize();
//           })
//         });
      }
      else {
        alert('Problems with the ajax (code 228)');
      }
    };
  };
};