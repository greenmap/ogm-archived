// vim:shiftwidth=2:tabstop=2:expandtab

// FIXME: polyline is still a global variable

// helper function declarations:

function newPolyline( s, points ){
  // name the textarea
  var textarea = document.getElementById(s.fieldDiv);

  //define the line
  if ( points ) {
    polyline = new GPolyline(points, "#000000", 5);
  }
  else {
    polyline = new GPolyline([], "#000000", 5);
  }

  // add the line to the map
  s.map.addOverlay(polyline);

  // turn on line drawing
  polyline.enableDrawing();
  s.drawing = 1;

  // Mouseover the the poly line
  var polyMouseoverListener = GEvent.addListener(polyline, "mouseover", function() {
    s.polymouseOver = true;
    polyline.enableEditing(); // edit points are shown
  });

  // Mouse Out for the poly line
  var polyMouseoutListener = GEvent.addListener(polyline, "mouseout", function() {
    s.polymouseOver = false;
    polyline.disableEditing();
  });

  // Mouse Out for the poly line
  var polyCancelineListener = GEvent.addListener(polyline, "cancelline", function() {
    if (polyline.getVertexCount() <= 1) {
      s.polyMissing = true;
    }
    s.drawing = 0;
  });

  var polyEndlineListener = GEvent.addListener(polyline, "endline", function() {
    s.drawing = 0;
  });

  // this listener populates the textfield with the "output" coordinates variable.
  var polyLineUpdatedListener = GEvent.addListener(polyline,"lineupdated", function() {
    var output = "";
    output = vertices2string(polyline);
    // write coordinates to the text area
    textarea.value = output;
  });
};

function vertices2string (polyline) {
  var output = "";
  for(var i = 0; i < polyline.getVertexCount();i++){
    var tmp = "";
    // get an individual set of points
    tmp += polyline.getVertex(i);
    // clean some Google stuff out
    tmp = tmp.replace("(","");
    tmp = tmp.replace(")","");

    var tmpLatLng = tmp.split(",");

    // add a space between points
    if(output != ""){
      output += " ";
    }
    // build a set of coordinates
    output +=  tmpLatLng[1] + "," + tmpLatLng[0];
  }
  return output;
}

function string2vertices( strcoords ) {
  placemarks = strcoords.split(" ");

  var path = [];
  for (var i = 0; i < placemarks.length; i++) {
    var coords = placemarks[i];
    coords = coords.replace(/\s+/g," "); // tidy the whitespace
    coords = coords.replace(/^ /,"");    // remove possible leading whitespace
    coords = coords.replace(/ $/,"");    // remove possible trailing whitespace
    coords = coords.replace(/, /,",");   // tidy the commas
    if ( coords !== "" ) {
      path.push(coords.split(","));
    }
  }

  if (path.length > 1) {
    // Build the list of points
    var points = [];
    var pbounds = new GLatLngBounds();
    for (var p = 0; p < path.length; p++) {
      var point = new GLatLng(parseFloat(path[p][1]),parseFloat(path[p][0]));
      points.push(point);
    }
    return points;
  }
  else {
    return [];
  }
}

//function is_array(value) {
//  return value &&
//    typeof value === 'object' &&
//    value.constructor === Array;
//}

// end helper function declarations

// iterate over all widgets in page: 
for ( i = 0; i < Drupal.settings.gmap_poly_widgets.length; i = i + 1 ) {
  var s = Drupal.settings.gmap_poly_widgets[i];
  // initialize the google map object for the div
  s.map = new GMap2(document.getElementById(s.mapDiv));
  s.polymouseOver = false;

  // set the lat lng and zoom based on the first group map this node is part of
  //requires: Drupal.settings.gmap_poly_widgets[i].gmap_poly_group_map
  var lat = s.gmap_poly_group_map.lat;
  var lng = s.gmap_poly_group_map.lng;
  var zoom = s.gmap_poly_group_map.zoom;

  zoom = parseInt(zoom);
  var center = new GLatLng(parseFloat(lat),parseFloat(lng));

  // pass settings to the map.
  s.map.setCenter(center, zoom);

  // add map controls
  s.map.addControl(new GLargeMapControl());
  s.map.addControl(new GMapTypeControl());

  //requires: Drupal.settings.gmap_poly_widgets[i].MapFieldId
  var polylineCoordinates = document.getElementById(s.fieldDiv).value;
  s.original_coords = polylineCoordinates;
  polylineInit(polylineCoordinates, s);
}

// parameter "s" should be passed an object from Drupal.settings.gmap_poly_widgets
function polylineInit(coords, s) {
  if ( coords ) {
    newPolyline(s, string2vertices(coords));
  }
  else {
    newPolyline(s);
  }
  // single left click on the map
  GEvent.addListener(s.map, "click",function() {
    if (s.polyMissing) {
      s.polyMissing = false;
      newPolyline(s);
    }
  });
  // single right click on the map
  GEvent.addListener(s.map, "singlerightclick",function(a,b,overlay) {
     // limit right click actions to the line.
     if(s.polymouseOver) {
      polyline.deleteVertex(overlay.index);
    }
  });
}

//functions exposed to the user directly via onclick attributes:

function clearPoly(delta) {
  var s = Drupal.settings.gmap_poly_widgets[delta];
  s.map.removeOverlay(polyline);
  if ( s.original_coords ) {
    newPolyline(s, string2vertices(s.original_coords));
  }
  else {
    newPolyline(s);
  }
};

function toggleUserDraw(delta) {
  var s = Drupal.settings.gmap_poly_widgets[delta];
  var toggleDivId = document.getElementById("gmap_poly_controls_" + delta);
  var test = toggleDivId.getElementsByClassName("gmap_poly_toggledraw");
  if ( s.drawing && polyline ) {
    polyline.disableEditing();
    s.drawing = 0;
  }
  else if (polyline) {
    polyline.enableDrawing();
    s.drawing = 1;
  }
}
