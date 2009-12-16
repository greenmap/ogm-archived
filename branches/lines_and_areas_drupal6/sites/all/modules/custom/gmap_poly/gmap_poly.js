var kmltest = '<?xml version="1.0" encoding="UTF-8"?>\n' +
        '<kml>\n' +
        '<Document>\n' +
        '<Placemark>' +
        '<name>Test</name>' +
        '<LineString>' +
        '<coordinates>' +
        '-74.00176048278809,40.724884598773755  -73.99309158325195,40.72085157020638  -73.99712562561035,40.71577741296778  -74.00588035583496,40.71779411151555\n' +
        '</coordinates>' +
        '</LineString>' +
        '</Placemark>' +
        '</Document>\n' +
        '</kml>\n';


// Declare a few div ids that will be used later
var MapDivId = Drupal.settings.gmap_poly_widget.mapDiv;
var MapCoordId = Drupal.settings.gmap_poly_widget.coorDiv;
var MapFieldId = Drupal.settings.gmap_poly_widget.fieldDiv;

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
var polyline = new GPolyline([
  new GLatLng(parseFloat(lat), parseFloat(lng)),
  new GLatLng(parseFloat(40.72085157020638), parseFloat(-73.99309158325195)),
  new GLatLng(parseFloat(40.728078), parseFloat(-74))
], "#000000", 5);

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

// var exml = new EGeoXml("exml", mmap, null);
// exml.parseString(kmltest);
