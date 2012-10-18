<?php
function dashboard_views_default_views() {
  $included_views = array(
    'moderate_ogm.views.moderate_comments_recent.inc' =>
      'moderate_ogm_views_moderate_comments_recent',
    'moderate_ogm.views.moderate_list_of_user_sites.inc' =>
      'moderate_ogm_moderate_list_of_user_sites',
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

