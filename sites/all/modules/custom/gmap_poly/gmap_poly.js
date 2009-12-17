// Declare a few div ids that will be used later
// TODO: Figure out a way to loop this for fields with multiple values
var MapDivId = Drupal.settings.gmap_poly_widget_0.mapDiv;
var MapCoordId = Drupal.settings.gmap_poly_widget_0.coorDiv;
var MapFieldId = Drupal.settings.gmap_poly_widget_0.fieldDiv;

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
// hard code a nyc zoom for testing.
//mmap.setCenter(new GLatLng(parseFloat(40.728078),parseFloat(-73.997040)),15);

// add map controls
mmap.addControl(new GLargeMapControl());
mmap.addControl(new GMapTypeControl());

//define the line
var polyline = new GPolyline([], "#000000", 5);

// add the line to the map
mmap.addOverlay(polyline);

// turn on line drawing
polyline.enableDrawing();

// this listener populates the textfield with the "output" coordinates variable.
polyLineUpdatedListener = GEvent.addListener(polyline,"lineupdated",function(){
  var output = "";

  // loop through the line vertices to grab and strip out the lat/lng coordinates
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

  // name the textarea
  var textarea = document.getElementById(MapFieldId);

  // write coordinates to the text area
  textarea.value = output;
});

// Mouseover the the poly line
polyMouseoverListener = GEvent.addListener(polyline, "mouseover", function() {
  polymouseOver = true;
  polyline.enableEditing(); // edit points are shown
});

// Mouse Out for the poly line
polyMouseoutListener = GEvent.addListener(polyline, "mouseout", function() {
 polymouseOver = false;
 polyline.disableEditing(); // editpoints are hided
});

// single right click on the map
GEvent.addListener(mmap, "singlerightclick",function(a,b,overlay) {
   // limit right click actions to the line.
   if(polymouseOver) {
    polyline.deleteVertex(overlay.index);
  }
});
