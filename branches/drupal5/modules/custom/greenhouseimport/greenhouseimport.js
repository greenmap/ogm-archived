

// JSON for jQuery by Michael Geary
// See http://mg.to/2006/01/25/json-for-jquery
// Free beer and free speech. Enjoy!

$.json = { callbacks: {} };

$.fn.json = function( url, callback ) {
    var _$_ = this;
    load( url.replace( /{callback}/, name(callback) ) );
    return this;

    function name( callback ) {
        var id = (new Date).getTime();
        var name = 'json_' + id;

        var cb = $.json.callbacks[id] = function( json ) {
            delete $.json.callbacks[id];
            eval( 'delete ' + name );
            _$_.each( function() { callback(json); } );
        };

        eval( name + ' = cb' );
        return name;
    }

    function load( url ) {
        var script = document.createElement( 'script' );
        script.type = 'text/javascript';
        script.src = url;
        $('head',document).append( script );
    }
};



// set up logging in Firebug
function log() {
    // if( window.console )
        // console.debug.apply( console, arguments );
    //else
        // alert( [].join.apply( arguments, [' '] ) );
}

$(document).ready(function(){
    log( 'Document Ready' );
	// disable the pdf field - not doing this in PHP incase JS is disabled on users computer.
	$('#edit-field-map-pdf-0-value').attr("disabled","true");
	// when url is entered, do something
	$('#edit-field-map-in-greenhouse-0-url').change(function(){
	    // don't want to let people put any URL in here - danger of cross site scripting, so ideally should just take last arg and append to hard-coded url
		var nodeid = $('#edit-field-map-in-greenhouse-0-url').attr("value");
		
		var url = 'http://www.greenmap.org/greenhouse/check/' + nodeid;
	    log( 'url:', url );
		//  do the jquery
	    $().json( url );
		log( 'json done' );
	});
});

// do something with the json 
function jsonGM( json ) {
    log( 'json feed received:', json );
	
	// check type is correct
	if(json.type == 'content_map'){
		// if it is a map, then stick the url of the pdf into the correct place, if there is a url
		$('#edit-field-map-pdf-0-value').attr("value",json.download);
		$('#edit-field-map-pdf-0-value').removeAttr("disabled");
		$('#edit-field-map-in-greenhouse-0-url').attr("class","form-text");
		$('.link-field-url > .form-item > .description').text('Success: this is a valid map ID');
		// $(this).attr('value','');
	} else {
		// if wrong - alert? disable PDF field?
		log( 'error: wrong type' );
		$('#edit-field-map-in-greenhouse-0-url').attr("class","form-text error");
		$('#edit-field-map-pdf-0-value').attr("disabled","true");
		$('#edit-field-map-pdf-0-value').attr("value","");
		$('.link-field-url > .form-item > .description').text('Error: this is not a map ID');
	}
	
	
} 
