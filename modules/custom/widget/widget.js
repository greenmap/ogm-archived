/**
 * @author Lammela
 */

var mapTransferLat = '';
var mapTransferLon = '';
var mapTransferZoom = '';
var mapTransferType = '';
var MapInterval = 
window.setInterval(
	function(){
		if(	(mapTransferLat == '')  &&
			(mapTransferLon == '')  &&
			(mapTransferZoom == '') &&
			(mapTransferType == '')) {return;}
			// every time when updated, we empty values
		
		if(mapTransferLat != ''){
			document.getElementById('lat').value = mapTransferLat;
			mapTransferLat = '';
		}
		if(mapTransferLon != ''){
			document.getElementById('lon').value = mapTransferLon;
			mapTransferLon = '';
		}
		if(mapTransferZoom != ''){
		  	document.getElementById('zoom').selectedIndex = mapTransferZoom;
			mapTransferZoom = '';
		}
		if(mapTransferType != ''){
			var opt = document.getElementById('maptype').options;
			var index = 0;
			for (var i in opt) {
				if(opt[i].value == mapTransferType){
					index = i;
					break;
				}
			}
			//alert(document.getElementById('maptype').selectedIndex);
			document.getElementById('maptype').selectedIndex = index;
			mapTransferType = '';
		}
		
		var doc = document.getElementById('mapname');
		var nid = doc.options[doc.selectedIndex].value;
		// update html
		var html = Drupal.getIFrame(nid);
		// html
		document.getElementById('html').value = html;
	}
,1000); 

window.onUnload = function(evt){
	window.clearInterval(MapInterval);
}

Drupal.onMapChange = function(id){

	
	var doc = document.getElementById(id);
	var nid = doc.options[doc.selectedIndex].value;
	if(nid == ''){return;}
	document.getElementById('DIVview').innerHTML = 'Loading';
	Drupal.makeRequest(Drupal_base_path + 'node/widget/onmapchange/'+nid,'',"onMapChangeReturn",nid);
}
Drupal.onMapChangeReturn = function(http_request,returnArgs) {
	//document.getElementById('DIV'+returnArgs.attributes.getNamedItem('name').value).innerHTML = http_request.responseText;

	if (http_request.responseText == '') {return;}
	// var lat,var lon,var zoom,var type
	eval(http_request.responseText);
	//alert(lat + " " + lon);
	
	if(!lat || !lon || !zoom || !type){return;}
	// lat
	document.getElementById('lat').value = lat;
	// lon
	document.getElementById('lon').value = lon;
	// zoom
	document.getElementById('zoom').selectedIndex = zoom;
	// maptype
	document.getElementById('maptype').value = type;

	Drupal.onChange();
	
	var id = 'fieldset_map_settings';
	Drupal.openFieldset(id);
	var id = 'fieldset_html_codes';
	Drupal.openFieldset(id);
	var id = 'fieldset_map_view';
	Drupal.openFieldset(id);
}
Drupal.openFieldset = function(id){
	var array = Drupal.listAllClasses(document.getElementById(id));
	//if (array.inArray('collapsed')) {
	
	var classes = '';
	for (var i =0; i < array.length; i++) {
		if(array[i] != 'collapsed'){
			classes += ' ' + array[i];
		}
	}
	document.getElementById(id).className = classes;
}
Drupal.listAllClasses = function(item){
	return item.className.split(" ");
}
Drupal.onChange = function(){
	var doc = document.getElementById('mapname');
	var nid = doc.options[doc.selectedIndex].value;
	// update html & view	
	var html = Drupal.getIFrame(nid);
	// html
	document.getElementById('html').value = html;
	// view
	//var html = Drupal.getIFrame(nid, true); // TT - this was causing problems - however removing 2nd argument (view=true) prevents updating the widget by dragging the map. Should fix sometime
	var html = Drupal.getIFrame(nid);
	document.getElementById('DIVview').innerHTML = html;
}

Drupal.getIFrame = function(nid, view){
	
	//var doc = document.getElementById(id);
	//var nid = doc.options[doc.selectedIndex].value;
	var width = document.getElementById('width').value;
	var height = document.getElementById('height').value;
	var domain = Drupal.getDomain();
	var args = '';
	if(view){
	  args += '?view=true';
	}
	var premark = '?';
	if(document.getElementById('lat').value != ''){
		if(args != ''){premark = '&'}
		args += premark+"LAT="+document.getElementById('lat').value;
	}
	if (document.getElementById('lon').value != '') {
		if (args != '') {premark = '&';}
		args += premark+"LON=" + document.getElementById('lon').value;
	}
	if (document.getElementById('zoom').value != '') {
		if (args != '') {premark = '&';}
		args += premark+"ZOOM=" + document.getElementById('zoom').options[document.getElementById('zoom').selectedIndex].value;
	}
	if (document.getElementById('maptype').value != '') {
		if (args != '') {premark = '&';}
		args += premark+"TYPE=" + document.getElementById('maptype').options[document.getElementById('maptype').selectedIndex].value;
	}
	var src = domain + Drupal_base_path + "greenmap_widget/" + nid + args;
	var html = "<iframe width='"+width+"' height='"+height+"' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src='"+src+"'></iframe>";
	return html;
}
Drupal.getDomain = function(){
	var lo = location.href;
	var tmp = lo.split("/");
	for(var i = tmp.length;i > 3;i--){
	tmp.pop();	
	}
	lo = tmp.join("/");
	return lo;
}



/*var m = Drupal.gmap.getMap('loc1'); // Replace locmap with the map's id that you want
m.vars.latitude = 60.459926;
m.vars.longitude = 22.27478;
m.vars.zoom = 9;
m.change('move',-1); 
*/




