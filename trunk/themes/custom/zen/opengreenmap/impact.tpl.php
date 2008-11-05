<?php 

/**
 * views template to output one 'row' of a view.
 * This code was generated by the views theming wizard
 * Date: Tue, 07/01/2008 - 13:23
 * View: list_of_impacts_for_site
 *
 * Variables available:
 * $view -- the entire view object. Important parts of this object are
 *   list_of_impacts_for_site, .
 * $view_type -- The type of the view. Probably 'page' or 'block' but could
 *   also be 'embed' or other string passed in from a custom view creator.
 * $node -- the raw data. This is not a real node object, but will contain
 *   the nid as well as other support fields that might be necessary.
 * $count -- the current row in the view (not TOTAL but for this page) starting
 *   from 0.
 * $stripe -- 'odd' or 'even', alternating. * $title -- Display the title of the node.
 * $title_label -- The assigned label for $title
 * $created -- Display the post time of the node. The option field may be used to specify the custom date format as it's required by the date() function or if "as time ago" has been chosen to customize the granularity of the time interval.
 * $created_label -- The assigned label for $created
 * $field_comments_about_the_impact_value -- 
 * $field_comments_about_the_impact_value_label -- The assigned label for $field_comments_about_the_impact_value
 *
 * This function goes in your views-list-list_of_impacts_for_site.tpl.php file
 */
 
 
 //now we add the stylesheet...
  drupal_add_css(path_to_subtheme() .'/views-list-list_of_impacts_for_site.css');
  
  ?>
<div class="<?php print $stripe; ?>">
	<span class="view-label view-field-title">
	  <?php print $title_label ?>
	</span>
	<span class="view-field view-data-title">
	  <?php print $title?>
	</span>
	
	<span class="view-label view-field-created">
	  <?php print $created_label ?>
	</span>
	<span class="view-field view-data-created">
	  <?php print $created?>
	</span>
	
	<span class="view-label view-field-field-comments-about-the-impact-value">
	  <?php print $field_comments_about_the_impact_value_label ?>
	</span>
	<span class="view-field view-data-field-comments-about-the-impact-value">
	  "<?php print $field_comments_about_the_impact_value?>"
	</span>
</div>
