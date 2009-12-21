<?php
function widget_views_default_views() {

  $included_views = array(
      'widget.views.map_widget.inc' =>
        'widget_map_widget_views_default_views',
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
