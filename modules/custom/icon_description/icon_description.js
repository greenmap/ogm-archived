function getTid(id)
{
	pos = id.lastIndexOf('_');
	if (pos != -1) {
		return id.substring(pos+1);
	} else {
		return '';
	}
}


function keyIcon_OnMouseOver(e)
{
	
	// create a div and append it to the body
	var container = document.createElement('div');
	container.innerHTML = '<h4 class="icon_description_tooltip_title">' + $(this).find('img').attr('alt') + '</h4><p class="icon_description_tooltip_full">' + $(this).find('img').attr('rel') + '</p>';
	container.setAttribute('class', 'icon_description_tooltip');
	container.style.display = 'none';
	container.style.top = e.pageY + 'px';
	document.getElementsByTagName('body')[0].appendChild(container);
	

	
	// display the div (seems to work)
	$('.icon_description_tooltip_full').show('slow');
	$('.icon_description_tooltip').fadeIn();

	// get full description (AJAX) and display it when ready
	/*var req = Drupal.makeReq(Drupal_base_path + 'icon/description/' + getTid($(this).id()), '');
	req.onreadystatechange = function() {
		if (req.readyState != 4) {
			return;
		}
		if (req.status == 200) {
			$('.icon_description_tooltip_full').html(req.responseText);
			$('.icon_description_tooltip_full').show('slow');
		}
	}*/
}


function keyIcon_OnMouseOut()
{
	// remove any div from the DOM tree
	jQuery.each($('.icon_description_tooltip'), function() {
		document.getElementsByTagName('body')[0].removeChild(this);
	});
}


$(document).ready(function() {
	//$('.key_icon').mouseover(keyIcon_OnMouseOver);
	//$('.key_icon').mouseout(keyIcon_OnMouseOut);
	$('.key_icon').hoverIntent(keyIcon_OnMouseOver,keyIcon_OnMouseOut);

	// hide the title as we're replacing with our own custom function
	jQuery.each($('.key_icon img'), function() {
		//$(this).attr('alt', $(this).attr('title')); // cutting gottfried's switch?
		//$(this).attr('title', '');
			// hide the title tooltip as we're replacing it with this custom div
		var description = $(this).attr('title');
		$(this).attr('rel', description);
		$(this).attr('title', '');
	});
});