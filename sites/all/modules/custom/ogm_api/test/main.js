$(document).ready(function() {
	$('#username').bind('focus', function(e) {
		if ($(this).attr('value') == 'username here') {
			$(this).attr('value', '');
		}
	});
	$('#password').bind('focus', function(e) {
		if ($(this).attr('value') == 'password here') {
			$(this).attr('value', '');
		}
	});
	$('#name').bind('focus', function(e) {
		if ($(this).attr('value') == 'name of site here') {
			$(this).attr('value', '');
		}
	});
	$('#latitude').bind('focus', function(e) {
		if ($(this).attr('value') == 'latitude here') {
			$(this).attr('value', '');
		}
	});
	$('#longitude').bind('focus', function(e) {
		if ($(this).attr('value') == 'longitude here') {
			$(this).attr('value', '');
		}
	});
	
	// get maps
	$.post('proxy.php', {method: '"ogm_api.maps"'}, function(data) {
		if (data['#error'] == true) {
			alert('There was an error retrieving the maps');
		}
		for (var i in data['#data']) {
			// the value should probably be html-encoded here
			$('#map').append('<option value="'+data['#data'][i]['name']+'">'+data['#data'][i]['name']+'</option>');
		}
	}, 'json');
	
	// get icons
	$.post('proxy.php', {method: '"ogm_api.icons"'}, function(data) {
		if (data['#error'] == true) {
			alert('There was an error retrieving the icons');
		}
		for (var i in data['#data']) {
			for (var j in data['#data'][i]['children']) {
				for (var k in data['#data'][i]['children'][j]['children']) {
					// the value should probably be html-encoded here
					$('#icon').append('<option value="'+data['#data'][i]['children'][j]['children'][k]['name']+'">'+data['#data'][i]['children'][j]['children'][k]['name']+'</option>');
				}
			}
		}
	}, 'json');
	
	$('#ogm_submit_site').bind('submit', function(e) {
		var site = {
			name: $('#name').attr('value'),
			// this is hardcorded for now
			details: 'This is a test site, created using the OGM API.',
			icon: $('#icon').attr('value'),
			latitude: $('#latitude').attr('value'),
			longitude: $('#longitude').attr('value'),
			// this as well
			country: 'us'
		};
		// DEBUG
		//console.log(site);
		$.post('proxy.php', {method: '"ogm_api.submit_site"', username: JSON.stringify($('#username').attr('value')), password: JSON.stringify($('#password').attr('value')), map: JSON.stringify($('#map').attr('value')), site: JSON.stringify(site)}, function(data) {
			if (data['#error'] == true || data['#data']['#error'] == true) {
				$('body').append('<div class="error">'+data['#data']['#message']+'</div>');
			} else {
				// TODO: change to your host
				$('body').append('<div class="success"><a href="http://localhost/opengreenmap/node/'+data['#data']+'">Node '+data['#data']+' created, click to view</a></div>');
			}
		}, 'json');
		return false;
	});
	
});