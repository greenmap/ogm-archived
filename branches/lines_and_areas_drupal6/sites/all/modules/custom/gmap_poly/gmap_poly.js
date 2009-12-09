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

var mmap=new GMap2(document.getElementById("gmap_poly_map"));

// hard code a nyc zoom for now
var lat = "40.728078";
var lng = "-73.997040";
var zoom = "14";

// mmap.setCenter(new GLatLng(lat,lng),zoom);

    mmap.setCenter(new GLatLng(40.728078,-73.997040),14);
    mmap.addControl(new GLargeMapControl());
    mmap.addControl(new GMapTypeControl());

    var exml = new EGeoXml("exml", mmap, null);
    exml.parseString(kmltest);
