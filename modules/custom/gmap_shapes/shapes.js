/*********************************************************************\
*                                                                     *
* egeoxml.js                                         by Mike Williams *
*                                                                     *
* A Google Maps API Extension                                         *
*                                                                     *
* Renders the contents of a My Maps (or similar) KML file             *
*                                                                     *
* Documentation: http://econym.googlepages.com/egeoxml.htm            * 
*                                                                     *
***********************************************************************
*                                                                     *
*   This Javascript is provided by Mike Williams                      *
*   Blackpool Community Church Javascript Team                        *
*   http://www.commchurch.freeserve.co.uk/                            *
*   http://econym.googlepages.com/index.htm                           *
*                                                                     *
*   This work is licenced under a Creative Commons Licence            *
*   http://creativecommons.org/licenses/by/2.0/uk/                    *
*                                                                     *
\*********************************************************************/

/**
 * KMLParser
 * @param GMap map
 * @param String doc
 * This function parses a document given and creates new polygon to a map.
 */
KMLParser = function(map,doc) {
	
    var xmlDoc = GXml.parse(doc);
	
    // Read through the Placemarks
    var placemarks = xmlDoc.documentElement.getElementsByTagName("Placemark");
    for (var i = 0; i < placemarks.length; i++) {
		
      var coords=GXml.value(placemarks[i].getElementsByTagName("coordinates")[0]);
      coords=coords.replace(/\s+/g," "); // tidy the whitespace
      coords=coords.replace(/^ /,"");    // remove possible leading whitespace
      coords=coords.replace(/ $/,"");    // remove possible trailing whitespace
      coords=coords.replace(/, /,",");   // tidy the commas
      var path = coords.split(" ");

      // Is this a polyline/polygon?
      if (path.length > 1) {
        // Build the list of points
        var points = [];
        var pbounds = new GLatLngBounds();
		
        for (var p=0; p<path.length; p++) {
          var bits = path[p].split(",");
          var point = new GLatLng(parseFloat(bits[1]),parseFloat(bits[0]));
          points.push(point);
        }
        var linestring=placemarks[i].getElementsByTagName("LineString");
        if (linestring.length) {
          // this is a functionality for lines
          //clearPoly(map);
          newEmptyLine(map,points);
        }

        var polygons=placemarks[i].getElementsByTagName("Polygon");
        if (polygons.length) {
          //clearPoly(map);
          newEmptyPoly(map,points);
        }


      } else {
	  	// all other cases are useless for us
		return false;
      }
    }
}

var poly;
var polyMouseoverListener;
var polyMouseoutListener;
var polyLineUpdatedListener;
var polymouseOver = false;
var textfield_id = "gmap_shapes_textfield";
var polyMap;

/**
 * jQuery
 * This function add onChange listener to our KML textfield
 */
$(document).ready(function() {
	$('#'+textfield_id).change(function() {
		//$(this).attr('value');
		KMLParser(polyMap,$(this).attr('value'));
	});
});

/**
 * clearPoly
 * @param GMap map
 * This function clears the poly object
 */
clearPoly = function(map) {
	poly.disableEditing();
	polymouseOver = false;
	map.removeOverlay(poly);
	GEvent.removeListener(polyMouseoverListener);
	GEvent.removeListener(polyMouseoutListener);
	GEvent.removeListener(polyLineUpdatedListener);
	poly = undefined;
}

/**
 * newEmptyPoly
 * @param GMap map
 * @param Array points (not required)
 * return GPolygon
 * Creates a polygon with a listeners and stuff
 */
newEmptyPoly = function(map,points){
	// there has to be at least three points (starting point must be the first and the last point of the queue)
	if(points && points.length >= 4){
		var latlngs = points;
	}else {
		var latlngs = [];	
	}
	poly = new GPolygon();
  poly.enableEditing();
  
	map.addOverlay(poly);
	if(latlngs.length < 4){
		poly.enableDrawing();	
	}
	
	polyMouseoverListener = GEvent.addListener(poly, "mouseover", function() {
		polymouseOver = true;
		poly.enableEditing(); // edit points are shown
	});
	
	polyMouseoutListener = GEvent.addListener(poly, "mouseout", function() {
		polymouseOver = false;
		poly.disableEditing(); // editpoints are hided
	});
	
	// this listener creates KML data to the textfield
	polyLineUpdatedListener = GEvent.addListener(poly,"lineupdated",function(){
		var doc = document.getElementById(textfield_id);
		if(doc != undefined){
			var output = '';
			for(var i = 0; i < poly.getVertexCount();i++){
				var tmp = "";
				tmp += poly.getVertex(i);
				tmp = tmp.replace("(","");
				tmp = tmp.replace(")","");
				var tmpLatLng = tmp.split(",");
				
				if(output != ""){output += " ";}
				output += tmpLatLng[1] + "," + tmpLatLng[0];
			}
			doc.value  = '<?xml version="1.0" encoding="UTF-8"?>\n' +
						 '<kml>\n' +
						 '<Document>\n' +
						 '<Placemark>\n' +
						 '<Polygon>\n' +
						 '<outerBoundaryIs>\n' +
						 '<LinearRing>\n' +
						 '<coordinates>\n';
			doc.value += output;
			doc.value += '</coordinates>\n' +
						 '</LinearRing>\n' +
						 '</outerBoundaryIs>\n' +
						 '</Polygon>\n' +
						 '</Placemark>\n' +
						 '</Document>\n' +
						 '</kml>\n';
		} else {
			// error ? what should we do ?
      console.log('error on line 174 of shapes.js');
		}
	});
	return poly;
}



/**
 * newEmptyLine
 * @param GMap map
 * @param Array points (not required)
 * return GPolyline
 * Creates a polyline with a listeners and stuff
 */
newEmptyLine = function(map,points){
	// there has to be at least 2 points 
	if(points && points.length >= 3){
		var latlngs = points;
	}else {
		var latlngs = [];	
	}
	
  poly = new GPolyline(latlngs);
	map.addOverlay(poly);
  poly.enableEditing();
  
	if(latlngs.length < 3){
		poly.enableDrawing();	
	}
	
	polyMouseoverListener = GEvent.addListener(poly, "mouseover", function() {
		polymouseOver = true;
		poly.enableEditing(); // edit points are shown
	});
	
	polyMouseoutListener = GEvent.addListener(poly, "mouseout", function() {
		polymouseOver = false;
		poly.disableEditing(); // editpoints are hided
	});
	
	// this listener creates KML data to the textfield
	polyLineUpdatedListener = GEvent.addListener(poly,"lineupdated",function(){
		var doc = document.getElementById(textfield_id);
		if(doc != undefined){
			var output = '';
			
			for(var i = 0; i < poly.getVertexCount();i++){
				var tmp = "";
				tmp += poly.getVertex(i);
				tmp = tmp.replace("(","");
				tmp = tmp.replace(")","");
				var tmpLatLng = tmp.split(",");
				
				if(output != ""){output += " ";}
				output += tmpLatLng[1] + "," + tmpLatLng[0];
			}
			doc.value  = '<?xml version="1.0" encoding="UTF-8"?>\n' +
						 '<kml>\n' +
						 '<Document>\n' +
						 '<Placemark>\n' +
						 '<LineString>\n' +
						 '<coordinates>\n';
			doc.value += output;
			doc.value += '</coordinates>\n' +
						 '</LineString>\n' +
						 '</Placemark>\n' +
						 '</Document>\n' +
						 '</kml>\n';
		} else {
			// error ? what should we do ?
		}
	});
	return poly;
}



$(document).ready(function() {
  Drupal.gmap.addHandler('gmap',function(elem) {
  	
    var obj = this;
    var map;

    obj.bind("init",function() {
    	map = obj.map;
      var lat = Drupal.settings.gmap_shapes.lat;
      var lng = Drupal.settings.gmap_shapes.lng;
      var zoom = Drupal.settings.gmap_shapes.zoom;
      zoom = parseInt(zoom);
      var center = new GLatLng(lat,lng)
      map.setCenter(center, zoom);
  	polyMap = map;
    // create a new empty poly or line depending on whats set
    if(poly_type == 'line'){
      newEmptyLine(map);
    } else if(poly_type == 'area') {
      newEmptyPoly(map);
    }
  	
  	// clear all click listeners because we need only oru own listeners not enyone elses'
  	GEvent.clearListeners(map,  "click");
  	
  	var doc = document.getElementById(textfield_id);
  	// we test if textfield is allready valid kml
  	// so this is "the load functionality"
  	KMLParser(map,doc.value);
  	
  	GEvent.addListener(map, "click", function(marker,point) {
  	});
  	
  	GEvent.addListener(map, "singlerightclick", function(a,b,overlay) {
  		if(polymouseOver){
  			var mouseLatLng = map.getCurrentMapType().getProjection().fromPixelToLatLng(a,map.getZoom());
  			// var command = prompt("what do you want to do?",'deletepoint'); // could do similar action to give options
        if(overlay.index != undefined){
  				poly.deleteVertex(overlay.index);
  			}
  			
  			switch(command){
  				case 'deletepoint':
  				
  				if(overlay.index != undefined){
  					poly.deleteVertex(overlay.index);
  				}
  				
  				break;
  				case 'delete':
  					clearPoly(map);
  					document.getElementById(textfield_id).value = "";
  					newEmptyPoly(map);
  				break;
  				default:
  				break;
  			}
  		}		
  	});
  	
  	GEvent.addListener(map, "zoomend", function(oldzoom,newzoom) {
  	});
   
    	// Send out outgoing moves
  	GEvent.addListener(map,"moveend",function() {
  	});

  	// Send out outgoing map type changes.
  	GEvent.addListener(map,"maptypechanged",function() {
  	});
    });
   
  });
});