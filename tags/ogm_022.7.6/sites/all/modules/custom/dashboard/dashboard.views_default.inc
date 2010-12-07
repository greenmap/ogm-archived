<?php
function dashboard_views_default_views() {

  // these functions could probably have better names
  $included_views = array(
      'dashboard.views.dashboard_sites.inc' =>
        'dashboard_sites_views_default_views',
      'dashboard.views.comments.inc' =>
        'comments_views_default_views',
      'dashboard.views.comments_recent_dashboard_nomap.inc' =>
        'comments_recent_dashboard_nomap_views_default_views',
      'dashboard.views.dashboard_multimedia.inc' =>
        'dashboard_multimedia_views_default_views',
      'dashboard.views.dashboard_photos.inc' =>
        'dashboard_photos_views_default_views',
      'dashboard.views.dashboard_team.inc' =>
        'dashboard_views_team_default_views',
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
