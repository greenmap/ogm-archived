/**
 * GMap Marker Loader
 * Static markers.
 * This is a simple marker loader to read markers from the map settings array.
 * Commonly used with macros.
 */
/* $Id */




// Add a gmap handler
Drupal.gmap.addHandler('gmap', function(elem) {
  var obj = this;
  var marker, i;
  // clear markers because we want to load them with ajax
  obj.vars.markers = null;
  
  obj.bind('init', function() {
    // Set up the markermanager.
	//obj.gm = new GGroups(obj.map);
//    obj.mm = new GMarkerManager(obj.map, Drupal.settings.gmap_markermanager);
  });
});
