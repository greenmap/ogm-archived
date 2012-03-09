$(document).ready(function() {
	//
	//	determine base (backend) url
	//
	var pos = location.href.indexOf('sites/default/');
	var base_url = location.href.substr(0, pos);

	
	//
	//	this is the login form
	//
	
	// retrieve username & password from cookies
	if ($.cookie('ogm_submit_username')) {
		$('#username').attr('value', $.cookie('ogm_submit_username'));
	}
	if ($.cookie('ogm_submit_password')) {
		$('#password').attr('value', $.cookie('ogm_submit_password'));
	}
	
	// clear dummy username
	$('#username').bind('focus', function(e) {
		if ($(this).attr('value') == 'username here') {
			$(this).attr('value', '');
		}
	});
	
	// handle the submit button
	$('#ogm_submit_login').bind('submit', function(e) {
		
		// disable submit button
		$('#ogm_submit_login_submit').attr('disabled', 'disabled');
		$('#ogm_submit_login_submit').attr('value', 'logging in..');
		
		// submit ajax request
		$.post(base_url+'services/json', {method: '"ogm_api.user_maps"', 'username': '"'+$('#username').attr('value')+'"', 'password': '"'+$('#password').attr('value')+'"'}, function(data) {
			
			// handle errors
			if (data == null) {
				alert('There was an error logging in, please try again later');
				$('#ogm_submit_login_submit').attr('value', 'login');
				$('#ogm_submit_login_submit').removeAttr('disabled');
				return;
			} else if (data['#error'] == true || data['#data']['#error'] == true) {
				alert('There was an error logging in: '+data['#data']['#message']);
				$('#ogm_submit_login_submit').attr('value', 'login');
				$('#ogm_submit_login_submit').removeAttr('disabled');
				return;
			}
			
			// add maps to select elemet
			for (var i in data['#data']) {
				// TODO: the value should probably be html-encoded here
				$('#map').append('<option value="'+data['#data'][i]['name']+'">'+data['#data'][i]['name']+'</option>');
			}
			
			// save username and password as cookie
			$.cookie('ogm_submit_username', $('#username').attr('value'), { expires: 365 });
			$.cookie('ogm_submit_password', $('#password').attr('value'), { expires: 365 });
			
			// hide login form, show site form
			$('#ogm_submit_login').css('display', 'none');
			$('#ogm_submit_site').css('display', 'block');
			
			// get current location for the next form
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function(position) {
					// we have a position
					ogm_submit_lat = position.coords.latitude;
					ogm_submit_long = position.coords.longitude;
					$('#location').html('<div id="currentlocation"><center><b>Current location:</b><br> Lat&nbsp;'+ogm_submit_lat.toFixed(6)+' Lon&nbsp;'+ogm_submit_long.toFixed(6));
					if (position.coords.accuracy !== null) {
						$('#location').html($('#location').html()+' <br><span style="display:none;" >Accuracy&nbsp;'+position.coords.accuracy.toFixed(0)+'m</span></center></div>');
					}
				}, function () {
					$('#location').html('Error retrieving current location');
				});
			} else {
				// we don't have a position
				$('#location').html('Error retrieving current location');
			}
		}, 'json');
		
		// to prevent the default browser action
		return false;
	});
	
	
	//
	//	this is the site form
	//
	
	// get icons from server (this already happens while the login form is active)
	$.post(base_url+'services/json', {method: '"ogm_api.icons"'}, function(data) {
		if (data === null || data['#error'] == true || (data['#data'] && data['#data']['#error'] == true)) {
			$('#icon').html('<option>Error retrieving icons</option>');
			return;
		}
		$('#icon').html('');
		for (var i in data['#data']) {
			for (var j in data['#data'][i]['children']) {
				for (var k in data['#data'][i]['children'][j]['children']) {
					// the value should probably be html-encoded here
					$('#icon').append('<option value="'+data['#data'][i]['children'][j]['children'][k]['name']+'">'+data['#data'][i]['children'][j]['children'][k]['name']+'</option>');
				}
			}
		}
		$('#icon').removeAttr('disabled');
	}, 'json');
	
	// get countries from server (same as above)
	$.post(base_url+'services/json', {method: '"ogm_api.countries"'}, function(data) {
		if (data === null || data['#error'] == true || (data['#data'] && data['#data']['#error'] == true)) {
			$('#country').html('<option>Error retrieving countries</option>');
			return;
		}
		// retrieve default country form cookie, default to usa
		if ($.cookie('ogm_submit_country')) {
			var country = $.cookie('ogm_submit_country');
		} else {
			// default
			var country = 'us';
		}
		$('#country').html('');
		for (var i in data['#data']) {
			// the value should probably be html-encoded here
			if (data['#data'][i]['code'] == country) {
				$('#country').append('<option value="'+data['#data'][i]['code']+'" selected="selected">'+data['#data'][i]['name']+'</option>');
			} else {
				$('#country').append('<option value="'+data['#data'][i]['code']+'">'+data['#data'][i]['name']+'</option>');
			}
		}
		$('#country').removeAttr('disabled');
	}, 'json');
	
	// this is the latitude & longitude (false until we have valid data)
	var ogm_submit_lat = false;
	var ogm_submit_long = false;
	
	// clear dummy name
	$('#name').bind('focus', function(e) {
		if ($(this).attr('value') == 'name of site here') {
			$(this).attr('value', '');
		}
	});
	
	// clear dummy details
	$('#details').bind('focus', function(e) {
		if ($(this).attr('value') == 'put some details here') {
			$(this).attr('value', '');
		}
	});
	
	// handle the submit button
	$('#ogm_submit_site').bind('submit', function(e) {
		// sanity check of input
		if ($('#icon').attr('disabled')) {
			alert('Cannot submit site due to icons missing, please try again later');
			return false;
		}
		if ($('#country').attr('disabled')) {
			alert('Cannot submit site due to countries missing, please try again later');
			return false;
		}
		if (ogm_submit_lat === false) {
			alert('Could not determine your location, thus not submitting the site to the server');
			return false;
		}
		if ($('#name').attr('value') == 'name of site here' || $('#name').attr('value') == '') {
			alert('Please enter a site name');
			$('#name').focus();
			return false;
		}
		if ($('#details').attr('value') == 'put some details here'|| $('#details').attr('value') == '') {
			alert('Please enter a description');
			$('#details').focus();
			return false;
		}
		
		// disable submit button
		$('#ogm_submit_site_submit').attr('disabled', 'disabled');
		$('#ogm_submit_site_submit').attr('value', 'submitting..');
		
		// setup site object
		var site = {
			name: $('#name').attr('value'),
			details: $('#details').attr('value'),
			icon: $('#icon').attr('value'),
			latitude: ogm_submit_lat,
			longitude: ogm_submit_long,
			country: $('#country').attr('value')
		};
		// DEBUG
		//console.log(site);
		
		// save country as cookie
		$.cookie('ogm_submit_country', site.country, { expires: 365 });
		
		// submit ajax request
		$.post(base_url+'services/json', {method: '"ogm_api.submit_site"', username: JSON.stringify($('#username').attr('value')), password: JSON.stringify($('#password').attr('value')), map: JSON.stringify($('#map').attr('value')), site: JSON.stringify(site)}, function(data) {
		
			// handle errors
			if (data == null) {
				alert('There was an error submitting the site, please try again later');
				$('#ogm_submit_site_submit').removeAttr('disabled');
				return;
			} else if (data['#error'] == true || data['#data']['#error'] == true) {
				alert('There was an error submitting the site: '+data['#data']['#message']);
				$('#ogm_submit_site_submit').removeAttr('disabled');
				return;
			}
			
			// add link to success div
			$('#ogm_submit_success').append('<form class="panel"><fieldset><div class="row first"><a href="'+base_url+'node/'+data['#data']+'">View your site</a></div><div class="row last"><a href="'+base_url+'node/'+data['#data']+'/edit">Add Details</a></div></fieldset></form>');
			
			// hide site form, show success div
			$('#ogm_submit_site').css('display', 'none');
			$('#ogm_submit_success').css('display', 'block');
		}, 'json');
		
		// to prevent the default browser action
		return false;
	});
	
});