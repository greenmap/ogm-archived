/**
 *	Main Code!
 */


$(document).ready(function() {
	// handle clicks in the selector <div>
	$('.multimedia_item').click(function() {
		$('#multimedia_main').attr('innerHTML', multimedia_main[$(this).attr('id')]);
		$('#multimedia_description').attr('innerHTML', multimedia_description[$(this).attr('id')]);
	});
});
