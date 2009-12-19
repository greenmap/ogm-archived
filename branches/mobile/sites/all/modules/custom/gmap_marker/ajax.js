/**
 * @author Miikka Lammela
 * @param url String url typicaly callback menu path processes informaiton example /dev/oqm_miikka/example
 * @param params String POST params to url example: arg1=12&arg2=abc
 * @param returnFunc String name of return handle function example: real name: Drupal.example => string: example
 * @param returnArgs mixed Anything you might need to put to return handler function
 */
Drupal.makeRequest = function (url, params,returnFunc,returnArgs) {
    var http_request = false;
    if (window.XMLHttpRequest) { // Mozilla,...
      http_request = new XMLHttpRequest();
      if (http_request.overrideMimeType) {
        http_request.overrideMimeType('text/xml');
      }
    } else if (window.ActiveXObject) { // Internet Explorer
      try {
        http_request = new ActiveXObject("Msxml2.XMLHTTP");
      } catch (e) {
         try {
           http_request = new ActiveXObject("Microsoft.XMLHTTP");
         } catch (e) {
           alert(Drupal.t('Failed to open XMLHTTP'));
         }
      }
    }

    if (!http_request) {
      alert(Drupal.t('Failed to open XMLHTTP'));
        return false;
    }
   http_request.onreadystatechange = function() {
   		if (http_request.readyState != 4) {
			return;
		}
		// success
		if (http_request.status == 200) {
			// call return handler function
			returnFunc = "Drupal." + returnFunc + "(http_request,returnArgs)";
			eval(returnFunc);
	  	} else {
			// failed
        	alert(Drupal.t('Problems with the ajax (code 101):') + url);
		}
    };

    http_request.open('POST', url, true);
	//Send the proper header information along with the request
	http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http_request.setRequestHeader("Content-length", params.length);
	http_request.setRequestHeader("Connection", "close");
    http_request.send(params);
};

Drupal.openAjax = function() {
	var http_request = false;
    if (window.XMLHttpRequest) { // Mozilla,...
      http_request = new XMLHttpRequest();
      if (http_request.overrideMimeType) {
        http_request.overrideMimeType('text/xml');
      }
    } else if (window.ActiveXObject) { // Internet Explorer
      try {
        http_request = new ActiveXObject("Msxml2.XMLHTTP");
      } catch (e) {
         try {
           http_request = new ActiveXObject("Microsoft.XMLHTTP");
         } catch (e) {
           alert(Drupal.t('Failed to open XMLHTTP'));
         }
      }
    }

    if (!http_request) {
       alert(Drupal.t('Failed to open XMLHTTP'));
       return false;
    }
	return http_request;
};
/**
 * @author Miikka Lammela
 * @param url String url typicaly callback menu path processes informaiton example /dev/oqm_miikka/example
 * @param params String POST params to url example: arg1=12&arg2=abc
 * @return Object
 */
Drupal.makeReq = function (url, params) {
	var http_request = Drupal.openAjax();
  /*  var http_request = false;
    if (window.XMLHttpRequest) { // Mozilla,...
      http_request = new XMLHttpRequest();
      if (http_request.overrideMimeType) {
        http_request.overrideMimeType('text/xml');
      }
    } else if (window.ActiveXObject) { // Internet Explorer
      try {
        http_request = new ActiveXObject("Msxml2.XMLHTTP");
      } catch (e) {
         try {
           http_request = new ActiveXObject("Microsoft.XMLHTTP");
         } catch (e) {
           alert('Failed to open XMLHTTP');
         }
      }
    }

    if (!http_request) {
      alert('Failed to open XMLHTTP');
        return false;
    }*/

    http_request.open('POST', url, true);
	//Send the proper header information along with the request
	http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http_request.setRequestHeader("Content-length", params.length);
	http_request.setRequestHeader("Connection", "close");
    http_request.send(params);
	return http_request;
	
};
