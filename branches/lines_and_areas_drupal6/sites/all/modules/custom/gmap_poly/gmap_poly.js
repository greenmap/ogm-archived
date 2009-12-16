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

var mmap=new GMap2(document.getElementById("gmap_poly_map_widget"));

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

mmap.addControl(new GLargeMapControl());
mmap.addControl(new GMapTypeControl());

var polyline = new GPolyline([
  new GLatLng(parseFloat(lat), parseFloat(lng)),
  new GLatLng(parseFloat(40.72085157020638), parseFloat(-73.99309158325195)),
  new GLatLng(parseFloat(40.728078), parseFloat(-74))
], "#000000", 10);


mmap.addOverlay(polyline);
polyline.enableDrawing();


// var exml = new EGeoXml("exml", mmap, null);
// exml.parseString(kmltest);
