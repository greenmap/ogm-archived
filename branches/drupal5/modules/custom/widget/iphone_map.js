/*
 Drupal.gmap.addHandler('gmap',function(elem) {
 
 var obj = this;
 var map = obj.map;
 // Respond to incoming zooms
 obj.bind("init",function() {
 //alert(top);
 
 map.removeMapType(G_HYBRID_MAP);
 map.removeMapType(G_SATELLITE_MAP);
 map.removeMapType(G_PHYSICAL_MAP);
 
 });
 });
 * /
/ * 	load, unload, resize, scroll, focus, blur, error, 
 mouseover, mouseout, mousemove, mouseup, mousedown,
 click, dblclick, folcus, blur, change, reset, submit,
 deydown, keyup, keypress* /
addEvent = function(el, eve, func){
    if (el == null) 
        return;
    try { // right way
        el.addEventListener(eve, func, false);
        return true;
    } 
    catch (e) {
    }
    try { // IE
        el.attachEvent("on" + eve, func);
        return true;
    } 
    catch (e) {
    }
    // when everyting fails
    info("Couldn't add event to the element.<br>" +
    " It is recomended to disable JavaScript on this page.<br>" +
    " Click following link to disable JavaScript <a href='?DISABLEJS=DISABLE'>disable</a>", 'error');
    return false;
};
removeEvent = function(el, event, func){
    el.removeEventListener(event, func, false);
    try { // right way
        el.removeEventListener(event, func, false);
        return true;
    } 
    catch (e) {
    }
    try { // IE
        el.detachEvent("on" + event, func);
        return true;
    } 
    catch (e) {
    }
    // when everyting fails
    info("Couldn't remove event from the element.", 'error');
    return false;
};

if (!GlobalMap) {
    var GlobalMap;
}
if(!GolbalElement){
	var GolbalElement;
}

Drupal.gmap.addHandler('gmap', function(elem){
    var obj = this;
	
    obj.bind("init", function(){
        var map = obj.map;
        if (!GlobalMap) {
            GlobalMap = map;
        }
		if(!GolbalElement){
			GolbalElement = elem;
		}
        map.removeMapType(G_HYBRID_MAP);
        map.removeMapType(G_SATELLITE_MAP);
        map.removeMapType(G_PHYSICAL_MAP);
        //alert(elem.id);
		map.setCenter(new GLatLng(60.630102,25.136719));
		
        
        addEventListener("load", function(){
            setTimeout(updateLayout, 0);
        }, false);
        setInterval(updateLayout, 400);
        
     //   setInterval(alertInt,15000);
        
        var element = elem; //document.getElementById('content');
        var start = [];
        var cur = [];
		
        element.addEventListener("touchstart", function(event){
            start[0] = event.touches[0].pageX;
            start[1] = event.touches[0].pageY;
			start[2] = event.touches[0].clientX;
            start[3] = event.touches[0].clientY;
            
        }, false);
        
        element.addEventListener("touchmove", function(event){
            event.preventDefault();

			
            if (event.targetTouches.length == 1) {
                var x = event.targetTouches[0].pageX;
                var y = event.targetTouches[0].pageY;
                cur[0] = x - start[0];
                cur[1] = y - start[1];
				var z = map.getZoom();
				var change = (1 / (1+ 10*z*z*z));
				
				var lat = testLatOrLon((obj.vars.latitude  + 2 * (change * cur[1])), 'latitude');
			// longitude -180 ... +180
            var lon = testLatOrLon((obj.vars.longitude - 4 * (change * cur[0])), 'longitude');
		//	log += "\n" + lat + " " + lon;
            map.panTo(new GLatLng(lat, lon));
			if(z >= 15) {
				start[0] = x;
				start[1] = y;
				
			}
				
/ *				
				cur[2] = event.targetTouches[0].clientX;
				cur[3] = event.targetTouches[0].clientY;* /
            }
            else {
                cur[0] = null;
                cur[1] = null;
				cur[2] = null;
				cur[3] = null;
            }
            
        }, false);
        
        element.addEventListener("touchend", function(event){
            //event.preventDefault();
            if (cur[0] == null && cur[1] == null) 
                return;
/ *			alert(
			cur[0] +  " vrt " + cur[2] + "\n" + 
			cur[1] +  " vrt " + cur[3] + "\n" +
			start[0] +  " vrt " + start[2] + "\n"+
			start[1] +  " vrt " + start[3] + "\n"
			);
            var change = (1 / (1+ 10*map.getZoom()));
 
 
			// latitude -90 ... +90
			var lat = testLatOrLon((obj.vars.latitude  + 2 * (change * cur[1])), 'latitude');
			// longitude -180 ... +180
            var lon = testLatOrLon((obj.vars.longitude - 4 * (change * cur[0])), 'longitude');
		//	log += "\n" + lat + " " + lon;
            map.panTo(new GLatLng(lat, lon));
* /
			cur = [];
			start = [];

            
            
            //			map.setCenter(new GLatLng(cur,obj.vars.longitude));
        
        
            //		map.panTo();
        }, false);
        
        element.addEventListener("touchcancel", function(event){
        }, false);
        
        element.addEventListener("gesturechange", function(event){
            //event.target //the target node 
        
        }, false);
        
        element.addEventListener("gestureend", function(event){
            //event.scale
            //event.rotation
            cur = [];
			start = [];
            
            
            if (event.scale < 1 && event.scale != 0) {
                var tmp = event.scale * 100;
                if (tmp > 50) {
                    map.setZoom(map.getZoom() - 4);
                }
                else 
                    if (tmp > 25) {
                        map.setZoom(map.getZoom() - 2);
                    }
                    else {
                        map.setZoom(map.getZoom() - 1);
                    }
            }
            
            if (event.scale >= 1) {
                var tmp = event.scale * 10;
                if (tmp > 50) {
                    map.setZoom(map.getZoom() + 4);
                }
                else 
                    if (tmp > 25) {
                        map.setZoom(map.getZoom() + 2);
                    }
                    else {
                        map.setZoom(map.getZoom() + 1);
                    }
            }
        }, false);
        
        
        // iphone's dummy way, so safari regognizes element as clickable element.  
        addEvent(elem, 'click', function(){
            void (0);
            //			GEvent.trigger(GlobalMap, "zoomend",GlobalMap.getZoom(),(GlobalMap.getZoom()+5) ); 
        });
        
    });
    / *
     // we don't use this here
     GEvent.addListener(obj.map, "zoomend", function(oldzoom, newzoom) {
     alert("zoom level: " + newzoom);
     });* /
});

testLatOrLon = function(value, type){
    if (type == '') 
        return false;
    if (type == 'latitude') 
        var testValue = 90;
    if (type == 'longitude') 
        var testValue = 180;
    
    if ((value) < -(testValue)) {
        return -(testValue);
    }
    else 
        if ((value) > (testValue)) {
            return (testValue);
        }
        else {
            return value;
        }
};

var currentWidth = 0;
function updateLayout(){
    if (window.innerWidth != currentWidth) {
        currentWidth = window.innerWidth;
        var orient = currentWidth == 320 ? "profile" : "landscape";
        document.body.setAttribute("orient", orient);
		document.getElementById(GolbalElement.id).style.width = window.innerWidth + "px";
		document.getElementById(GolbalElement.id).style.height = window.innerHeight + "px";

		
        setTimeout(function(){
            window.scrollTo(0, 1);
        }, 100);
    }
}
var log ='';
function alertInt(){
	alert(log);
	log='';
}

var iPhoneLat,iPhoneLon;
function iPhoneLocate(lat,lon){
	iPhoneLat = lat;
	iPhoneLon = lon;
//	alert(lat + " " + lon);
	var obj = GlobalObj;
  	var map = GlobalObj.map;
	var point = new GLatLng(lat,lon);
	map.setCenter(point, 13);
};*/

