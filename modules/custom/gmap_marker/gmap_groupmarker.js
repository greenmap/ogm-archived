var debug = false;
/**
 * GGroups constuctor
 * @param GMap map
 */

GGroups = function ( map ){
	this.map = map; // GMap object to which this GGroups belongs
	this.objects = []; // all objects of this GGroups
	this.groups = []; // all groups of this GGroups
	this.layers = []; // all layers of this GGroups
	this.objectQueue = []; // queue for adding multiple objects to the map
	this.timeout = null; //timeout variable for DisplayLater-function
	this.displayTimeout = null; // interval variable for Display-function
	this.displayCurrentObject = 0; // counter variable for Display-function
	this.bounds = null;
	this.currentZoomLevel = map.getZoom(); // zoomLevel
	
	var self = this; // this object for objectsInterval
    this.objectsInterval = window.setInterval(function() { // interval for adding multiple objects from the queue to the map
	
		if(self.objectQueue.length == 0){return;}
		// get expanded bounds		
		var bounds = self.getBounds();
		
		var objectData = self.objectQueue.shift();
		var object = self.AddObject(objectData['object'],objectData['layer'],objectData['groups']);
		
		if ((object.getVisibility()) && (object != null) && (bounds.contains(object.getPoint()))) {
			// Display the visible objects not already up
			if (!object.onMap) {
	   			self.map.addOverlay( object );
	   			object.onMap = true;
			}
		} else {
			// Take down the non-visible objects.
			if (object.onMap) {
				
				self.map.removeOverlay( object );
				object.onMap = false;
			}
		}
	},5);
   
   
  // These could be useful in the future
  
    //GEvent.addListener( map, 'zoomend', this.zoomDisplay());
    //GEvent.addListener( map, 'moveend', this.Display()) ;
	
  //  GEvent.addListener( map, 'infowindowclose', GGroups.MakeCaller( GGroups.PopDown, this ) );
};
/**
 * getBounds
 * @return GBounds
 * get bounds, expands them litle and save them to bounds variable.
 */
GGroups.prototype.getBounds = function() {
	var bounds = this.map.getBounds();

    // Expand the bounds a little, so things look smoother when scrolling
    // by small amounts.
    var sw = bounds.getSouthWest();
    var ne = bounds.getNorthEast();
   	var dx = ne.lng() - sw.lng();
    var dy = ne.lat() - sw.lat();
    if ( dx < 300 && dy < 150 ) {
		dx *= 0.10;
		dy *= 0.10;
		bounds = new GLatLngBounds(
	  		new GLatLng( sw.lat() - dy, sw.lng() - dx ),
	  		new GLatLng( ne.lat() + dy, ne.lng() + dx ) 
		);
	}
	// save the bounds
	this.bounds = bounds;
	return bounds;
}

/**
 * AddObjects
 * @param Array objects
 * @see AddObject
 * Puts all objects into the object-queue. Use this when you want to add multiple objects to the GGroups.
 */
GGroups.prototype.AddObjects = function(objects){
	for (var m in objects) {
		this.objectQueue.push(objects[m]);
	}
}

/**
 * AddObject
 * @param GMarker object
 * @param GLayer layer
 * @param Array groups
 * @return GMarker;
 * @see AddObjects
 * Add object to the GGroups. Use this when you want to add a single object. For multiple objects use AddObjects-function
 */
GGroups.prototype.AddObject = function ( object, layer, groups ) {
	/*
	for (var m in this.objects) {
		if(this.objects[m] == null){continue;}
		if(this.objects[m].getId() == object.getId()){
			return this.objects[g];
			break;
		}
	}
	*/
   // object.title = title;
    object.onMap = false;
	// set layer
	object.setLayer(layer); // <- needed when checking visibility 
	
	// set groups
	for (var g in groups) {
		groups[g].AddObject( object );// <- needed when checking visibility
		object.addGroup( groups[g] ); // <- important
	}
	
    this.objects.push( object );
	// we want to run this test only once so that's why this is run here not inside GGroup-class (AddObject-function)
	
	object.testVisibility();
	return object;
};
/**
 * countObjects
 * @return Array
 */
GGroups.prototype.countObjects = function () {
	var r = [];
	r['visible'] = 0;
	r['total'] = 0;
	for (var m in this.objects) {
		var object = this.objects[m];
		if(object == null){continue;}
		if(object.onMap){
			r['visible'] ++;
		}
		r['total']++;
	}
	return r;
};
/**
 * RemoveObject
 * @param GMarker object
 * Call this to remove a object.
 */
GGroups.prototype.RemoveObject = function (object){
	// find object
	for (var i = (this.objects.length -1);i >= 0 ; i-- ) {
		if (this.objects[i] != object) { continue; }
	    if ( object.onMap ){ this.map.removeOverlay( object ); }
		
		// delete from groups
		for (var j = (this.groups.length -1);j >= 0 ; j-- ) {
			var group = this.groups[j];
			if (group == null) {continue;}
			group.RemoveObject(object);	
		}
		
		// delete from layers
		object.getLayer().RemoveObject(object);
		
		if (i == this.objects.length - 1) {
			this.objects.pop();
		}
		else {
			/*				 
		  	  usually we just replace this object with the last object
		  	  doesn't really matter what kind of data the last object contains
		  	  normally it is a real object, the only exception is if for some reason someone deletes the last object and meanwhile we are running this loop
		  	  but that's not important.
			 */				
			this.objects[i] = this.objects[this.objects.length - 1];
			this.objects.pop();
		}
		
	    break;
	}
    this.DisplayLater();
};
/**
 * AddGroup
 * @param String name
 * @return GGroup
 * Call this to add a group.
 */
GGroups.prototype.AddGroup = function ( name ) {
	var group = false;
	
	// let's check if group already exists
	for (var g in this.groups) {
		if(this.groups[g] == null){continue;}
		if(this.groups[g].getName() == name){
			group = this.groups[g];
			return this.groups[g];
			break;
		}
	}
	if (group == false) {
		group = new GGroup(this.map, name);
		this.groups.push(group);
	}
	return group;
};
/**
 * RemoveGroup
 * @param GGroup group
 * Call this to remove a group. NOTE: this doesn't remove any objects!
 */
GGroups.prototype.RemoveGroup = function (group) {
	// leave objects behind even if they don't have any group
	for(var j in this.groups) {
		if(this.groups[j] == null){continue;}
		if (this.groups[j] != group) { continue; }
		
		if (j == this.groups.length - 1) {
			this.groups.pop();
		}
		else {
			this.groups[j] = this.groups[this.groups.length - 1];
			this.groups.pop();
		}
		
		break;
	}
	
	// remove the group from objects
	for (var m in this.objects) {
		var object = this.objects[m];
		if(object = null){continue;}
		object.RemoveGroup(group);
		
	}
};
/**
 * AddLayer
 * @param String name
 * @param Int minZoom
 * @param Int maxZoom
 * @return GLayer
 * Call this to add a new layer. Note: maxZoom isn't required.
 */
GGroups.prototype.AddLayer = function ( name,minZoom,maxZoom ) {
	var layer = false;
	// let's check if the layer already exists
	for (var l in this.layers) {
		if(this.layers[l] == null){continue;}
		if(this.layers[l].getName() == name){
			layer = this.layers[l];
			break;
		}
	}
	if (layer == false) {
		layer = new GLayer(this.map, name,minZoom,maxZoom);
		
		this.layers.push(layer);
	}
	
	return layer;
};
/**
 * RemoveLayer
 * @param GLayer layer
 * Removes the layer. Note: this will remove all objects from this layer!
 */
GGroups.prototype.RemoveLayer = function (layer) {

	// remove objects
	for (var m = (this.objects.length -1);m >= 0 ; m-- ) {
		var object = this.objects[m];
		if(object == null){continue;}
		if(object.getLayer() != layer){continue;}
		this.RemoveObject(object);	
	}
	// remove layer
	for(var l = (this.layers.length -1);l >= 0 ; l-- ) {
		if(this.layers[l] == null){continue;}
		if (this.layers[l] != layer) { continue; }
		
		if (l == this.layers.length - 1) {
			this.layers.pop();
		}
		else {
			this.layers[l] = this.layers[this.layers.length - 1];
			this.layers.pop();
		}
		break;
	}
	
	
	
};
/**
 * getLayers
 * @return Array
 */
GGroups.prototype.getLayers = function () {
	return this.layers;
};
/**
 * getLayers
 * @return Array
 */
GGroups.prototype.getObjects = function () {
	return this.objects;
};
/**
 * hideGroupByName
 * @param String name
 * Hides the group and refreshes the map
 */
GGroups.prototype.hideGroupByName = function(name){
	for (var g in this.groups) {
		if(this.groups[g] == null){continue;}
		if(this.groups[g].getName() == name){
			if(this.groups[g].setVisibility(false)){
				this.Display();
			
			}
			break;
		}
	}
};
/**
 * showGroupByName
 * @param String name
 * Shows the group and refreshes the map
 */
GGroups.prototype.showGroupByName = function(name){
	
	for (var g in this.groups) {
		if(this.groups[g] == null){continue;}
		if(this.groups[g].getName() == name){
			this.groups[g].setVisibility(true);
			this.Display();			
			
			break;
		}
	}

};
/**
 * DisplayLater
 * Sets 50ms interval and after that refreshes the map (useful when you want to add more than one object on the map at the same time).
 */
GGroups.prototype.DisplayLater = function (){
    if ( this.timeout != null )
	clearTimeout( this.timeout );
	var self = this;
    this.timeout = setTimeout( 
		function(){
			self.Display();
		}
		, 50 );
};
/**
 * zoomDisplay
 * Checks visibility of layers and refreshes the map.
 */
GGroups.prototype.zoomDisplay = function() {
	clearTimeout( this.timeout );
	clearTimeout(this.displayTimeout);
	this.displayTimeout = null;
	this.displayCurrentObject = 0; // clear m
	
	var newZoomLevel = this.map.getZoom();
    if (newZoomLevel != this.currentZoomLevel) {
		for (var l in this.layers) {
			var layer = this.layers[l];
			if(layer.zoomed ( newZoomLevel )) {
				continue; // we just want to wait return value
			}
		}
		this.currentZoomLevel = newZoomLevel;
		this.Display();
	}
};

/**
 * Display
 * Refresh the map
 */
GGroups.prototype.Display = function() {
	
	clearTimeout( this.timeout );
	
	
	// Get the current bounds of the visible area.
	var bounds = this.getBounds();
	//this.bounds = bounds; // already done in getBounds-function
	window.clearTimeout(this.displayTimeout);
	this.displayTimeout = null;
	this.displayCurrentObject = 0; // clear m
	var self = this;
	this.displayTimeout = setTimeout(
	function() {
		self.DispInt();
	}
	
	,0);
	
};
/**
 * DispInt
 * Interval function to Display.
 */
GGroups.prototype.DispInt = function(){
	var m = this.displayCurrentObject;
	
	if (m < this.objects.length) {
	
		var object = this.objects[m];
		if (object == null) {
			this.displayCurrentObject++; // don't forget
			return;
		}

		if ((object.getVisibility()) && (this.bounds.contains(object.getPoint()))) {
			// Display the visible objects not already up
			if (!object.onMap) {
				this.map.addOverlay(object);
				object.onMap = true;
			}
		}
		else {
			// Take down the non-visible objects.

			//if (object.onMap) {

				this.map.removeOverlay(object);
				object.onMap = false;
			//}
		}
		this.displayCurrentObject++; // don't forget
		clearTimeout(this.displayTimeout);
		var self = this;
		this.displayTimeout =setTimeout(
		function() {
			self.DispInt();
		}
		,0);
	}
	else {
		// if end of loop -> clear the interval
		clearTimeout(this.displayTimeout);
		this.displayTimeout = null;
		this.displayCurrentObject = 0; // clear m
	}

};

// *** GGROUP ***
/**
 * GGroup constructor
 * @param GMap map
 * @param String gName
 */
GGroup = function (map,gName) {
	
	this.map = map; // map object where this GGroup belongs.
	this.name = gName; // name of this GGroup (identifier).
	this.objects = []; // all objects included in this group
	this.visibility = GGroup.defaultVisibility; // visibility of this group.

};

//GGroup.defaultVisibility = false;
GGroup.defaultVisibility = true;

/**
 * getName
 * @return String
 */
GGroup.prototype.getName = function (){
	return this.name;
};
/**
 * AddObject
 * @param GMarker object
 * adds object to this GGroup
 */
GGroup.prototype.AddObject = function (object){
	this.objects.push(object);
	// object's visibility test should run elsewhere (look. GGroups.prototype.AddObject)
};
/**
 * RemoveObject
 * @param GMarker object
 * Removes object from this GGroup.
 */
GGroup.prototype.RemoveObject = function(object){
	for (var i = (this.objects.length -1);i >= 0 ; i-- ) {
		if (this.objects[i] != object) {continue;}
		
		if (i == this.objects.length - 1) {
			this.objects.pop();
		}
		else {
			/*				 
			  usually we just replace this object with the last object
			  doesn't really matter what kind of data the last object contains
			  normally it is a real object, the only exception is if for some reason someone deletes the last object and meanwhile we are running this loop
			  but that's not important.
			*/				
			this.objects[i] = this.objects[this.objects.length - 1];
			this.objects.pop();
		}
	}
};
/**
 * objectCount
 * @return Int
 * Returns length of the objects array.
 */
GGroup.prototype.objectCount = function (){
	return this.objects.length;
};
/**
 * setVisibility
 * @param Boolean visibility
 * sets visibility of this GGroup and also tests objects' visibility after this change
 */
GGroup.prototype.setVisibility = function (visibility){
	this.visibility = visibility;
	for(var i = 0; i < this.objects.length;i++) {
		if (this.objects[i] == null) {continue;}
		if(!this.objects[i].testVisibility()) {
			//if(!this.objects[i].onMap){continue;}
			
			// if object's visibility is false and object is on the map, remove it from the map
			this.map.removeOverlay( this.objects[i] );
			this.objects[i].onMap = false;
		}
	}
	return true;
};
/**
 * getVisibility
 * @return Boolean
 * Returns visibility of this GGroup
 */
GGroup.prototype.getVisibility = function (){
	return this.visibility;
};


// *** GLAYER ***
/**
 * GLayer constructor
 * @param GMap map
 * @param String name
 * @param Int minZoom
 * @param Int maxZoom
 * maxZoom isn't required
 */
GLayer = function (map,name,minZoom,maxZoom) {
	this.name = name; // name of this GLayer (identifier)
	this.map = map; //  GMap where this GLayer belongs
	this.minZoom = minZoom; //min zoom where this GLayer is visible
	
	
	if(maxZoom){
		this.maxZoom = maxZoom; // max zoom where this GLayer is visible
	}else {
		this.maxZoom = GLayer.defaultMaxZoom; // max zoom where this GLayer is visible (default value)
	}
	this.visibility = GLayer.defaultVisibility; // visiblitity of this GLayer
	this.checkZoom(map.getZoom()); // change visibility if needed
	this.objects = []; // all objects of this GLayer
	
};
GLayer.defaultMaxZoom = 999; // <- so high that we never have problems
GLayer.defaultVisibility = false; // layer is hidden by default
/**
 * getName
 * @return String
 */
GLayer.prototype.getName = function (){
	return this.name;
};
/**
 * getMinZoom
 * @return Int
 */
GLayer.prototype.getMinZoom = function (){
	return this.minZoom;
};
/**
 * getMaxZoom
 * @return Int
 */
GLayer.prototype.getMaxZoom = function (){
	return this.maxZoom;
};
/**
 * getVisibility
 * @return Boolean
 * Returns visibility of this GLayer
 */
GLayer.prototype.getVisibility = function (){
	return this.visibility;
};
/**
 * setVisibility
 * @param Boolean visibility
 * sets visibility of this GLayer and also tests objects' visibility after this change
 */
GLayer.prototype.setVisibility = function (visibility){
	this.visibility = visibility;
	for(var i in this.objects) {
		if (this.objects[i] == null) {continue;}
		if(!this.objects[i].testVisibility()) {
			// if object's visibility is false, remove it from the map
			this.map.removeOverlay( this.objects[i] );
			this.objects[i].onMap = false;
		}
	}
};
/**
 * AddObject
 * @param GMarker object
 * adds object to this GLayer
 */
GLayer.prototype.AddObject = function (object){
	this.objects.push(object);
	// object's visibility test should run elsewhere (look. GGroups.prototype.AddObject)
};
/**
 * RemoveObject
 * @param GMarker object
 * Removes object from this GLayer.
 */
GLayer.prototype.RemoveObject = function(object){
	for (var i = (this.objects.length -1);i >= 0 ; i-- ) {
		if (this.objects[i] != object) {continue;}
		
		if (i == this.objects.length - 1) {
			this.objects.pop();
		}
		else {
			/*				 
			  usually we just replace this object with the last object
			  doesn't really matter what kind of data the last object contains
			  normally it is a real object, the only exception is if for some reason someone deletes the last object and meanwhile we are running this loop
			  but that's not important.
			*/				
			this.objects[i] = this.objects[this.objects.length - 1];
			this.objects.pop();
		}
	}
};
/**
 * getObjects
 * @return Array
 */
GLayer.prototype.getObjects = function (){
	return this.objects;
};
/**
 * objectCount
 * @return Int
 * Returns length of the objects array.
 */
GLayer.prototype.objectCount = function (){
	return this.objects.length;
};
/**
 * checkZoom
 * @param Int zoom
 * @return Boolean
 * Checks if this GLayer should be shown
 */
GLayer.prototype.checkZoom = function(zoom){
	if(this.minZoom <= zoom && zoom <= this.maxZoom){
		this.visibility = true;
		return true;
	}
	this.visibility = false;
	return false;
};
/**
 * zoomed
 * @param Int zoom
 * Checks the visibility and runs visibility test for all objects of this layer
 */
GLayer.prototype.zoomed = function(zoom){
	this.checkZoom(zoom);
	//alert(this.minZoom + " " + zoom + " " + this.visibility);
	for(var i in this.objects) {
		if (this.objects[i] == null) {continue;}
		this.objects[i].testVisibility();
	}
	return true;
};



// *** GMARKER ***
/*
 * GMarker is Google Map's own prototype and these functions are only extensions.
 */

GMarker.defaultVisibility = false; // marker's default visibility
GMarker.defaultVisibilityType = 'AND'; 	// visibility type tells how the marker should act when groups are hidden.
										// when value is 'AND' all groups of this marker should be visible for viewing this marker on the map
										// when value is 'OR' at least one group of this marker should be visible for viewing this marker on the map
										// You find this code in testVisibility-function
										// This data is located in GMarker because there might be different kinds of markers 
										//(for example subway stations should always be visible when at least one group is visible and
										// normal markers which should be easily hidden)
//GMarker.defaultVisibilityType = 'OR';

/**
 * addGroup
 * @param GGroup group
 * @return Boolean
 * adds new group to this marker. If this group already exists return false. On success return true.
 */
GMarker.prototype.addGroup = function ( group ){
	if(!this.groups){
		this.groups = new Array();
	}
    for (var g in this.groups) {
		if(this.groups[g].getName() == group.getName()){
			return false;
		}
	}
	this.groups.push(group);
	return true;
};
/**
 * RemoveGroup
 * @param GGroup group
 * Removes current group from this marker. Note: this doesn't remove GGroup object.
 */
GMarker.prototype.RemoveGroup = function ( group ) {
	// leave markers behind even if they don't have any group
	for(var j in this.groups) {
		if (this.groups[j] != group) { continue; }
		// when we find the group we remove the marker from it
		this.groups[j].RemoveObject(this);
		
		// and we remove the group from this marker
		
		if (j == this.groups.length - 1) { 
			this.groups.pop(); // special case: if the group is the last group of the groups array we just pop it out
		}
		else { // otherwise we overwrite that group with the last group object and pop the last one out
			this.groups[j] = this.groups[this.groups.length - 1];
			this.groups.pop();
		}
		break;
	}
};
/**
 * setLayer
 * @param GLayer layer
 * @return GLayer
 * Sets the markers layer. Note: One marker can be only in one layer at a time!
 */
GMarker.prototype.setLayer = function ( layer ){
	this.layer = layer;
	layer.AddObject(this);
	return layer;
};
/**
 * getLayer
 * @return GLayer
 */
GMarker.prototype.getLayer = function (){
	if(!this.layer){
		this.layer = false;
	}
	return this.layer;
};
/**
 * setId
 * @param Int id
 * Id is the identifier for this marker.
 */
GMarker.prototype.setId = function ( id ){
	this.id = id;
};
/**
 * getId
 * @return Int
 */
GMarker.prototype.getId = function (){
	if(!this.id){
		this.id = false;
	}
	return this.id;
};
/**
 * testVisibility
 * @return Boolean
 * Tests and caches visibility of this marker.
 * 		- If Layer is invisible -> marker is invisible
 * 		- this marker's visibility depends on the visibility type (AND/OR) and visibility of the groups of this marker.
 */
GMarker.prototype.testVisibility = function () {
	if(this.visibility == null){
		this.visibility = GMarker.defaultVisibility;
	}

	// if the layer is not visible we don't show the marker either
	if(this.layer.getVisibility() == false){
		this.visibility = false;
		return false;
	}
	/*
	if (this.getVisibilityType() == 'OR') {
		this.visibility = false;
		// if at least one of the groups are visible, the marker will be shown
		for (var g in this.groups) {
			var group = this.groups[g];
			if (group == null) {
				continue;
			}
			if (group.getVisibility()) {
				this.visibility = true;
				return true;
				break;
			}
		}
	} else */
	if (this.getVisibilityType() == 'AND') {
		this.visibility = true;
		//if one or more groups are invisible then we hide the marker
		for (var g in this.groups) {
			var group = this.groups[g];
			if (group == null) {
				continue;
			}
			if (group.getVisibility() == false) {
				this.visibility = false;
				return false;
				break;
			}
		}
	} 
	/*
	else {
		// if visibility type is something else, we reset the visibility-type and start again.
		this.setVisibilityType( GMarker.defaultVisibilityType );
		return this.testVisibility();
	}
	*/
	return this.visibility;
};
/**
 * getVisibility
 * @return Boolean
 * Returns cached visibility of this marker (use this as mutch as possible).
 */
GMarker.prototype.getVisibility = function() {
	// if visibility is not set
	if (this.visibility == null) {
		return this.testVisibility();
	}else {
		return this.visibility;
	}
};
/**
 * setVisibility
 * @param Boolean visibility
 * sets cached visibility value.
 */
GMarker.prototype.setVisibility = function(visibility){
	this.visibility = visibility;
};
/**
 * setVisibilityType
 * @param String type
 * Sets the visibility type (AND/OR)
 */
GMarker.prototype.setVisibilityType = function(type){
	this.visibilityType = type;
};
/**
 * getVisibilityType
 * @return String
 * Returns the visibility type (AND/OR)
 */
GMarker.prototype.getVisibilityType = function(){
	if(this.visibilityType ==null){
		this.visibilityType = GMarker.defaultVisibilityType;
	}
	return this.visibilityType;
};




// GPOLYLINE
/*
 * GPolyline is Google Map's own prototype and these functions are only extensions.
 */

GPolyline.defaultVisibility = false; // marker's default visibility
GPolyline.defaultVisibilityType = 'AND'; 	// visibility type tells how the marker should act when groups are hidden.
										// when value is 'AND' all groups of this marker should be visible for viewing this marker on the map
										// when value is 'OR' at least one group of this marker should be visible for viewing this marker on the map
										// You find this code in testVisibility-function
										// This data is located in GPolyline because there might be different kinds of markers 
										//(for example subway stations should always be visible when at least one group is visible and
										// normal markers which should be easily hidden)
//GPolyline.defaultVisibilityType = 'OR';

/**
 * addGroup
 * @param GGroup group
 * @return Boolean
 * adds new group to this marker. If this group already exists return false. On success return true.
 */
GPolyline.prototype.addGroup = function ( group ){
	if(!this.groups){
		this.groups = new Array();
	}
    for (var g in this.groups) {
		if(this.groups[g].getName() == group.getName()){
			return false;
		}
	}
	this.groups.push(group);
	return true;
};
/**
 * RemoveGroup
 * @param GGroup group
 * Removes current group from this marker. Note: this doesn't remove GGroup object.
 */
GPolyline.prototype.RemoveGroup = function ( group ) {
	// leave markers behind even if they don't have any group
	for(var j in this.groups) {
		if (this.groups[j] != group) { continue; }
		// when we find the group we remove the marker from it
		this.groups[j].RemoveObject(this);
		
		// and we remove the group from this marker
		
		if (j == this.groups.length - 1) { 
			this.groups.pop(); // special case: if the group is the last group of the groups array we just pop it out
		}
		else { // otherwise we overwrite that group with the last group object and pop the last one out
			this.groups[j] = this.groups[this.groups.length - 1];
			this.groups.pop();
		}
		break;
	}
};
/**
 * setLayer
 * @param GLayer layer
 * @return GLayer
 * Sets the markers layer. Note: One marker can be only in one layer at a time!
 */
GPolyline.prototype.setLayer = function ( layer ){
	this.layer = layer;
	layer.AddObject(this);
	return layer;
};
/**
 * getLayer
 * @return GLayer
 */
GPolyline.prototype.getLayer = function (){
	if(!this.layer){
		this.layer = false;
	}
	return this.layer;
};
/**
 * setId
 * @param Int id
 * Id is the identifier for this marker.
 */
GPolyline.prototype.setId = function ( id ){
	this.id = id;
};
/**
 * getId
 * @return Int
 */
GPolyline.prototype.getId = function (){
	if(!this.id){
		this.id = false;
	}
	return this.id;
};
/**
 * testVisibility
 * @return Boolean
 * Tests and caches visibility of this marker.
 * 		- If Layer is invisible -> marker is invisible
 * 		- this marker's visibility depends on the visibility type (AND/OR) and visibility of the groups of this marker.
 */
GPolyline.prototype.testVisibility = function () {
	if(this.visibility == null){
		this.visibility = GPolyline.defaultVisibility;
	}

	// if the layer is not visible we don't show the marker either
	if(this.layer.getVisibility() == false){
		this.visibility = false;
		return false;
	}
	/*
	if (this.getVisibilityType() == 'OR') {
		this.visibility = false;
		// if at least one of the groups are visible, the marker will be shown
		for (var g in this.groups) {
			var group = this.groups[g];
			if (group == null) {
				continue;
			}
			if (group.getVisibility()) {
				this.visibility = true;
				return true;
				break;
			}
		}
	} else */
	if (this.getVisibilityType() == 'AND') {
		this.visibility = true;
		//if one or more groups are invisible then we hide the marker
		for (var g in this.groups) {
			var group = this.groups[g];
			if (group == null) {
				continue;
			}
			if (group.getVisibility() == false) {
				this.visibility = false;
				return false;
				break;
			}
		}
	} 
	/*
	else {
		// if visibility type is something else, we reset the visibility-type and start again.
		this.setVisibilityType( GPolyline.defaultVisibilityType );
		return this.testVisibility();
	}
	*/
	return this.visibility;
};
/**
 * getVisibility
 * @return Boolean
 * Returns cached visibility of this marker (use this as mutch as possible).
 */
GPolyline.prototype.getVisibility = function() {
	// if visibility is not set
	if (this.visibility == null) {
		return this.testVisibility();
	}else {
		return this.visibility;
	}
};
/**
 * setVisibility
 * @param Boolean visibility
 * sets cached visibility value.
 */
GPolyline.prototype.setVisibility = function(visibility){
	this.visibility = visibility;
};
/**
 * setVisibilityType
 * @param String type
 * Sets the visibility type (AND/OR)
 */
GPolyline.prototype.setVisibilityType = function(type){
	this.visibilityType = type;
};
/**
 * getVisibilityType
 * @return String
 * Returns the visibility type (AND/OR)
 */
GPolyline.prototype.getVisibilityType = function(){
	if(this.visibilityType ==null){
		this.visibilityType = GPolyline.defaultVisibilityType;
	}
	return this.visibilityType;
};

// GPOLYGON

/*
 * GPolygon is Google Map's own prototype and these functions are only extensions.
 */

GPolygon.defaultVisibility = false; // marker's default visibility
GPolygon.defaultVisibilityType = 'AND'; 	// visibility type tells how the marker should act when groups are hidden.
										// when value is 'AND' all groups of this marker should be visible for viewing this marker on the map
										// when value is 'OR' at least one group of this marker should be visible for viewing this marker on the map
										// You find this code in testVisibility-function
										// This data is located in GPolygon because there might be different kinds of markers 
										//(for example subway stations should always be visible when at least one group is visible and
										// normal markers which should be easily hidden)
//GPolygon.defaultVisibilityType = 'OR';

/**
 * addGroup
 * @param GGroup group
 * @return Boolean
 * adds new group to this marker. If this group already exists return false. On success return true.
 */
GPolygon.prototype.addGroup = function ( group ){
	if(!this.groups){
		this.groups = new Array();
	}
    for (var g in this.groups) {
		if(this.groups[g].getName() == group.getName()){
			return false;
		}
	}
	this.groups.push(group);
	return true;
};
/**
 * RemoveGroup
 * @param GGroup group
 * Removes current group from this marker. Note: this doesn't remove GGroup object.
 */
GPolygon.prototype.RemoveGroup = function ( group ) {
	// leave markers behind even if they don't have any group
	for(var j in this.groups) {
		if (this.groups[j] != group) { continue; }
		// when we find the group we remove the marker from it
		this.groups[j].RemoveObject(this);
		
		// and we remove the group from this marker
		
		if (j == this.groups.length - 1) { 
			this.groups.pop(); // special case: if the group is the last group of the groups array we just pop it out
		}
		else { // otherwise we overwrite that group with the last group object and pop the last one out
			this.groups[j] = this.groups[this.groups.length - 1];
			this.groups.pop();
		}
		break;
	}
};
/**
 * setLayer
 * @param GLayer layer
 * @return GLayer
 * Sets the markers layer. Note: One marker can be only in one layer at a time!
 */
GPolygon.prototype.setLayer = function ( layer ){
	this.layer = layer;
	layer.AddObject(this);
	return layer;
};
/**
 * getLayer
 * @return GLayer
 */
GPolygon.prototype.getLayer = function (){
	if(!this.layer){
		this.layer = false;
	}
	return this.layer;
};
/**
 * setId
 * @param Int id
 * Id is the identifier for this marker.
 */
GPolygon.prototype.setId = function ( id ){
	this.id = id;
};
/**
 * getId
 * @return Int
 */
GPolygon.prototype.getId = function (){
	if(!this.id){
		this.id = false;
	}
	return this.id;
};
/**
 * testVisibility
 * @return Boolean
 * Tests and caches visibility of this marker.
 * 		- If Layer is invisible -> marker is invisible
 * 		- this marker's visibility depends on the visibility type (AND/OR) and visibility of the groups of this marker.
 */
GPolygon.prototype.testVisibility = function () {
	if(this.visibility == null){
		this.visibility = GPolygon.defaultVisibility;
	}

	// if the layer is not visible we don't show the marker either
	if(this.layer.getVisibility() == false){
		this.visibility = false;
		return false;
	}
	if (this.getVisibilityType() == 'AND') {
		this.visibility = true;
		//if one or more groups are invisible then we hide the marker
		for (var g in this.groups) {
			var group = this.groups[g];
			if (group == null) {
				continue;
			}
			if (group.getVisibility() == false) {
				this.visibility = false;
				return false;
				break;
			}
		}
	} 
	/*
	else {
		// if visibility type is something else, we reset the visibility-type and start again.
		this.setVisibilityType( GPolygon.defaultVisibilityType );
		return this.testVisibility();
	}
	*/
	return this.visibility;
};
/**
 * getVisibility
 * @return Boolean
 * Returns cached visibility of this marker (use this as mutch as possible).
 */
GPolygon.prototype.getVisibility = function() {
	// if visibility is not set
	if (this.visibility == null) {
		return this.testVisibility();
	}else {
		return this.visibility;
	}
};
/**
 * setVisibility
 * @param Boolean visibility
 * sets cached visibility value.
 */
GPolygon.prototype.setVisibility = function(visibility){
	this.visibility = visibility;
};
/**
 * setVisibilityType
 * @param String type
 * Sets the visibility type (AND/OR)
 */
GPolygon.prototype.setVisibilityType = function(type){
	this.visibilityType = type;
};
/**
 * getVisibilityType
 * @return String
 * Returns the visibility type (AND/OR)
 */
GPolygon.prototype.getVisibilityType = function(){
	if(this.visibilityType ==null){
		this.visibilityType = GPolygon.defaultVisibilityType;
	}
	return this.visibilityType;
};









/* USELESS FUNCTIONS AND STUFF */


//GGroups.defaultDisplayType = "AND";
/*
GGroups.prototype.markersQueueHandler = function(){
	if(this.objectQueue.length == 0){return;}
	var markerData = this.objectQueue.shift();
	alert(markerData['layer'].getName());
	this.AddObject(markerData['marker'],markerData['layer'],markerData['groups']);
	this.DisplayLater();
}
*/

/*
GGroups.prototype.hideDisplay = function() {
	
	clearTimeout( this.timeout );
	
	clearInterval(this.displayTimeout);
	this.displayTimeout = null;
	this.displayCurrentObject = 0; // clear m
	
	for (var m in this.markers) {
		var marker = this.markers[m];
		if ((!marker.getVisibility()) && (marker == null)) {
			// Take down the non-visible markers.
			if (!marker.onMap) { continue; }
			this.map.removeOverlay( marker );
			marker.onMap = false;
		}
	}
};
*/
/*
GGroups.MakeCaller = function ( func, arg )
    {
    return function () { func( arg ); };
};
*/



/*
GGroup.prototype.show = function(){
	for(var i in this.markers) {
		if (this.markers[i] == null) {continue;}
		if (this.markers[i].onMap == true) {continue;}
		
		this.markers[i].onMap = true;
	}
};
*/

