// this code is taken from the TextualZoomControl example

function InfoBubbleZoom() {}
InfoBubbleZoom.prototype = new GControl();
InfoBubbleZoom.prototype.initialize = function(map) {
	var container = document.createElement("div");
	container.id = 'infobubblezoom_container';
	// content goes here
	gInfoBubbleZoomInterval = setInterval(function() {
		try {
			container.innerHTML = '<div id="infobubblezoom_top"></div>';
			// get the number of total icons
			var count = GlobalObj.gm.countObjects();
			container.innerHTML += '<div id="infobubblezoom_middle"><div>'+count["total"]+' sites are shown, Zoom to view more.</div></div>';
			container.innerHTML += '<div id="infobubblezoom_bottom"></div>';
		} catch(e) {
			container.innerHTML = '<!-- Loading markers.. -->';
		}
		// we disable the refreshing after 10 seconds
		gInfoBubbleZoomCount++;
		if (gInfoBubbleZoomCount == 15) {
			clearInterval(gInfoBubbleZoomInterval);
			gInfoBubbleZoomInterval = undefined;
		}
	}, 1000);
	map.getContainer().appendChild(container);
	return container;
}
InfoBubbleZoom.prototype.getDefaultPosition = function() {
	// position goes here
	return new GControlPosition(G_ANCHOR_TOP_LEFT, new GSize(56, 57));
}


function InfoBubbleIcons() {}
InfoBubbleIcons.prototype = new GControl();
InfoBubbleIcons.prototype.initialize = function(map) {
	var container = document.createElement("div");
	container.id = 'infobubbleicons_container';
	// content goes here
	container.innerHTML = '<div id="infobubbleicons_top"></div>';
	container.innerHTML += '<div id="infobubbleicons_middle"><div>Use the Legend to filter the icons.</div></div>';
	container.innerHTML += '<div id="infobubbleicons_bottom"></div>';
	map.getContainer().appendChild(container);
	return container;
}
InfoBubbleIcons.prototype.getDefaultPosition = function() {
	// position goes here
	return new GControlPosition(G_ANCHOR_TOP_RIGHT, new GSize(4, 40));
}


// global variables

var gInfoBubbleIcons = null;
var gInfoBubbleZoom = null;
var gInfoBubbleZoomCount = 0;
var gInfoBubbleZoomInterval;


/**
 *	Cookie helper Code
 */

// HACKHACK: this is also defined as setCookie and getCookie in key.js, quick fix for now (gh)
// taken from http://www.w3schools.com/JS/js_cookies.asp, modified

function setCookie2(name, value, expires)
{
	var exdate = new Date();
	exdate.setDate(exdate.getDate()+expires);
	document.cookie = name+"="+escape(value)+((expires==null) ? "" : ";expires="+exdate.toGMTString());
}


function getCookie2(name)
{
	if (document.cookie.length > 0) {
		c_start = document.cookie.indexOf(name + "=");
		if (c_start != -1) {
			c_start = c_start + name.length+1;
			c_end=document.cookie.indexOf(";", c_start);
			if (c_end==-1)
				c_end=document.cookie.length;
			return unescape(document.cookie.substring(c_start, c_end));
		}
	}
	return null;
}




// gmap handler

Drupal.gmap.addHandler('gmap', function(elem) {
	var obj = this;
	var map;
	
	obj.bind("init",function() {
  		map = obj.map;
		
		// create the bubble on load
		// if (getCookie2("seen_infobubblezoom") == null) {
			gInfoBubbleZoom = new InfoBubbleZoom();
			map.addControl(gInfoBubbleZoom);
		//	setCookie2("seen_infobubblezoom", "1", 30);
		// }
	

		GEvent.addListener(map, "zoomend", function(oldzoom, newzoom) {
			// remove it on zoom
			if (gInfoBubbleZoom) {
				map.removeControl(gInfoBubbleZoom);
				clearInterval(gInfoBubbleZoomInterval);
				gInfoBubbleZoomInterval = undefined;
			}
		});
  	});

});
