/**
 *	Helper Functions
 */


// Miikkas magic
var key_states = [];


/**
 *	show/hide an icon tid.
 *
 *	The relevant code is in gmap_marker/gmap_groupmarker.js.
 *	@param tid		tid
 *	@param enable		true to show, false to hide
 */
function displayTid(tid, enable) {
	if (enable){
		key_states[tid] = true;
		GlobalObj.gm.showGroupByName(tid);
    ogmOlAddPolies(GlobalObj.gm.map, tid);
	}
  else {
		key_states[tid] = false;
		GlobalObj.gm.hideGroupByName(tid);
    ogmOlRemovePolies(GlobalObj.gm.map, tid);
	}


}


/**
 *	return the tid from a DOM id.
 *
 *	The DOM id must have the id after the last underscore (e.g. foo_bar_23).
 *	@param id		id string
 *	@return		id (string)
 */
function getTidFromId(id) {
	pos = id.lastIndexOf('_');
	if (pos != -1) {
		return id.substring(pos+1);
	} else {
		return '';
	}
}


/**
 *	check/uncheck a checkbox.
 *
 *	@param obj		checkbox (jQuery object)
 *	@param enable		true to check, false to uncheck
 */
function toggleCheckbox(obj, enable) {
	if (enable) {
		obj.attr('checked', 'true');
        }
	else {
		obj.removeAttr('checked');
        }
}


/**
 *	enable/disable an icon and make the relevant changes on the map.
 *
 *	@param obj		icon (jQuery object, we use a <div> here)
 *	@param enable		true to enable icon, false to disable
 */
function toggleIcon(obj, enable) {
	// update map
	jQuery.each(obj, function() {
		displayTid(getTidFromId($(this).attr('id')), enable);
	});
	// change opacity and add/remove class
	if (enable) {
		obj.css('opacity', 1.0);
		obj.removeClass('key_icon_disabled');
	} else {
		obj.css('opacity', 0.3);
		obj.addClass('key_icon_disabled');
	}
}


/**
 *	Event Handlers
 */

/**
 *	being called when the user clicks a genre checkbox.
 */
function keyCheckboxGenre_OnChange() {
	var checked = $(this).attr('checked');

	// check/uncheck all child categories
	toggleCheckbox($(this).parents('.key_genre_title').find('.key_checkbox_category'), checked);

	// enable/disable all child icons
	toggleIcon($(this).parents('.key_genre_title').find('.key_icon'), checked);
}


/**
 *	being called when the user clicks a category checkbox.
 */
function keyCheckboxCategory_OnChange() {
	var checked = $(this).attr('checked');

	// make sure the parent genre is also checked
	var parent = $(this).parents('.key_genre_title').find('.key_checkbox_genre');
	if (checked && !parent.attr('checked'))
		parent.attr('checked', 'true');

	// enable/disable all child icons
	toggleIcon($(this).parents('.key_category_title').find('.key_icon'), checked);
}


/**
 *	begin called when the user clicks an icon.
 */
function keyIcon_OnClick() {
	var enable = false;
	if ($(this).is('.key_icon_disabled'))
		enable = true;

	// make sure the parent genre is checked
	var parent = $(this).parents('.key_genre_title').find('.key_checkbox_genre');
	if (enable && !parent.attr('checked'))
		parent.attr('checked', 'true');

	// make sure the parent category is checked
	parent = $(this).parents('.key_category_title').find('.key_checkbox_category');
	if (enable && !parent.attr('checked'))
		parent.attr('checked', 'true');

	toggleIcon($(this), enable);
}


/**
 *	display the informative bubble control when hovering over the keys for the first time.
 */
// function key_OnMouseOver() {
//   if (!gInfoBubbleIcons && getCookie("seen_infobubbleicons") == null) {
//     try {
//       // see gmap_bubble/gmap_bubble.js
//       // display bubble control
//       gInfoBubbleIcons = new InfoBubbleIcons();
//       GlobalMap.addControl(gInfoBubbleIcons);
//
//       // set session coockie
//       setCookie("seen_infobubbleicons", "1", null);
//
//       // fade out after 5 seconds
//       setTimeout(function() {
// /*        $('#infobubbleicons_container').fadeOut('slow', function() {
//           GlobalMap.removeControl(gInfoBubbleIcons);
//         });*/
//
//         $('#startarrow').fadeOut('slow', function() {});
//       }, 5000);
//     }
//     catch (e) {
//     }
//   }
// }


function key_OnMouseOver() {
  $('#startarrow').fadeOut('slow', function() {});
}


/**
 *	Cookie helper Code
 */

// taken from http://www.w3schools.com/JS/js_cookies.asp, modified

function setCookie(name, value, expires) {
	var exdate = new Date();
	exdate.setDate(exdate.getDate()+expires);
	document.cookie = name+"="+escape(value)+((expires==null) ? "" : ";expires="+exdate.toGMTString());
}


function getCookie(name) {
	if (document.cookie.length > 0) {
		c_start = document.cookie.indexOf(name + "=");
		if (c_start != -1) {
			c_start = c_start + name.length+1;
			c_end=document.cookie.indexOf(";", c_start);
			if (c_end==-1)
				c_end=document.cookie.length;
			return unescape(document.cookie.substring(c_start, c_end));
		}
	}
	return null;
}


/**
 *	Main Code
 */

$(document).ready(function() {
	// collapse all
	$('.key_genre_content').css('display', 'block');		// temporarily set to display none during loading
	$('.key_genre_content').hide(0);

	// check all genre/category checkboxes (for FF reload)
	$('.key_checkbox_genre').attr('checked', 'true');
	$('.key_checkbox_category').attr('checked', 'true');

	// register event handlers
	$('.key_checkbox_genre').click(keyCheckboxGenre_OnChange);	// change does not work for IE7..
	$('.key_checkbox_category').click(keyCheckboxCategory_OnChange);
	$('.key_icon').click(keyIcon_OnClick);

	// this is for the informative bubbles
	$('#keys').mouseover(key_OnMouseOver);
	$('#infobubblezoom_container').click(function() {
		$(this).fadeOut('slow');
	});



});



/**
 *	minimize/maximize elements in the key ui element.
 *
 *	used for genres and categories.
 *	@param name		id of the content div
 *	@param	title		id of the title div (for the arrow icon)
 */
function toggleElement(name, title) {
  $('#'+name).toggle('slow');
  if ($('#'+title).is('.key_expanded')) {
    $('#'+title).removeClass('key_expanded');
    $('#'+title).removeClass(title+'_expanded');
    $('#'+title).addClass(title+'_collapsed');
  }
  else {
    $('#'+title).addClass('key_expanded');
    $('#'+title).addClass(title+'_expanded');
    $('#'+title).removeClass(title+'_collapsed');

  }
}


/**
 *	minimize all other genres except the one that got clicked.
 *
 *	also calls toggleElement().
 *	@param name		id of the content div
 *	@param title		id of the title div (for the arrow icon)
 */
function toggleGenre(name, title) {
	// hide all other genres exept the clicked one
	$('.key_genre_content:not(#'+name+')').hide('slow');
	$('.key_genre_title:not(#'+title+')').removeClass('key_expanded');

	// do stuff with the clicked genre
	toggleElement(name, title);
}
