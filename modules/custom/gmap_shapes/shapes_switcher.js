
/*
* tom_o_t
* function to react to switching to adding a line/shape instead of a point
*/


$(document).ready(function() {
	// register event handlers
	$('.gmap_type_radios').click(optionType_OnClick);
});

/**
 *	being called when the user clicks a genre checkbox.
 */
function optionType_OnClick()
{
	var checked = $(this).attr('checked');
  var shapesloc = window.location;
  if(this.value == 'point'){
    console.log("this is " + this.value);
    // $.get(Drupal_base_path + "node/add/green-site/area");
    window.location=window.location + "&poly=point";
  } else if (this.value == 'area'){
    console.log("this is " + this.value);
    // $.get(Drupal_base_path + "node/add/green-site/area");
    window.location=window.location + "&poly=area";
  } else if (this.value == 'line'){
    console.log("this is " + this.value);
    // $.get(Drupal_base_path + "node/add/green-site/line");
    // $('html').load(Drupal_base_path + "node/add");
    //window.location(Drupal_base_path + "node/add");
    // window.location=Drupal_base_path + "node/add/green-site/line";
    window.location=window.location + "&poly=line";
  }
  
	// check/uncheck all child categories
	// toggleCheckbox($(this).parents('.key_genre_title').find('.key_checkbox_category'), checked);

	// enable/disable all child icons
	// toggleIcon($(this).parents('.key_genre_title').find('.key_icon'), checked);
}