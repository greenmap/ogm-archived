var num = 0;

Drupal.addFieldset = function(){
	num = num + 1;
	var div = document.createElement('div');
    div.innerHTML = group_invite_new_team_member.replace(/%NUM%/g, num);
	document.getElementById('group_invite_content').appendChild(div);
}
selectMap = function(mid,num) {
	if (document.getElementById(mid + "map" + num).checked == true) {
		var inner = group_invite_selectMap.replace(/%NUM%/g, num);
		inner = inner.replace(/%MNUM%/g, mid);
		
		document.getElementById("DIV" + mid + "map" + num).innerHTML = inner;
	} else {
		document.getElementById("DIV" + mid + "map" + num).innerHTML = "";
	}
}
checkEmail = function(email,num){
	//alert(num);
	if(email == ""){
		document.getElementById("inDB"+num).value = '0';
		return;
	}
	var http_request = Drupal.makeReq(Drupal_base_path + 'group_invite/checkemail/'+email,'');
		http_request.onreadystatechange = function() {
			if (http_request.readyState != 4) {return;}
			if (http_request.status == 200) {// success
				if(http_request.responseText == ''){
					// empty
					document.getElementById("inDB"+num).value = '0';
					document.getElementById("DIVemail"+num).innerHTML = "";
				} else if(http_request.responseText == 'FALSE'){
					// new email
					document.getElementById("inDB"+num).value = '0';
					document.getElementById("DIVemail"+num).innerHTML = "New member";
				} else if(http_request.responseText == "ERROR"){
					// email doesn't meet our requirements
					document.getElementById("inDB"+num).value = '0';
					document.getElementById("DIVemail"+num).innerHTML = "Email address is not valid";
				} else if(http_request.responseText == "ERROR2"){
					// user tries to invite him/her self
					document.getElementById("inDB"+num).value = '0';
					document.getElementById("DIVemail"+num).innerHTML = "It is forbidden to change your own roles";
				} else {
					// in the DB
					document.getElementById("inDB"+num).value = '1';
				//	alert(document.getElementById("inDB"+num).value);
					document.getElementById("DIVemail"+num).innerHTML = "Old member of the Open Green Map";
					var uid = http_request.responseText;
					var role_request = Drupal.makeReq(Drupal_base_path + 'group_invite/getRoles/'+uid,'');
					role_request.onreadystatechange = function(){
						if (role_request.readyState != 4) {return;}
						if (role_request.status == 200) {// success
							// parse data
							// <mapNid:role>
							var data = role_request.responseText;
							// parse: < (what ever) : (what ever) >
							var lines = data.split(/[<]([^:]+)[:]([^>]+)[>]/);
							// parse leaves first cell of every data blank thats why there are three cells per data
							// example: [0] => empty, [1] => mapNid, [2] => role, [3] => empty ...
							for(var i =0; i< lines.length;i+= 3) {
								// avoid empty data problem
								if(!lines[i + 1] || !lines[i + 2]){continue;}
								// ignore data in cell number i and use only (i + 1) and (i +2)
								var nid = lines[i + 1];
								var rid = lines[i + 2];
								// select the map
								document.getElementById(nid + "map"+num).checked = true;
								selectMap(nid,num);
								// set the role of a map
								var roles = document.getElementsByName(nid + "role"+num);
								for(var c = 0;c<roles.length;c++){
									if(roles[c].value != rid){continue;}
									roles[c].checked='checked';
								}
							}
							
							// set options
						} else {// failed
							alert('problems with ajax query');
						}
					};
				}
			} else {// failed
				document.getElementById("DIVemail"+num).innerHTML = "Email checking failed";
			}
	};
}
// group_invite_new_team_member

Drupal.addFieldset();

Drupal.onTyped = function(){
	Drupal.addFieldset();
}

	//Drupal.makeRequest(Drupal_base_path + 'node/widget/onmapchange/'+nid,'',"onMapChangeReturn",nid);
	
/*Drupal.onMapChangeReturn = function(http_request,returnArgs) {
	//document.getElementById('DIV'+returnArgs.attributes.getNamedItem('name').value).innerHTML = http_request.responseText;

	if (http_request.responseText == '') {return;}
	// var lat,var lon,var zoom,var type
	eval(http_request.responseText);
	//alert(lat + " " + lon);
	
	if(!lat || !lon || !zoom || !type){return;}
	// lat
	document.getElementById('lat').value = lat;
	// lon
	document.getElementById('lon').value = lon;
	// zoom
	document.getElementById('zoom').selectedIndex = zoom;
	// maptype
	document.getElementById('maptype').value = type;

	Drupal.onChange();
	
	var id = 'fieldset_map_settings';
	Drupal.openFieldset(id);
	var id = 'fieldset_html_codes';
	Drupal.openFieldset(id);
	var id = 'fieldset_map_view';
	Drupal.openFieldset(id);
}*/