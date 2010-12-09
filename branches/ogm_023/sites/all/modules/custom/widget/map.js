$(document).ready(function() {
	/*alert("sdfg");
	$('#gmap-view_gmap-gmap0').attr('width',123);
	$('#gmap-view_gmap-gmap0').attr('height',123);*/
});

Drupal.gmap.addHandler('gmap',function(elem) {
	
  var obj = this;
  var map = obj.map;

  // Respond to incoming zooms
 obj.bind("init",function() {
 	//alert(top);
	
 });
  GEvent.addListener(map, "zoomend", function(oldzoom,newzoom) {
	top.mapTransferZoom = newzoom;
  });
 



  // Send out outgoing moves
  GEvent.addListener(map,"moveend",function() {
  	var coord = map.getCenter();
	top.mapTransferLat = coord.lat();
	top.mapTransferLon = coord.lng();
  });


  // Send out outgoing map type changes.
  GEvent.addListener(map,"maptypechanged",function() {
  	var type = map.getCurrentMapType();
    if(type==G_NORMAL_MAP) top.mapTransferType = 'Map';
    if(type==G_HYBRID_MAP) top.mapTransferType = 'Hybrid';
    if(type==G_SATELLITE_MAP) top.mapTransferType = 'Satellite';
  });
});

