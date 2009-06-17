/**
 * @author Miikka Lammela
 */
var GlobalMap;
var GlobalElement;
var GlobalObj;
var storage = new Array();
var zoomOnOff = false;
var objects = new Array();
var breakpoint = 10;
var geocoder = new GClientGeocoder();

/* jQuery */
$(document).ready(function() {
	// collapse all

	$('#location_search_button').click(function(){
//		alert($('#location_search').attr('value'));
		showLocations($('#location_search').attr('value'))
		return false;
	});
	$('#location_search').click(function() {
		if($(this).attr('value') == 'Address / City'){
			$(this).attr('value','');
		}
	});
});

function isset(varname){
  try{
  	if(varname === null) return false;
	if(varname === undefined) return false;
  	return true;	
  }catch(e){}
  return false;
}

function showLocations(address){
	var obj = GlobalObj;
  	var map = GlobalObj.map;
	//	alert("show locations. " + value);
	geocoder.getLocations(address,function(response) {

		if (response.Status.code==G_GEO_SUCCESS){
			var places = response.Placemark;
			 
			if (places.length == 0) {
				// not found
				alert("not found1");
			}else if(places.length == 1){
				// only one
				var point = new GLatLng(places[0].Point.coordinates[1],places[0].Point.coordinates[0]);
				map.setCenter(point, 13); // , 13
				//alert(places[0].AddressDetails.Accuracy);
			}else {
				// or multile	
				var addresses ='<ul>';
				for (var p in places) {
					addresses += "<li><a href='#' class='address_option' name='"+places[p].address+"' >" + places[p].address + "</a></li>\n";
				}
				addresses +='</ul>';
				document.getElementById('address_options').innerHTML = addresses;
				$('.address_option').click(function(){
					showLocations($(this).attr('name'));
					return false;
				});
			
			}
			
		}else {
			// not found
		//	alert("not found2");
		}
	});
	return false;
}
function showAddress(address) {
  var obj = GlobalObj;
  var map = GlobalObj.map;
  geocoder.getLatLng(
    address,
    function(point) {
      if (!point) {
        alert(address + " not found");
      } else {
        map.setCenter(point, 13);
     /*   var object = new GMarker(point);
        map.addOverlay(object);
        object.openInfoWindowHtml(address);*/
      }
    }
  );
}

// This function takes in the string containing marker data that comes from the ajax request

onMapChange = function(http_request,returnArgs) {
	
	var obj = GlobalObj;
	if (http_request.responseText == '') {return;}

	var data = http_request.responseText;
	data = data.split("%%");
	var minZoom = data[0];
	
	// we add all objects to the same layer addLayer(name,minzoom,?maxzoom)
	var layer = obj.gm.AddLayer ( minZoom,minZoom);
	var lines = data[1].split(/\n/);
	if(lines.length <= 0){return;}
	

	var objectData = [];
//	for(var i =0; i< 2;i++) {
	for(var i =0; i< lines.length;i++) {
	  if(lines[i] == ''){continue;}
	  var tmp = [];

	  var line = lines[i].split("*");
	  var nid = line[0];
	  var lat =line[1];
	  var lon = line[2];

	  var opts =line[3];
	  var grps = line[5];
	    
	  tmp['object'] = createMarker(new GLatLng(lat, lon), opts,nid);
	  // set up layer
	  tmp['layer'] = layer;
	  
	  // set up groups
	  var groups = [];
	  
	  
//	  var gr =grps.split(/^([^:]+)[:]([^:]+)[:](.+)$/);
	  var gr = grps.split(":");
	  for (var g in gr) {
		  if(gr[g] == ''){continue;}
		  var group = obj.gm.AddGroup(trim(gr[g]));
		  
		  if(isset(key_states[group.getName()])){
		  	
		  	group.setVisibility(key_states[trim(gr[g])]);
		  }
		  groups.push(group);
	  }
	  
	  tmp['groups'] = groups;
		
	  //add to array
	  objectData.push(tmp);
	}
	// add objects to the queue
	obj.gm.AddObjects(objectData);
}


// TT - new function to handle ajax data for poly lines & shapes
onMapChangePoly = function(http_requestZoom,returnArgs) {
	
	var obj = GlobalObj;
	if (http_requestZoom.responseText == '') {return;}

	var data = http_requestZoom.responseText;
	data = data.split("%%");
	var minZoom = data[0];
	
	// we add all objects to the same layer addLayer(name,minzoom,?maxzoom)
	var layer = obj.gm.AddLayer ( minZoom,minZoom);
	var lines = data[1].split(/\n/);
	if(lines.length <= 0){return;}
	

	var objectData = [];
//	for(var i =0; i< 2;i++) {
	for(var i =0; i< lines.length;i++) {
	  if(lines[i] == ''){continue;}
	  var tmp = [];

	  var line = lines[i].split("*");
	  var nid = line[0];
	  var poly = line[1];
    var type =line[2];
	  var color = line[3];
    var opacity = line[4];
	  var title =line[5];
	  var grps = line[7];
	    
    // ****** Fix for type of polygon on polyline based on type
	  tmp['object'] = createPoly(poly,color,opacity,nid);
	  // set up layer
	  tmp['layer'] = layer;
	  
	  // set up groups
    
	  var groups = [];
	  
	  
//	  var gr =grps.split(/^([^:]+)[:]([^:]+)[:](.+)$/);
	  var gr = grps.split(":");
	  for (var g in gr) {
		  if(gr[g] == ''){continue;}
		  var group = obj.gm.AddGroup(trim(gr[g]));
		  
		  if(isset(key_states[group.getName()])){
		  	
		  	group.setVisibility(key_states[trim(gr[g])]);
		  }
		  groups.push(group);
	  }
	  
	  tmp['groups'] = groups;
		
	  //add to array
	  objectData.push(tmp);
	}
	// add objects to the queue
	obj.gm.AddObjects(objectData);
}


function clearExtras(obj) {
	//var obj = GlobalObj;
	var b = obj.gm.getBounds();
	
//	alert(post);
	var objects = obj.gm.getObjects();
	var nids = [];
	for (var m in objects) {
		var object = objects[m];
		if (b.contains(object.getPoint())) {continue;}
		nids.push(object.getId());
		
		// let's delete object if not inside bounds
		obj.gm.RemoveObject(object);
	}
	var args = '';
	for (var n in nids) {
		prefix = '';
		if(args != ''){
			prefix = '&';
		}
		args += prefix + 'nids[]='+ nids[n];
	}
	//alert(args);
	var http_requestZoom = Drupal.makeReq(Drupal_base_path + 'node/gmap_marker/clearnids',args);
		http_requestZoom.onreadystatechange = function() {
			if (http_requestZoom.readyState != 4) {return;}
			if (http_requestZoom.status == 200) {// success
			} else {// failed
				alert('Problems with the ajax' );
			}
		};
	
//	bounds.contains(object.getPoint())
}
function randObjects(){
	var obj = GlobalObj;
	var objects = obj.gm.getObjects();
	alert(objects.length);
}

var maxContentDiv;


function createMarker(point, opts,nid) {

  var opt = {};
  eval(opts); // puts all options to opt-object
  var object = new GMarker(point,opt);
  object.value = nid;
  object.setId(nid);
  
  GEvent.addListener(object, "click", function() {
	
  	var html = Drupal.makeReq(Drupal_base_path + 'node/gmap_marker/getMiniBubble/' + nid,'');
	
	html.onreadystatechange = function() {
   		if (html.readyState != 4) {return;}
		if (html.status == 200) {// success
			maxContentDiv = document.createElement('div');
				// somewhere in here is a problem which results in two <html> tags
				maxContentDiv.id = 'maxcontentdiv';
				maxContentDiv.innerHTML = '<iframe frameborder="0" src="' + Drupal_base_path + 'node/' + nid + '/simple" width="670" height="360"></iframe>';
				GlobalMap.openInfoWindowHtml(point, html.responseText,
				{maxContent: maxContentDiv,
				maxTitle: ''});

				// java script code for the stars rating
				// jQuery(function(){jQuery('input.fivestar-submit').hide();});
				// jQuery(function(){jQuery('form.fivestar-widget').rating();}); // removing for now - not working in Webkit-based sites - chrome & safari - breaks other stuff too
				jQuery(function(){
					jQuery('.maximize').click(function() {
						var rel = jQuery(this).attr('rel');
						// maxContentDiv.firstChild.src = Drupal_base_path + 'node/'+nid+'/simple#tabs-tabs-' + rel; // removing for now - not working in Webkit-based sites - chrome & safari - breaks other stuff too
						GlobalMap.getInfoWindow().maximize();
					})
				});
	  	} else {
	        	alert('Problems with the ajax: 228');
		}
    };
    
  });
  return object;
}

// create a poly on the map
function createPoly(poly, color, opacity, nid) {
  // var opt = {};
  // eval(opts); // puts all options to opt-object
  
  // poly contains points - each pair separated by a comma, each lat/lng separated by space but the wrong way round
  points = poly.split(",");
  var pointsnew = [];
  for(var i =0; i< points.length;i++) {
	  if(points[i] == ''){continue;}

	  var point = points[i].split(" ");
	  var lat = point[1];
	  var lon = point[0];
    pointsnew[pointsnew.length] = new GLatLng(lat,lon);
    
  }  
  
  //GPolygon(points, color, weight, opacity, fill color, fill opacity)
  var object = new GPolygon(pointsnew,color,2,opacity);
  
  //var test = dumpObj(object, 'shouldbepoly', 1, 19);
  //alert(test); 
  
  object.value = nid;
  object.setId(nid);
  
  // ************** NEED TO ADD BACK IN SOME KIND OF EVENT ON CLICKING A POLY
  
  GEvent.addListener(object, "click", function(latlng) {
	
  	var html = Drupal.makeReq(Drupal_base_path + 'node/gmap_marker/getMiniBubble/' + nid,'');
	
  	html.onreadystatechange = function() {
     	if (html.readyState != 4) {return;}
  		if (html.status == 200) {// success
  			maxContentDiv = document.createElement('div');
        // somewhere in here is a problem which results in two <html> tags
        maxContentDiv.id = 'maxcontentdiv';
        maxContentDiv.innerHTML = '<iframe frameborder="0" src="' + Drupal_base_path + 'node/' + nid + '/simple" width="670" height="360"></iframe>';
        GlobalMap.openInfoWindowHtml(latlng, html.responseText,
        {maxContent: maxContentDiv,
        maxTitle: ''});

        // java script code for the stars rating
        // jQuery(function(){jQuery('input.fivestar-submit').hide();});
        // jQuery(function(){jQuery('form.fivestar-widget').rating();}); // removing for now - not working in Webkit-based sites - chrome & safari - breaks other stuff too
        jQuery(function(){
          jQuery('.maximize').click(function() {
            var rel = jQuery(this).attr('rel');
            // maxContentDiv.firstChild.src = Drupal_base_path + 'node/'+nid+'/simple#tabs-tabs-' + rel; // removing for now - not working in Webkit-based sites - chrome & safari - breaks other stuff too
            GlobalMap.getInfoWindow().maximize();
          })
        });
  	  } else {
  	        	alert('Problems with the ajax: 228');
  		}
    };
    
  }); // */
  return object; 
}

function clearMap(gm){
	
	var layers = gm.getLayers();
	// remove all layers (including objects)
	for(var l = (layers.length -1);l >= 0; l--){
		gm.RemoveLayer(layers[l]);					
	}
}



function mapNodeLoad(object) {
	var obj = (object)?object:GlobalObj;
	
	var bounds = obj.gm.getBounds();
	var sw = bounds.getSouthWest();
    var ne = bounds.getNorthEast();
   	var dx = ne.lng() - sw.lng();
    var dy = ne.lat() - sw.lat();
	// we set zoom to 1 because we don't want to hide those objects when zooming out
	var post = "lat="+sw.lat()+"&lon="+sw.lng()+"&dx="+dx+"&dy="+dy+"&zoom=1&limit=300";
	if (mapNid) {
		post += "&nid="+mapNid;
	}
	//alert(post);
  // load the markers
	var http_requestZoom = Drupal.makeReq(Drupal_base_path + 'node/gmap_marker/onmapchange/zoom',post);
  http_requestZoom.onreadystatechange = function() {
    if (http_requestZoom.readyState != 4) {return;}
    if (http_requestZoom.status == 200) {// success
      onMapChange(http_requestZoom);
    } else {// failed
      alert('Problems with the ajax');
    }
  };
  // now load the poly
  var http_requestZoomPoly = Drupal.makeReq(Drupal_base_path + 'node/gmap_marker/getshapes/zoom',post); // calls function gmap_marker_getShapes()  and then onMapChange_polyQuery() in .module
  http_requestZoomPoly.onreadystatechange = function() {
    if (http_requestZoomPoly.readyState != 4) {return;}
    if (http_requestZoomPoly.status == 200) {// success
      onMapChangePoly(http_requestZoomPoly);
    } else {// failed
      alert('Problems with the ajax: error T01');
    }
  };
}
function globalViewNodeLoad() {

	var obj = GlobalObj;
	
	
	var http_request = Drupal.makeReq(Drupal_base_path + 'node/gmap_marker/onmapchange/0','');
		http_request.onreadystatechange = function() {
			if (http_request.readyState != 4) {return;}
			if (http_request.status == 200) {// success
				onMapChange(http_request);
			} else {// failed
				alert('Problems with the ajax');
			}
		};
	

	var bounds = obj.gm.getBounds();
	var sw = bounds.getSouthWest();
    var ne = bounds.getNorthEast();
   	var dx = ne.lng() - sw.lng();
    var dy = ne.lat() - sw.lat();
	
	var post = "lat="+sw.lat()+"&lon="+sw.lng()+"&dx="+dx+"&dy="+dy+"&zoom="+obj.gm.map.getZoom();
	//alert(post);
	var http_requestZoom = Drupal.makeReq(Drupal_base_path + 'node/gmap_marker/onmapchange/zoom',post);
		http_requestZoom.onreadystatechange = function() {
			if (http_requestZoom.readyState != 4) {return;}
			if (http_requestZoom.status == 200) {// success
				onMapChange(http_requestZoom);
			} else {// failed
				alert('Problems with the ajax');
			}
		};	


};

/**
 CUSTOM HANDLER
*/

Drupal.gmap.addHandler('gmap',function(elem) {
  	var obj = this;
  	var map;
  
	 obj.bind("init",function() { 
		    map = obj.map;
			obj.gm = new GGroups(obj.map);
			// CUSTOM
			GlobalElement = elem;
			GlobalMap = map;
			GlobalObj = obj;
			G_NORMAL_MAP.getMinimumResolution = function() {return 2;};
			// mapNid
			if(mapNid){
				mapNodeLoad(obj);
        // TODO: Add poly? *******************************
        
			} else {
				globalViewNodeLoad();
        // TODO: Add poly? *******************************
			}
  

  			// Send out outgoing zooms
			GEvent.addListener(map, "zoomend", function(oldzoom,newzoom) {
				//var obj = GlobalObj;
				//if (mapNid) {return;}

				try{
					if(oldzoom > newzoom){
						var layers = obj.gm.getLayers();
						var nids = [];
						for (var l in layers) {
							var layer = layers[l];
							if (layer.getMinZoom() <= (newzoom +1)) {continue;}
							nids = array_merge(nids,layer.getObjects());
							obj.gm.RemoveLayer(layer);
						//alert(layer.getMinZoom());
						}
			
						var args = '';
						for (var n in nids) {
							prefix = '';
							if(args != ''){
								prefix = '&';
							}
							args += prefix + 'nids[]='+ nids[n].getId();
						}
						//alert(args);
			
						var http_requestZoom = Drupal.makeReq(Drupal_base_path + 'node/gmap_marker/clearnids',args);
						http_requestZoom.onreadystatechange = function() {
							if (http_requestZoom.readyState != 4) {return;}
							if (http_requestZoom.status == 200) {// success
							} else {// failed
								alert('Problems with the ajax');
							}
						};
            // TODO: Clear poly? *******************************
					}
				}catch(e){}
				if(mapNid){
					try {
						mapNodeLoad();
            // TODO: Add poly? *******************************
					}catch(e){}
				}else if (newzoom <= 3 && oldzoom && !mapNid) {
					try {
						globalViewNodeLoad();
            // Don't really need to add poly here because we're so zoomed out
					}catch(e){}
				} else {

					try {
						var bounds = obj.gm.getBounds();
						var sw = bounds.getSouthWest();
						var ne = bounds.getNorthEast();
						var dx = ne.lng() - sw.lng();
						var dy = ne.lat() - sw.lat();
						
						var post = "lat=" + sw.lat() + "&lon=" + sw.lng() + "&dx=" + dx + "&dy=" + dy + "&zoom=" + obj.gm.map.getZoom();
						var http_requestZoom = Drupal.makeReq(Drupal_base_path + 'node/gmap_marker/onmapchange/zoom', post);
						http_requestZoom.onreadystatechange = function(){
							if (http_requestZoom.readyState != 4) {
								return;
							}
							if (http_requestZoom.status == 200) {// success
								onMapChange(http_requestZoom);
								clearExtras(obj);
							}
							else {// failed
								alert('Problems with the ajax');
							}
						};
					} 
					catch (e) {
					}
				}

				try{
					// check objects visibility
					obj.gm.zoomDisplay();
				}catch(e){}

				//	obj.change("zoom");
  			});

  

  			// Send out outgoing moves
			GEvent.addListener(map,"moveend",function() {
			// CUSTOM
	
				try{
					// zoomOnOff && 
		
					var bounds = obj.gm.bounds; // saved bounds 
					var sw = bounds.getSouthWest();
			    	var ne = bounds.getNorthEast();
	   				var dx = ne.lng() - sw.lng();
	 				var dy = ne.lat() - sw.lat();
	    			if ( dx < 300 && dy < 150 ) {
						dx *= 0.20;
						dy *= 0.20;
						bounds = new GLatLngBounds(
			  				new GLatLng( sw.lat() + dy, sw.lng() + dx ),
	  						new GLatLng( ne.lat() - dy, ne.lng() - dx ) 
						);
					}
					var mlat = obj.gm.map.getCenter().lat();
					var mlng = obj.gm.map.getCenter().lng();
					if (bounds.contains(obj.gm.map.getCenter())) {return;}
		
					//storage['lat'] = obj.vars.latitude;
					//storage['lon'] = obj.vars.longitude;
		
		
			
					if(mapNid){
						try{
							mapNodeLoad();	
						}catch(e){}
				
						//clearExtras(obj);
					} else {
						var bounds = obj.gm.getBounds();
						var sw = bounds.getSouthWest();
						var ne = bounds.getNorthEast();
						var dx = ne.lng() - sw.lng();
						var dy = ne.lat() - sw.lat();
						var post = "lat="+sw.lat()+"&lon="+sw.lng()+"&dx="+dx+"&dy="+dy+"&zoom="+obj.gm.map.getZoom();
						var http_requestZoom = Drupal.makeReq(Drupal_base_path + 'node/gmap_marker/onmapchange/zoom',post);
						http_requestZoom.onreadystatechange = function() {
							if (http_requestZoom.readyState != 4) {return;}
							if (http_requestZoom.status == 200) {// success
								onMapChange(http_requestZoom);
								clearExtras(obj);
							} else {// failed
								alert('Problems with the ajax');
							}
						};
					}
		
				}catch(e){}
	
				try{
					// check objects visibility
					obj.gm.zoomDisplay();
				}catch(e){}
	
  			}); 
 		});
  // Send out outgoing control type changes.
  // N/A
});

function array_merge(arr) {
	var merged = arr;
	for (var i = 1; i < arguments.length; i++) {
		merged = merged.concat(arguments[i]);
	}
	return merged;
}

trim = function (str) {
	str = str.replace(/^\s+/, '');
	for (var i = str.length - 1; i >= 0; i--) {
		if (/\S/.test(str.charAt(i))) {
			str = str.substring(0, i + 1);
			break;
		}
	}
	return str;
}
