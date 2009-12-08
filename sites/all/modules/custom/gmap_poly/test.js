console.log('test');
var exml;

console.debug(Drupal.gmap);
     exml = new EGeoXml("exml", Drupal.Gmap2, null);

     var kmltest = '<?xml version="1.0" encoding="UTF-8"?>\n' +
             '<kml>\n' +
             '<Document>\n' +
             '<Placemark>\n' +
             '<Polygon>\n' +
             '<outerBoundaryIs>\n' +
             '<LinearRing>\n' +
             '<coordinates>\n' +
             '-74.00176048278809,40.724884598773755  -73.99309158325195,40.72085157020638  -73.99712562561035,40.71577741296778  -74.00588035583496,40.71779411151555\n' +
             '</coordinates>\n' +
             '</LinearRing>\n' +
             '</outerBoundaryIs>\n' +
             '</Polygon>\n' +
             '</Placemark>\n' +
             '</Document>\n' +
             '</kml>\n';
console.debug(kmltest);

exml.parseString(kmltest);

