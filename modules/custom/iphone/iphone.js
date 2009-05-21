/**
 *	Main Code
 */

$(document).ready(function() {
	// collapse all
	$('.genre_content').css('display', 'block');		// temporarily set to display none during loading
	$('.genre_content').hide(0);

	
	$('.genre').click(function() {
		genre_OnChange(this.id);
		return false;
	});	// change does not work for IE7..

	
    setInterval(updateLayout, 400);
	

});

function genre_OnChange(id)
{
	//var checked = $(this).attr('checked');
	if($('#'+id+'-list').is(':visible')){
		$('.genre_content').hide(0);
		//$('#'+id+'-list').hide('slow');
	}else {
		$('#'+id+'-list').show('slow');
		$('.genre_content:not(#'+id+'-list)').hide(0);
	}
	
	
	
	
	// check/uncheck all child categories
//	toggleCheckbox($(this).parents('.key_genre_title').find('.key_checkbox_category'), checked);

};
var iPhoneLat,iPhoneLon;
function iPhoneLocate(lat,lon){
	iPhoneLat = lat;
	iPhoneLon = lon;
	//alert(lat + " " + lon);
};

function iPhoneSearch(searchText){
	
}
function iPhoneFilter(filterText){
	//alert(filterText);
}

var currentWidth = 0;
function updateLayout(){
    if (window.innerWidth != currentWidth) {
        currentWidth = window.innerWidth;
        var orient = currentWidth == 320 ? "profile" : "landscape";
        document.body.setAttribute("orient", orient);
		document.getElementById('page').style.width = window.innerWidth + "px";
		document.getElementById('page').style.height = window.innerHeight + "px";
	//	alert(document.getElementById('page').style.height);
		
        setTimeout(function(){
            window.scrollTo(0, 1);
        }, 100);
    }
}



