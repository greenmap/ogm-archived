<?php
// $Id: views-view-field.tpl.php,v 1.1 2008/05/16 22:22:32 merlinofchaos Exp $
 /**
  * This template is used to print a single field in a view. It is not
  * actually used in default Views, as this is registered as a theme
  * function which has better performance. For single overrides, the
  * template is perfectly okay.
  *
  * Variables available:
  * - $view: The view object
  * - $field: The field handler object that can process the input
  * - $row: The raw SQL result that can be used
  * - $output: The processed output that will normally be used.
  *
  * When fetching output from the $row, this construct should be used:
  * $data = $row->{$field->field_alias}
  *
  * The above will guarantee that you'll always get the correct data,
  * regardless of any changes in the aliasing that might happen if
  * the view is modified.
  */
  
/* *
 * Here we take the vid (revision id) and get from that the primary term, and from that the Icon.
 * Convoluted I know, but primary_term module doesn't have proper views support.
 */ 
?>
<script type="text/javascript">
 var updateLayout = function() {
  if (window.innerWidth != currentWidth) {
    currentWidth = window.innerWidth;
    var orient = (currentWidth == 320) ? "profile" : "landscape";
    document.body.setAttribute("orient", orient);
    window.scrollTo(0, 1);
  }
};

iPhone.DomLoad(updateLayout);
setInterval(updateLayout, 500);
</script>
<?php 
$vid = $row->{$field->field_alias};
$primary_term_tid = primary_term_get_term($vid);
$icon = taxonomy_image_display($primary_term_tid);
print $icon; ?>