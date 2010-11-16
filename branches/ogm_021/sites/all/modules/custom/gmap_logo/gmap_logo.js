// this code is taken from the TextualZoomControl example

function LogoControl() {}

LogoControl.prototype = new GControl();

LogoControl.prototype.initialize = function(map) {
	var container = document.createElement("div");
	// content goes here
	container.innerHTML = '<a href="http://www.greenmap.org/"><img src="'+Drupal_base_path+'sites/all/modules/custom/gmap_logo/logo.png" alt="" title="' + Drupal.t('Green Map System') + '"></a>';
	container.style.width = '90px';		// set container width explicitly
	map.getContainer().appendChild(container);
	return container;
}

LogoControl.prototype.getDefaultPosition = function() {
	// position goes here
	return new GControlPosition(G_ANCHOR_BOTTOM_LEFT, new GSize(-7, 35));
}



// gmap handler

Drupal.gmap.addHandler('gmap', function(elem) {
	var obj = this;
	
	obj.bind("init",function() {
		var map = obj.map;
		map.addControl(new LogoControl());
  	});

	// we don't use this here
	// GEvent.addListener(map, "zoomend", function(oldzoom, newzoom) {
	//	alert("zoom level: " + newzoom);
	//});
});
