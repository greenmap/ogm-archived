// (function () { // Begin closure to make contents private

// vim:shiftwidth=2:tabstop=2:expandtab

// Declare a few div ids that will be used later
// TODO: Figure out a way to loop this for fields with multiple values
var MapDivId = Drupal.settings.gmap_poly_widget_0.mapDiv;
// FIXME: unused variable
var MapCoordId = Drupal.settings.gmap_poly_widget_0.coorDiv;
var MapFieldId = Drupal.settings.gmap_poly_widget_0.fieldDiv;

var polymouseOver = false;
var polyMissing = false;
var polyline;

// create a new GMap instance
var mmap=new GMap2(document.getElementById(MapDivId));

// Get the center point and zoom of the group map.
var MapSettings = Drupal.settings.gmap_poly_group_map;

var lat = MapSettings.lat;
var lng = MapSettings.lng;
var zoom = MapSettings.zoom;

// change these into usable values
zoom = parseInt(zoom);
var center = new GLatLng(parseFloat(lat),parseFloat(lng));

// pass settings to the map.
mmap.setCenter(center, zoom);

// add map controls
mmap.addControl(new GLargeMapControl());
mmap.addControl(new GMapTypeControl());

var polylineCoordinates = document.getElementById(MapFieldId).value;

function newPolyline( points ){
  // name the textarea
  var textarea = document.getElementById(MapFieldId);
  textarea.value = polylineCoordinates;

  //define the line
  if ( points ) {
    polyline = new GPolyline(points, "#000000", 5);
  }
  else {
    polyline = new GPolyline([], "#000000", 5);
  }

  // add the line to the map
  mmap.addOverlay(polyline);

  // turn on line drawing
  polyline.enableDrawing();


  // Mouseover the the poly line
  polyMouseoverListener = GEvent.addListener(polyline, "mouseover", function() {
    polymouseOver = true;
    polyline.enableEditing(); // edit points are shown
  });

  // Mouse Out for the poly line
  polyMouseoutListener = GEvent.addListener(polyline, "mouseout", function() {
    polymouseOver = false;
    polyline.disableEditing();
  });

  // Mouse Out for the poly line
  polyCancelineListener = GEvent.addListener(polyline, "cancelline", function() {
    if (polyline.getVertexCount() <= 1) {
      polyMissing = true;
    }

  });

  // this listener populates the textfield with the "output" coordinates variable.
  polyLineUpdatedListener = GEvent.addListener(polyline,"lineupdated",function(){
    var output = "";
    output = vertices2string(polyline);
    // write coordinates to the text area
    textarea.value = output;
  });
};

if ( polylineCoordinates ) {
  newPolyline(string2vertices(polylineCoordinates));
}
else {
  newPolyline();
}

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

// single left click on the map
GEvent.addListener(mmap, "click",function() {
  if (polyMissing) {
    polyMissing = false;
    newPolyline();
  }
});


// single right click on the map
GEvent.addListener(mmap, "singlerightclick",function(a,b,overlay) {
   // limit right click actions to the line.
   if(polymouseOver) {
    polyline.deleteVertex(overlay.index);
  }
});


function clearPoly() {
  mmap.removeOverlay(polyline);
  newPolyline();
};

//})() // end closure

//function is_array(value) {
//  return value &&
//    typeof value === 'object' &&
//    value.constructor === Array;
//}

