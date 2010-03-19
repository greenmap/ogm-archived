//document.write(newLat);
//var mappy = Drupal.gmap.getMap(mapid);
//Drupal.settings.gmap.loc1.latitude = 5;

//alert(Drupal.gmap.setup());
// Drupal.settings.gmap.loc1.latitude



//Drupal.settings.gmap.loc1.latitude = '123';
//Drupal.settings.gmap.loc1.longitude = '321';
//Drupal.settings.gmap.loc1.zoom = 11;
//alert(newLat);
/*
Drupal.gmap.setup();
var m = Drupal.gmap.getMap('loc1'); // Replace locmap with the map's id that you want
m.vars.latitude = newLat;
m.vars.longitude = newLong;
m.vars.zoom = newZoom;
m.change('move',-1);
*/

Drupal.gmap.addHandler('gmap',function(elem) {
  var obj = this;
  var map = obj.map;
  obj.bind("init",function() {
  	var act = false;
  	if(newLat != '' && newLong != '' && newZoom != ''){
  		obj.map.setCenter(new GLatLng(newLat,newLong),newZoom);
		//act = true;
		//obj.vars.latitude = newLat;
	}
  });
});

// http://maps.google.fi/?ie=UTF8&ll=60.459926,22.27478&spn=0.683842,2.570801&z=9
//<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.fi/?ie=UTF8&amp;ll=62.385277,17.314453&amp;spn=1.285854,5.141602&amp;z=8&amp;output=embed&amp;s=AARTsJqzARj-Z8VnW5pkPMLMmZbqrJcYpw"></iframe><br /><small><a href="http://maps.google.fi/?ie=UTF8&amp;ll=62.385277,17.314453&amp;spn=1.285854,5.141602&amp;z=8&amp;source=embed" style="color:#0000FF;text-align:left">N�yt� suurempi kartta</a></small>
//alert(Drupal.settings.gmap.loc1.latitude);
//alert(mapid);

//for( var i=0; i<Drupal.settings.gmap.length; i++ ){
//alert(Drupal.settings.gmap[i].latitude);
//}
//mappy.setCenter(new google.maps.LatLng(newLat, newLong), newZoom);