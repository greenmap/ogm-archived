<?php
function ogm_mobile_views_default_views() {
  // Proximity view for mobile ------------------------------------------------------------------------
  $view = new view;
  $view->name = 'proximity';
  $view->description = 'List of sites ordered by distance from a location';
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
      'exclude' => 0,
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
      'link_to_node' => 1,
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
      'relationship' => 'group_nid',
    ),
  ));
  $handler->override_option('access', array(
    'type' => 'none',
  ));
  $handler->override_option('cache', array(
    'type' => 'none',
  ));
  $handler->override_option('title', 'Green sites near you');
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
  $handler = $view->new_display('page', 'Page', 'page_1');
  $handler->override_option('path', 'mobile/list');
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
  $handler = $view->new_display('page', 'Page', 'page_2');
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
      'relationship' => 'group_nid',
    ),
    'tid' => array(
      'operator' => 'and',
      'value' => array(),
      'group' => '0',
      'exposed' => TRUE,
      'expose' => array(
        'use_operator' => 0,
        'operator' => 'tid_op',
        'identifier' => 'tid',
        'label' => 'Taxonomy: Term',
        'optional' => 1,
        'single' => 1,
        'remember' => 0,
        'reduce' => 0,
      ),
      'type' => 'select',
      'limit' => TRUE,
      'vid' => '1',
      'id' => 'tid',
      'table' => 'term_node',
      'field' => 'tid',
      'hierarchy' => 1,
      'override' => array(
        'button' => 'Use default',
      ),
      'relationship' => 'none',
      'reduce_duplicates' => 0,
    ),
  ));
  $handler->override_option('path', 'taxsearch');
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
  // End paste from export
  $views[$view->name] = $view;


  // ------- Proximity API -----------

  $view = new view;
  $view->name = 'proximity_api';
  $view->description = 'List of sites ordered by distance from a location for json API';
  $view->tag = 'location';
  $view->base_table = 'node';
  $view->core = 6;
  $view->api_version = '2';
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
    'nid' => array(
      'label' => 'nid',
      'alter' => array(
        'alter_text' => 0,
        'text' => '',
        'make_link' => 0,
        'path' => '',
        'absolute' => 0,
        'link_class' => '',
        'alt' => '',
        'rel' => '',
        'prefix' => '',
        'suffix' => '',
        'target' => '',
        'help' => '',
        'trim' => 0,
        'max_length' => '',
        'word_boundary' => 1,
        'ellipsis' => 1,
        'html' => 0,
        'strip_tags' => 0,
      ),
      'empty' => '',
      'hide_empty' => 0,
      'empty_zero' => 0,
      'hide_alter_empty' => 1,
      'link_to_node' => 0,
      'exclude' => 0,
      'id' => 'nid',
      'table' => 'node',
      'field' => 'nid',
      'relationship' => 'none',
    ),
    'title' => array(
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
      'link_to_node' => 1,
      'exclude' => 0,
      'id' => 'title',
      'table' => 'node',
      'field' => 'title',
      'relationship' => 'none',
    ),
    'tid' => array(
      'label' => 'icon_name',
      'alter' => array(
        'alter_text' => 0,
        'text' => '',
        'make_link' => 0,
        'path' => '',
        'absolute' => 0,
        'link_class' => '',
        'alt' => '',
        'rel' => '',
        'prefix' => '',
        'suffix' => '',
        'target' => '',
        'help' => '',
        'trim' => 0,
        'max_length' => '',
        'word_boundary' => 1,
        'ellipsis' => 1,
        'html' => 0,
        'strip_tags' => 0,
      ),
      'empty' => '',
      'hide_empty' => 0,
      'empty_zero' => 0,
      'hide_alter_empty' => 1,
      'link_to_taxonomy' => 0,
      'exclude' => 0,
      'id' => 'tid',
      'table' => 'primary_term',
      'field' => 'tid',
      'relationship' => 'none',
    ),
    'tid_1' => array(
      'label' => 'icon_image',
      'alter' => array(
        'alter_text' => 0,
        'text' => '',
        'make_link' => 0,
        'path' => '',
        'absolute' => 0,
        'link_class' => '',
        'alt' => '',
        'rel' => '',
        'prefix' => '',
        'suffix' => '',
        'target' => '',
        'help' => '',
        'trim' => 0,
        'max_length' => '',
        'word_boundary' => 1,
        'ellipsis' => 1,
        'html' => 0,
        'strip_tags' => 0,
      ),
      'empty' => '',
      'hide_empty' => 0,
      'empty_zero' => 0,
      'hide_alter_empty' => 1,
      'imagecache_preset' => 'taxonomy_image',
      'link_to_taxonomy' => 0,
      'exclude' => 0,
      'id' => 'tid_1',
      'table' => 'term_image',
      'field' => 'tid',
      'relationship' => 'none',
    ),
    'distance' => array(
      'label' => 'distance',
      'alter' => array(
        'alter_text' => 0,
        'text' => '',
        'make_link' => 0,
        'path' => '',
        'absolute' => 0,
        'link_class' => '',
        'alt' => '',
        'rel' => '',
        'prefix' => '',
        'suffix' => '',
        'target' => '',
        'help' => '',
        'trim' => 0,
        'max_length' => '',
        'word_boundary' => 1,
        'ellipsis' => 1,
        'html' => 0,
        'strip_tags' => 0,
      ),
      'empty' => '',
      'hide_empty' => 0,
      'empty_zero' => 0,
      'hide_alter_empty' => 1,
      'origin' => 'tied',
      'units' => 'mi',
      'latitude' => '',
      'longitude' => '',
      'postal_code' => '',
      'country' => '',
      'php_code' => '',
      'nid_arg' => '',
      'nid_loc_field' => 'node',
      'uid_arg' => '',
      'exclude' => 0,
      'id' => 'distance',
      'table' => 'location',
      'field' => 'distance',
      'relationship' => 'none',
    ),
    'field_details_value' => array(
      'label' => 'details',
      'alter' => array(
        'alter_text' => 0,
        'text' => '',
        'make_link' => 0,
        'path' => '',
        'absolute' => 0,
        'link_class' => '',
        'alt' => '',
        'rel' => '',
        'prefix' => '',
        'suffix' => '',
        'target' => '',
        'help' => '',
        'trim' => 0,
        'max_length' => '',
        'word_boundary' => 1,
        'ellipsis' => 1,
        'html' => 0,
        'strip_tags' => 0,
      ),
      'empty' => '',
      'hide_empty' => 0,
      'empty_zero' => 0,
      'hide_alter_empty' => 1,
      'link_to_node' => 0,
      'label_type' => 'custom',
      'format' => 'plain',
      'multiple' => array(
        'group' => TRUE,
        'multiple_number' => '',
        'multiple_from' => '',
        'multiple_reversed' => FALSE,
      ),
      'exclude' => 0,
      'id' => 'field_details_value',
      'table' => 'node_data_field_details',
      'field' => 'field_details_value',
      'relationship' => 'none',
    ),
    'field_image_embed' => array(
      'label' => 'image',
      'alter' => array(
        'alter_text' => 0,
        'text' => '',
        'make_link' => 0,
        'path' => '',
        'absolute' => 0,
        'link_class' => '',
        'alt' => '',
        'rel' => '',
        'prefix' => '',
        'suffix' => '',
        'target' => '',
        'help' => '',
        'trim' => 0,
        'max_length' => '',
        'word_boundary' => 1,
        'ellipsis' => 1,
        'html' => 0,
        'strip_tags' => 0,
      ),
      'empty' => '',
      'hide_empty' => 0,
      'empty_zero' => 0,
      'hide_alter_empty' => 1,
      'link_to_node' => 0,
      'label_type' => 'custom',
      'format' => 'image_thumbnail',
      'multiple' => array(
        'group' => TRUE,
        'multiple_number' => '',
        'multiple_from' => '',
        'multiple_reversed' => FALSE,
      ),
      'exclude' => 0,
      'id' => 'field_image_embed',
      'table' => 'node_data_field_image',
      'field' => 'field_image_embed',
      'relationship' => 'none',
    ),
    'latitude' => array(
      'label' => 'latitude',
      'alter' => array(
        'alter_text' => 0,
        'text' => '',
        'make_link' => 0,
        'path' => '',
        'absolute' => 0,
        'link_class' => '',
        'alt' => '',
        'rel' => '',
        'prefix' => '',
        'suffix' => '',
        'target' => '',
        'help' => '',
        'trim' => 0,
        'max_length' => '',
        'word_boundary' => 1,
        'ellipsis' => 1,
        'html' => 0,
        'strip_tags' => 0,
      ),
      'empty' => '',
      'hide_empty' => 0,
      'empty_zero' => 0,
      'hide_alter_empty' => 1,
      'style' => 'dd',
      'exclude' => 0,
      'id' => 'latitude',
      'table' => 'location',
      'field' => 'latitude',
      'relationship' => 'none',
    ),
    'longitude' => array(
      'label' => 'longitude',
      'alter' => array(
        'alter_text' => 0,
        'text' => '',
        'make_link' => 0,
        'path' => '',
        'absolute' => 0,
        'link_class' => '',
        'alt' => '',
        'rel' => '',
        'prefix' => '',
        'suffix' => '',
        'target' => '',
        'help' => '',
        'trim' => 0,
        'max_length' => '',
        'word_boundary' => 1,
        'ellipsis' => 1,
        'html' => 0,
        'strip_tags' => 0,
      ),
      'empty' => '',
      'hide_empty' => 0,
      'empty_zero' => 0,
      'hide_alter_empty' => 1,
      'style' => 'dd',
      'exclude' => 0,
      'id' => 'longitude',
      'table' => 'location',
      'field' => 'longitude',
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
      'identifier' => 'dist',
      'id' => 'distance',
      'table' => 'location',
      'field' => 'distance',
      'relationship' => 'none',
      'origin' => 'static',
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
      'relationship' => 'group_nid',
    ),
  ));
  $handler->override_option('access', array(
    'type' => 'none',
  ));
  $handler->override_option('cache', array(
    'type' => 'none',
  ));
  $handler->override_option('title', 'Green sites near you');
  $handler->override_option('items_per_page', 50);
  $handler->override_option('use_pager', 'mini');
  $handler->override_option('distinct', 1);
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
  $handler = $view->new_display('page', 'Proximity API', 'page_3');
  $handler->override_option('style_plugin', 'views_json');
  $handler->override_option('style_options', array(
    'root_object' => 'locations',
    'top_child_object' => 'location',
    'field_output' => 'normal',
    'plaintext_output' => 1,
    'format' => 'simple',
    'jsonp_prefix' => 'proximity',
    'content_type' => 'default',
    'using_views_api_mode' => 0,
  ));
  $handler->override_option('path', 'api/proximity');
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
    'name' => 'navigation',
  ));

  // End paste from export
  $views[$view->name] = $view;

  return $views;
}
