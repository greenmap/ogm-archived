<?php
/**
 * Implementation of hook_views_default_views().
 */
function comments_views_default_views() {
///
// BEGIN PASTE
///
$view = new view;
$view->name = 'comments';
$view->description = 'Display recent comments block';
$view->tag = 'comments';
$view->view_php = '';
$view->base_table = 'node';
$view->is_cacheable = FALSE;
$view->api_version = 2;
$view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */
$handler = $view->new_display('default', 'Defaults', 'default');
$handler->override_option('fields', array(
  'title' => array(
    'label' => 'Page',
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
  'timestamp' => array(
    'label' => 'Post date',
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
    'date_format' => 'small',
    'custom_date_format' => '',
    'exclude' => 0,
    'id' => 'timestamp',
    'table' => 'comments',
    'field' => 'timestamp',
    'relationship' => 'none',
  ),
  'subject' => array(
    'label' => 'Title',
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
    'link_to_comment' => 0,
    'exclude' => 0,
    'id' => 'subject',
    'table' => 'comments',
    'field' => 'subject',
    'relationship' => 'none',
  ),
  'comment' => array(
    'label' => 'Comment',
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
    'id' => 'comment',
    'table' => 'comments',
    'field' => 'comment',
    'relationship' => 'none',
  ),
  'delete_comment' => array(
    'label' => 'Delete link',
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
    'text' => '',
    'exclude' => 0,
    'id' => 'delete_comment',
    'table' => 'comments',
    'field' => 'delete_comment',
    'relationship' => 'none',
  ),
));
$handler->override_option('sorts', array(
  'timestamp' => array(
    'order' => 'DESC',
    'granularity' => 'second',
    'id' => 'timestamp',
    'table' => 'comments',
    'field' => 'timestamp',
    'relationship' => 'none',
  ),
));
$handler->override_option('arguments', array(
  'group_nid' => array(
    'default_action' => 'not found',
    'style_plugin' => 'default_summary',
    'style_options' => array(),
    'wildcard' => 'all',
    'wildcard_substitution' => 'All',
    'title' => '',
    'breadcrumb' => '',
    'default_argument_type' => 'fixed',
    'default_argument' => '',
    'validate_type' => 'none',
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
      '9' => 0,
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
      'document' => 0,
      'green_area' => 0,
      'green_map' => 0,
      'green_route' => 0,
      'green_site' => 0,
      'impact' => 0,
      'mapmaker_profile' => 0,
      'mass_contact' => 0,
      'page' => 0,
      'photo' => 0,
      'poly' => 0,
      'story' => 0,
      'support_forum_issue' => 0,
      'testimonial' => 0,
      'transport_direction' => 0,
      'video' => 0,
    ),
    'validate_argument_node_access' => 0,
    'validate_argument_nid_type' => 'nid',
    'validate_argument_vocabulary' => array(
      '2' => 0,
      '7' => 0,
      '3' => 0,
      '1' => 0,
      '5' => 0,
      '6' => 0,
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
  'status_extra' => array(
    'operator' => '=',
    'value' => '',
    'group' => '0',
    'exposed' => FALSE,
    'expose' => array(
      'operator' => FALSE,
      'label' => '',
    ),
    'id' => 'status_extra',
    'table' => 'node',
    'field' => 'status_extra',
    'relationship' => 'none',
  ),
  'type' => array(
    'operator' => 'in',
    'value' => array(
      'green_area' => 'green_area',
      'green_map' => 'green_map',
      'green_route' => 'green_route',
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
  'comment_count' => array(
    'operator' => '>=',
    'value' => array(
      'value' => '1',
      'min' => '',
      'max' => '',
    ),
    'group' => '0',
    'exposed' => FALSE,
    'expose' => array(
      'operator' => FALSE,
      'label' => '',
    ),
    'id' => 'comment_count',
    'table' => 'node_comment_statistics',
    'field' => 'comment_count',
    'relationship' => 'none',
  ),
));
$handler->override_option('access', array(
  'type' => 'none',
));
$handler->override_option('cache', array(
  'type' => 'none',
));
$handler->override_option('title', 'Recent comments');
$handler->override_option('header', 'These are the comments people have made about sites on your map. Click in any link below and then you can reply, or flag it if there\'s a problem.');
$handler->override_option('header_format', '1');
$handler->override_option('header_empty', 0);
$handler->override_option('empty', 'There are no comments');
$handler->override_option('empty_format', '1');
$handler->override_option('use_ajax', TRUE);
$handler->override_option('use_pager', 'mini');
$handler->override_option('style_plugin', 'table');
$handler->override_option('style_options', array(
  'grouping' => '',
  'override' => 1,
  'sticky' => 1,
  'order' => 'desc',
  'columns' => array(
    'title' => 'title',
    'subject' => 'subject',
    'name' => 'name',
    'timestamp' => 'timestamp',
  ),
  'info' => array(
    'title' => array(
      'sortable' => 1,
      'separator' => '',
    ),
    'subject' => array(
      'sortable' => 1,
      'separator' => '',
    ),
    'name' => array(
      'sortable' => 1,
      'separator' => '',
    ),
    'timestamp' => array(
      'sortable' => 1,
      'separator' => '',
    ),
  ),
  'default' => 'timestamp',
));
$handler = $view->new_display('page', 'Comments (page) (group nid)', 'page_1');
$handler->override_option('path', 'dashboard/comments/%');
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
$handler = $view->new_display('block', 'Comments (block) (group nid)', 'block_1');
$handler->override_option('items_per_page', 100);
$handler->override_option('use_pager', FALSE);
$handler->override_option('use_more', 1);
$handler->override_option('block_description', 'Recent comments (arg: group nid)');
$handler->override_option('block_caching', -1);
$handler = $view->new_display('block', 'Comments (block) (uid, group nid)', 'block_2');
$handler->override_option('arguments', array(
  'name' => array(
    'default_action' => 'empty',
    'style_plugin' => 'default_summary',
    'style_options' => array(),
    'wildcard' => 'all',
    'wildcard_substitution' => 'All',
    'title' => '',
    'default_argument_type' => 'fixed',
    'default_argument' => '',
    'validate_type' => 'user',
    'validate_fail' => 'not found',
    'glossary' => 0,
    'limit' => '0',
    'case' => 'none',
    'path_case' => 'none',
    'transform_dash' => 0,
    'id' => 'name',
    'table' => 'users',
    'field' => 'name',
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
    'override' => array(
      'button' => 'Use default',
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
  'nid' => array(
    'default_action' => 'empty',
    'style_plugin' => 'default_summary',
    'style_options' => array(),
    'wildcard' => 'all',
    'wildcard_substitution' => 'All',
    'title' => '',
    'default_argument_type' => 'fixed',
    'default_argument' => '',
    'validate_type' => 'og_group_types',
    'validate_fail' => 'not found',
    'break_phrase' => 0,
    'not' => 0,
    'id' => 'nid',
    'table' => 'og_uid',
    'field' => 'nid',
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
    'override' => array(
      'button' => 'Use default',
    ),
  ),
));
$handler->override_option('empty', 'There are no comments on your sites.');
$handler->override_option('use_pager', FALSE);
$handler->override_option('block_description', 'Recent Comments (args: uid, group nid)');
$handler->override_option('block_caching', -1);
$handler = $view->new_display('block', 'Comments (block) (country)', 'block_3');
$handler->override_option('arguments', array(
  'country' => array(
    'default_action' => 'empty',
    'style_plugin' => 'default_summary',
    'style_options' => array(),
    'wildcard' => 'all',
    'wildcard_substitution' => 'All',
    'title' => '',
    'default_argument_type' => 'fixed',
    'default_argument' => '',
    'validate_type' => 'none',
    'validate_fail' => 'not found',
    'id' => 'country',
    'table' => 'location',
    'field' => 'country',
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
    'override' => array(
      'button' => 'Use default',
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
$handler->override_option('header', '');
$handler->override_option('empty', 'There are no comments on your sites.');
$handler->override_option('use_pager', FALSE);
$handler->override_option('block_description', 'Comments (arg: country)');
$handler->override_option('block_caching', -1);
$handler = $view->new_display('block', 'Block', 'block_4');
$handler->override_option('block_description', '');
$handler->override_option('block_caching', -1);
$handler = $view->new_display('block', 'Block', 'block_5');
$handler->override_option('block_description', '');
$handler->override_option('block_caching', -1);
$handler = $view->new_display('block', 'Block', 'block_6');
$handler->override_option('fields', array(
  'subject' => array(
    'label' => 'Title',
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
    'link_to_comment' => 0,
    'exclude' => 0,
    'id' => 'subject',
    'table' => 'comments',
    'field' => 'subject',
    'relationship' => 'none',
  ),
  'title' => array(
    'label' => 'Site',
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
    'override' => array(
      'button' => 'Use default',
    ),
  ),
  'name' => array(
    'label' => 'Added by',
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
    'link_to_user' => 1,
    'exclude' => 0,
    'id' => 'name',
    'table' => 'comments',
    'field' => 'name',
    'override' => array(
      'button' => 'Use default',
    ),
    'relationship' => 'none',
  ),
  'comment' => array(
    'label' => 'Comment',
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
    'id' => 'comment',
    'table' => 'comments',
    'field' => 'comment',
    'relationship' => 'none',
  ),
  'last_updated' => array(
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
    'date_format' => 'small',
    'custom_date_format' => '',
    'exclude' => 0,
    'id' => 'last_updated',
    'table' => 'node_comment_statistics',
    'field' => 'last_updated',
    'override' => array(
      'button' => 'Use default',
    ),
    'relationship' => 'none',
  ),
));
$handler->override_option('header', '');
$handler->override_option('empty', 'No comments');
$handler->override_option('items_per_page', 3);
$handler->override_option('use_pager', '0');
$handler->override_option('block_description', '');
$handler->override_option('block_caching', -1);
///
// END PASTE
///

  $views[$view->name] = $view;

  return $views;
}

