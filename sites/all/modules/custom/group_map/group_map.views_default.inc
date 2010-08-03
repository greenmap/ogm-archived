<?php
/**
 * Implementation of hook_views_default_views().
 */
function group_map_views_default_views() {
  /*
   * View 'group_map_search'
   */
  $view = new view;
  $view->name = 'group_map_search';
  $view->description = 'Search within a particular group.';
  $view->tag = 'group map';
  $view->view_php = '';
  $view->base_table = 'node';
  $view->is_cacheable = FALSE;
  $view->api_version = 2;
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */
  $handler = $view->new_display('default', 'Defaults', 'default');
  $handler->override_option('fields', array(
    'title' => array(
      'id' => 'title',
      'table' => 'node',
      'field' => 'title',
    ),
  ));
  $handler->override_option('sorts', array(
    'created' => array(
      'id' => 'created',
      'table' => 'node',
      'field' => 'created',
      'order' => 'DESC',
      'granularity' => 'second',
      'relationship' => 'none',
    ),
  ));
  $handler->override_option('arguments', array(
    'group_nid' => array(
      'id' => 'group_nid',
      'table' => 'og_ancestry',
      'field' => 'group_nid',
      'default_action' => 'ignore',
      'style_plugin' => 'default_summary',
      'style_options' => array(
        'count' => TRUE,
        'override' => FALSE,
        'items_per_page' => 25,
      ),
      'wildcard' => 'all',
      'wildcard_substitution' => 'All',
      'title' => 'Search results for %1',
      'default_argument_type' => 'fixed',
      'default_argument' => '',
      'validate_type' => 'og_group_types',
      'validate_fail' => 'not found',
      'break_phrase' => 0,
      'add_table' => 0,
      'relationship' => 'none',
      'default_argument_fixed' => '',
      'default_argument_php' => '',
      'validate_argument_node_type' => array(
        'blog' => 0,
        'poll' => 0,
        'book' => 0,
        'group1' => 0,
        'group2' => 0,
        'page' => 0,
        'story' => 0,
      ),
      'validate_argument_php' => '',
      'require_value' => 0,
      'reduce_duplicates' => 0,
      'default_argument_user' => 0,
      'validate_argument_node_access' => 0,
      'validate_argument_nid_type' => 'nid',
      'validate_argument_vocabulary' => array(
        '1' => 0,
        '2' => 0,
        '3' => 0,
        '4' => 0,
      ),
      'validate_argument_type' => 'tid',
      'not' => 0,
    ),
  ));
  $handler->override_option('filters', array(
    'status' => array(
      'id' => 'status',
      'table' => 'node',
      'field' => 'status',
      'operator' => '=',
      'value' => 1,
      'group' => 0,
      'exposed' => FALSE,
      'expose' => array(
        'operator' => FALSE,
        'label' => '',
      ),
      'relationship' => 'none',
      'expose_button' => array(
        'button' => 'Expose',
      ),
    ),
    'keys' => array(
      'operator' => 'required',
      'value' => '',
      'group' => 0,
      'exposed' => TRUE,
      'expose' => array(
        'use_operator' => 0,
        'operator' => '',
        'identifier' => 'keys',
        'label' => '',
        'optional' => 0,
        'remember' => 1,
      ),
      'id' => 'keys',
      'table' => 'search_index',
      'field' => 'keys',
      'relationship' => 'none',
      'expose_button' => array(
        'button' => 'Hide',
      ),
    ),
  ));
  $handler->override_option('access', array(
    'type' => 'perm',
    'perm' => 'search content',
  ));
  $handler->override_option('title', 'Search');
  $handler->override_option('empty', 'No Green Sites found.');
  $handler->override_option('empty_format', '1');
  $handler->override_option('items_per_page', 50);
  $handler->override_option('use_pager', '1');
  $handler->override_option('row_plugin', 'node');
  $handler->override_option('row_options', array(
    'teaser' => 1,
    'links' => 1,
  ));
  $handler = $view->new_display('page', 'Page', 'page_1');
  $handler->override_option('fields', array(
    'title' => array(
      'label' => '',
      'alter' => array(
        'alter_text' => 0,
        'text' => '',
        'make_link' => 0,
        'path' => '',
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
      'override' => array(
        'button' => 'Use default',
      ),
      'relationship' => 'none',
    ),
    'field_details_value' => array(
      'label' => '',
      'alter' => array(
        'alter_text' => 0,
        'text' => '<div style="margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px solid;">
        [field_details_value]
        </div>
        ',
        'make_link' => 0,
        'path' => '',
        'alt' => '',
        'prefix' => '',
        'suffix' => '',
        'help' => '',
        'trim' => 1,
        'max_length' => '500',
        'word_boundary' => 1,
        'ellipsis' => 1,
        'strip_tags' => 0,
        'html' => 0,
      ),
      'link_to_node' => 0,
      'label_type' => 'none',
      'format' => 'trimmed',
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
      'override' => array(
        'button' => 'Use default',
      ),
      'relationship' => 'none',
    ),
  ));
  $handler->override_option('arguments', array(
    'group_nid' => array(
      'default_action' => 'empty',
      'style_plugin' => 'default_summary',
      'style_options' => array(
        'count' => TRUE,
        'override' => FALSE,
        'items_per_page' => 25,
      ),
      'wildcard' => 'all',
      'wildcard_substitution' => 'All',
      'title' => 'Search results for %1',
      'default_argument_type' => 'fixed',
      'default_argument' => '',
      'validate_type' => 'og_group_types',
      'validate_fail' => 'not found',
      'break_phrase' => 0,
      'not' => 0,
      'id' => 'group_nid',
      'table' => 'og_ancestry',
      'field' => 'group_nid',
      'add_table' => 0,
      'relationship' => 'none',
      'default_argument_fixed' => '',
      'default_argument_php' => '',
      'validate_argument_node_type' => array(
        'poll' => 0,
        'faq' => 0,
        'admin_message' => 0,
        'document' => 0,
        'green_map' => 0,
        'green_site' => 0,
        'impact' => 0,
        'mapmaker_profile' => 0,
        'mass_contact' => 0,
        'page' => 0,
        'photo' => 0,
        'poly' => 0,
        'story' => 0,
        'testimonial' => 0,
        'transport_direction' => 0,
        'video' => 0,
      ),
      'validate_argument_php' => '',
      'require_value' => 0,
      'reduce_duplicates' => 0,
      'default_argument_user' => 0,
      'validate_argument_node_access' => 0,
      'validate_argument_nid_type' => 'nid',
      'validate_argument_vocabulary' => array(
        '2' => 0,
        '3' => 0,
        '1' => 0,
        '5' => 0,
        '4' => 0,
      ),
      'validate_argument_type' => 'tid',
      'validate_user_argument_type' => 'uid',
      'validate_user_roles' => array(
        '2' => 0,
        '3' => 0,
        '6' => 0,
        '9' => 0,
        '4' => 0,
        '5' => 0,
        '7' => 0,
        '8' => 0,
      ),
      'override' => array(
        'button' => 'Use default',
      ),
      'default_options_div_prefix' => '',
      'validate_argument_transform' => 0,
      'validate_user_restrict_roles' => 0,
      'validate_argument_node_flag_name' => '*relationship*',
      'validate_argument_node_flag_test' => 'flaggable',
      'validate_argument_node_flag_id_type' => 'id',
      'validate_argument_user_flag_name' => '*relationship*',
      'validate_argument_user_flag_test' => 'flaggable',
      'validate_argument_user_flag_id_type' => 'id',
      'validate_argument_is_member' => 0,
    ),
  ));
  $handler->override_option('style_options', array(
    'grouping' => '',
  ));
  $handler->override_option('row_plugin', 'fields');
  $handler->override_option('row_options', array());
  $handler->override_option('path', 'searchgreenmap/%');
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
  $views[$view->name] = $view;

  /*
   * View 'og_ghp_map'
   */
  $view = new view;
  $view->name = 'og_ghp_map';
  $view->description = 'Group Green Map';
  $view->tag = 'group map';
  $view->view_php = '';
  $view->base_table = 'node';
  $view->is_cacheable = FALSE;
  $view->api_version = 2;
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */
  $handler = $view->new_display('default', 'Defaults', 'default');
  $handler->override_option('fields', array(
    'nid' => array(
      'id' => 'nid',
      'table' => 'node',
      'field' => 'nid',
    ),
    'name' => array(
      'id' => 'name',
      'table' => 'term_node',
      'field' => 'tid',
      'label' => 'Icon',
    ),
    'title' => array(
      'id' => 'title',
      'table' => 'node',
      'field' => 'title',
      'link_to_node' => TRUE,
    ),
    'latitude' => array(
      'id' => 'latitude',
      'table' => 'location',
      'field' => 'latitude',
    ),
    'longitude' => array(
      'id' => 'longitude',
      'table' => 'location',
      'field' => 'longitude',
    ),
    'comment_count' => array(
      'id' => 'comment_count',
      'table' => 'node_comment_statistics',
      'field' => 'comment_count',
    ),
  ));
  $handler->override_option('arguments', array(
    'group_nid' => array(
      'default_action' => 'not found',
      'style_plugin' => 'default_summary',
      'style_options' => array(),
      'wildcard' => 'all',
      'wildcard_substitution' => 'All',
      'title' => '%1',
      'default_argument_type' => 'fixed',
      'default_argument' => '',
      'validate_type' => 'og_group_types',
      'validate_fail' => 'not found',
      'break_phrase' => 0,
      'not' => 0,
      'id' => 'group_nid',
      'table' => 'og_ancestry',
      'field' => 'group_nid',
      'validate_user_argument_type' => 'uid',
      'validate_user_roles' => array(
        '2' => 0,
        '3' => 0,
        '6' => 0,
        '4' => 0,
        '5' => 0,
        '7' => 0,
        '8' => 0,
      ),
      'relationship' => 'none',
      'default_options_div_prefix' => '',
      'default_argument_user' => 0,
      'default_argument_fixed' => '',
      'default_argument_php' => '',
      'validate_argument_node_type' => array(
        'poll' => 0,
        'faq' => 0,
        'admin_message' => 0,
        'green_map' => 0,
        'green_site' => 0,
        'impact' => 0,
        'mapmaker_profile' => 0,
        'page' => 0,
        'photo' => 0,
        'poly' => 0,
        'story' => 0,
        'testimonial' => 0,
        'transport_direction' => 0,
        'video' => 0,
      ),
      'validate_argument_node_access' => 0,
      'validate_argument_nid_type' => 'nid',
      'validate_argument_vocabulary' => array(
        '2' => 0,
        '3' => 0,
        '1' => 0,
        '5' => 0,
        '4' => 0,
      ),
      'validate_argument_type' => 'tid',
      'validate_argument_transform' => 0,
      'validate_user_restrict_roles' => 0,
      'validate_argument_is_member' => 0,
      'validate_argument_php' => '',
    ),
  ));
  $handler->override_option('filters', array(
    'status' => array(
      'id' => 'status',
      'table' => 'node',
      'field' => 'status',
      'value' => '1',
    ),
    'type' => array(
      'id' => 'type',
      'table' => 'node',
      'field' => 'type',
      'operator' => 'in',
      'value' => array(
        '0' => 'green_site',
      ),
    ),
  ));
  $handler->override_option('access', array(
    'type' => 'none',
    'role' => array(),
    'perm' => '',
  ));
  $handler->override_option('title', NULL);
  $handler->override_option('header_format', '1');
  $handler->override_option('footer_format', '1');
  $handler->override_option('empty', 'No sites found');
  $handler->override_option('empty_format', '1');
  $handler->override_option('items_per_page', 1);
  $handler->override_option('style_plugin', 'gmap');
  $handler->override_option('style_options', array(
    'grouping' => '',
    'macro' => '[gmap ]',
    'datasource' => 'location',
    'latfield' => 'nid',
    'lonfield' => 'nid',
    'markers' => 'nodetype',
    'markerfield' => 'nid',
    'markertype' => 'small green',
  ));
  $views[$view->name] = $view;

  return $views;
}
