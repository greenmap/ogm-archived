/**
 * by tom_o_t - aka Thomas Turnbull for Green Map System
 * Javascript for the map 
 */


/**
 * links to the tabs in the navigation
 */
$(function() { 
	$('<span class="more"><a href="#">more >><\/a><\/span>').appendTo('#trimmed-description').find('a').click(function() {
		// $('#tabs-tabskey > ul').tabs('select', 2);
		$('#tabs-tabskey > ul > li.active').removeClass("tabs-selected active");
		$('#tabs-tabskey > ul > li:eq(1)').addClass("tabs-selected active");
		$('#tabs-tabskey-1').addClass("tabs-hide");
		$('#tabs-tabskey-1').hide();
		$('#tabs-tabskey-2').removeClass("tabs-hide");
		// return false;
	});
	

});


/**
 * Slide animation stuff
 
    $("a").toggle(function(){
     $(".title").animate({ height: 'hide', opacity: 'hide' }, 'slow');
   },function(){
     $(".title").animate({ height: 'show', opacity: 'show' }, 'slow');
   });
   
 */