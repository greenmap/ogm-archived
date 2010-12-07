<?php
/**
 * Implementation of hook_views_default_views().
 */
function maps_proximity_views_default_views() {
  /*
   * View 'maps proximity'
   */
$view = new view;
$view->name = 'proximity_maps';
$view->description = 'List of maps ordered by distance from a location';
$view->tag = 'location';
$view->view_php = '';
$view->base_table = 'node';
$view->is_cacheable = FALSE;
$view->api_version = 2;
$view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */
$handler = $view->new_display('default', 'Defaults', 'default');
$handler->override_option('relationships', array(
  'group_nid' => array(
    'label' => 'Group node (post)',
    'required' => 0,
    'id' => 'group_nid',
    'table' => 'og_ancestry',
    'field' => 'group_nid',
    'relationship' => 'none',
  ),
));
$handler->override_option('fields', array(
  'vid' => array(
    'label' => '',
    'alter' => array(
      'alter_text' => 0,
      'text' => '',
      'make_link' => 0,
      'path' => '',
      'link_class' => '',
      'alt' => '',
      'prefix' => '',
      'suffix' => '',
      'help' => '',
      'trim' => 0,
      'max_length' => '',
      'word_boundary' => 1,
      'ellipsis' => 1,
      'strip_tags' => 0,
      'html' => 0,
    ),
    'exclude' => 1,
    'id' => 'vid',
    'table' => 'node_revisions',
    'field' => 'vid',
    'override' => array(
      'button' => 'Override',
    ),
    'relationship' => 'none',
  ),
  'title' => array(
    'label' => '',
    'alter' => array(
      'alter_text' => 1,
      'text' => '<a href="node/add/green-site?suggest=[vid]" alt="suggest a green site to [title]" title="suggest a green site to [title]">[title]</a>',
      'make_link' => 0,
      'path' => '',
      'link_class' => '',
      'alt' => '',
      'prefix' => '',
      'suffix' => '',
      'help' => '',
      'trim' => 0,
      'max_length' => '',
      'word_boundary' => 1,
      'ellipsis' => 1,
      'strip_tags' => 0,
      'html' => 0,
    ),
    'link_to_node' => 0,
    'exclude' => 0,
    'id' => 'title',
    'table' => 'node',
    'field' => 'title',
    'relationship' => 'none',
  ),
  'distance' => array(
    'label' => '',
    'alter' => array(
      'alter_text' => 0,
      'text' => '',
      'make_link' => 0,
      'path' => '',
      'link_class' => '',
      'alt' => '',
      'prefix' => '',
      'suffix' => '',
      'help' => '',
      'trim' => 0,
      'max_length' => '',
      'word_boundary' => 1,
      'ellipsis' => 1,
      'strip_tags' => 0,
      'html' => 0,
    ),
    'origin' => 'tied',
    'units' => 'mi',
    'latitude' => '',
    'longitude' => '',
    'exclude' => 0,
    'id' => 'distance',
    'table' => 'location',
    'field' => 'distance',
    'relationship' => 'none',
  ),
));
$handler->override_option('sorts', array(
  'distance' => array(
    'order' => 'ASC',
    'origin' => 'tied',
    'units' => 'km',
    'latitude' => '',
    'longitude' => '',
    'id' => 'distance',
    'table' => 'location',
    'field' => 'distance',
    'relationship' => 'none',
  ),
));
$handler->override_option('filters', array(
  'distance' => array(
    'operator' => 'mbr',
    'value' => array(
      'latitude' => '',
      'longitude' => '',
      'postal_code' => '',
      'country' => '',
      'search_distance' => '1000',
      'search_units' => 'mile',
    ),
    'group' => '0',
    'exposed' => TRUE,
    'expose' => array(
      'use_operator' => 0,
      'operator' => 'distance_op',
      'identifier' => 'distance',
      'label' => 'Location',
      'optional' => 0,
      'remember' => 1,
    ),
    'type' => 'latlon',
    'identifier' => 'dist',
    'id' => 'distance',
    'table' => 'location',
    'field' => 'distance',
    'relationship' => 'none',
  ),
  'status' => array(
    'operator' => '=',
    'value' => '1',
    'group' => '0',
    'exposed' => FALSE,
    'expose' => array(
      'operator' => FALSE,
      'label' => '',
    ),
    'id' => 'status',
    'table' => 'node',
    'field' => 'status',
    'relationship' => 'none',
  ),
  'type' => array(
    'operator' => 'in',
    'value' => array(
      'green_site' => 'green_site',
    ),
    'group' => '0',
    'exposed' => FALSE,
    'expose' => array(
      'operator' => FALSE,
      'label' => '',
    ),
    'id' => 'type',
    'table' => 'node',
    'field' => 'type',
    'relationship' => 'none',
  ),
  'private' => array(
    'operator' => '=',
    'value' => '0',
    'group' => '0',
    'exposed' => FALSE,
    'expose' => array(
      'operator' => FALSE,
      'label' => '',
    ),
    'id' => 'private',
    'table' => 'og',
    'field' => 'private',
    'relationship' => 'none',
  ),
));
$handler->override_option('access', array(
  'type' => 'none',
));
$handler->override_option('cache', array(
  'type' => 'none',
));
$handler->override_option('title', 'Green Maps near you');
$handler->override_option('header', 'Please select a map that you would like suggest a site to.');
$handler->override_option('header_format', '4');
$handler->override_option('header_empty', 0);
$handler->override_option('empty', '<center>There are no maps in your area. If you are interested in creating a Green Map please email info@greenmap.org<br>
Thank You!</center>');
$handler->override_option('empty_format', '3');
$handler->override_option('items_per_page', 20);
$handler->override_option('use_pager', 'mini');
$handler->override_option('style_plugin', 'list');
$handler->override_option('style_options', array(
  'grouping' => '',
  'type' => 'ul',
));
$handler->override_option('row_options', array(
  'inline' => array(
    'vid' => 'vid',
    'title' => 'title',
    'distance' => 'distance',
  ),
  'separator' => '',
));
$handler->override_option('exposed_block', TRUE);
$handler = $view->new_display('page', 'Page', 'page_2');
$handler->override_option('filters', array(
  'status_extra' => array(
    'id' => 'status_extra',
    'table' => 'node',
    'field' => 'status_extra',
  ),
  'distance' => array(
    'operator' => 'mbr',
    'value' => array(
      'latitude' => '',
      'longitude' => '',
      'postal_code' => '',
      'country' => '',
      'search_distance' => '10000',
      'search_units' => 'mile',
    ),
    'group' => '0',
    'exposed' => TRUE,
    'expose' => array(
      'use_operator' => 0,
      'operator' => 'distance_op',
      'identifier' => 'distance',
      'label' => 'Location: Distance / Proximity',
      'optional' => 1,
      'remember' => 0,
    ),
    'type' => 'latlon',
    'identifier' => 'dist',
    'id' => 'distance',
    'table' => 'location',
    'field' => 'distance',
    'relationship' => 'none',
    'override' => array(
      'button' => 'Use default',
    ),
  ),
  'type' => array(
    'operator' => 'in',
    'value' => array(
      'green_map' => 'green_map',
    ),
    'group' => '0',
    'exposed' => FALSE,
    'expose' => array(
      'operator' => FALSE,
      'label' => '',
    ),
    'id' => 'type',
    'table' => 'node',
    'field' => 'type',
    'relationship' => 'none',
    'override' => array(
      'button' => 'Use default',
    ),
  ),
  'private' => array(
    'operator' => '=',
    'value' => '0',
    'group' => '0',
    'exposed' => FALSE,
    'expose' => array(
      'operator' => FALSE,
      'label' => '',
    ),
    'id' => 'private',
    'table' => 'og',
    'field' => 'private',
    'override' => array(
      'button' => 'Use default',
    ),
    'relationship' => 'none',
  ),
));
$handler->override_option('path', 'maplocate');
$handler->override_option('menu', array(
  'type' => 'none',
  'title' => '',
  'description' => '',
  'weight' => 0,
  'name' => 'navigation',
));
$handler->override_option('tab_options', array(
  'type' => 'none',
  'title' => '',
  'description' => '',
  'weight' => 0,
));
//end of view export
  $views[$view->name] = $view;

  return $views;
}
