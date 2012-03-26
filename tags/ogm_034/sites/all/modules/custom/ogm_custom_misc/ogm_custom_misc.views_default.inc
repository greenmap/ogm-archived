<?php
// $Id$
function ogm_custom_misc_views_default_views() {
  $included_views = array(
      'ogm_custom_misc.views.flagged_sites.inc' => 'flagged_sites_views_default_views',
      'ogm_custom_misc.views.greenmap.inc' => 'greenmap_views_default_views',
      'ogm_custom_misc.views.list_of_user_sites_nomap.inc' => 'list_of_user_sites_nomap_views_default_views',
      'ogm_custom_misc.views.maps.inc' => 'maps_views_default_views',
      'ogm_custom_misc.views.sites.inc' => 'sites_views_default_views',
      'ogm_custom_misc.views.sites_advanced_management.inc' => 'sites_advanced_management_views_default_views',
      'ogm_custom_misc.views.support_forum.inc' => 'support_forum_views_default_views',
      'ogm_custom_misc.views.testimonials.inc' => 'testimonials_views_default_views',
      'ogm_custom_misc.views.maps_proximity.inc' => 'maps_proximity_views_default_views',
      );

  $views = array();
  foreach ($included_views as $views_file => $views_func) {
    require_once($views_file);
    $this_view = $views_func();
    list($this_view_name) = array_keys($this_view);
    $views[$this_view_name] = $this_view[$this_view_name];
  }

  return $views;
}
