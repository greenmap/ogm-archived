<?php
/**
 * Implementation of hook_views_default_views().
 */
function comments_recent_dashboard_nomap_views_default_views() {
  /*
   * View 'comments_recent_dashboard_nomap'
   */
  $view = new view;
  $view->name = 'comments_recent_dashboard_nomap';
  $view->description = 'Display recent comments block for sites not on a map';
  $view->tag = '';
  $view->view_php = '';
  $view->base_table = 'comments';
  $view->is_cacheable = FALSE;
  $view->api_version = 2;
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */
  $handler = $view->new_display('default', 'Defaults', 'default');
  $handler->override_option('relationships', array(
    'nid' => array(
      'label' => 'Node',
      'required' => 1,
      'id' => 'nid',
      'table' => 'comments',
      'field' => 'nid',
      'override' => array(
        'button' => 'Override',
      ),
      'relationship' => 'none',
    ),
    'group_nid' => array(
      'label' => 'Group node (post)',
      'required' => 0,
      'id' => 'group_nid',
      'table' => 'og_ancestry',
      'field' => 'group_nid',
      'relationship' => 'nid',
      'override' => array(
        'button' => 'Override',
      ),
    ),
  ));
  $handler->override_option('fields', array(
    'subject' => array(
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
      'link_to_comment' => 1,
      'exclude' => 0,
      'id' => 'subject',
      'table' => 'comments',
      'field' => 'subject',
      'override' => array(
        'button' => 'Override',
      ),
      'relationship' => 'none',
    ),
  ));
  $handler->override_option('arguments', array(
    'uid' => array(
      'default_action' => 'not found',
      'style_plugin' => 'default_summary',
      'style_options' => array(),
      'wildcard' => 'all',
      'wildcard_substitution' => 'All',
      'title' => '',
      'default_argument_type' => 'fixed',
      'default_argument' => '',
      'validate_type' => 'user',
      'validate_fail' => 'not found',
      'break_phrase' => 0,
      'not' => 0,
      'id' => 'uid',
      'table' => 'users',
      'field' => 'uid',
      'relationship' => 'nid',
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
      'validate_argument_node_flag_name' => '*relationship*',
      'validate_argument_node_flag_test' => 'flaggable',
      'validate_argument_node_flag_id_type' => 'id',
      'validate_argument_user_flag_name' => '*relationship*',
      'validate_argument_user_flag_test' => 'flaggable',
      'validate_argument_user_flag_id_type' => 'id',
      'validate_argument_is_member' => 0,
      'validate_argument_php' => '',
    ),
  ));
  $handler->override_option('filters', array(
    'group_nid' => array(
      'operator' => 'empty',
      'value' => array(),
      'group' => '0',
      'exposed' => FALSE,
      'expose' => array(
        'operator' => FALSE,
        'label' => '',
      ),
      'id' => 'group_nid',
      'table' => 'og_ancestry',
      'field' => 'group_nid',
      'relationship' => 'nid',
      'override' => array(
        'button' => 'Override',
      ),
      'reduce_duplicates' => 0,
    ),
  ));
  $handler->override_option('access', array(
    'type' => 'none',
  ));
  $handler->override_option('empty', 'You have not posted any comments which are not on a map.');
  $handler->override_option('empty_format', '1');
  $views[$view->name] = $view;

  return $views;
}

