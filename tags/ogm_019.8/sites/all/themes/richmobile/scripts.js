var Drupal_base_path = '<?php print base_path()?>';
  
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));

try{
  	var pageTracker = _gat._getTracker("UA-418876-6");
  	pageTracker._trackPageview();
} catch(err) {}
	   	
	   	
function showElement(navwin){
	var navwin = document.getElementById(navwin);
	if(navwin.style.display=="none"){
	navwin.style.display="block";
	menu.backgroundPosition="top";
	} else {
	navwin.style.display="none";
	}
}
	   	