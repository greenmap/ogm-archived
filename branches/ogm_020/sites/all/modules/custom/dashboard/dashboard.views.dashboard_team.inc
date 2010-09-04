<?php
/**
 * Implementation of hook_views_default_views().
 */
function dashboard_views_team_default_views() {
  /*
   * View 'dashboard_team'
   */
// BEGIN PASTE
$view = new view;
$view->name = 'dashboard_team';
$view->description = 'Member listing';
$view->tag = 'dashboard';
$view->view_php = '';
$view->base_table = 'users';
$view->is_cacheable = FALSE;
$view->api_version = 2;
$view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */
$handler = $view->new_display('default', 'Defaults', 'default');
$handler->override_option('relationships', array(
  'nid' => array(
    'id' => 'nid',
    'table' => 'og_uid',
    'field' => 'nid',
  ),
));
$handler->override_option('fields', array(
  'name' => array(
    'id' => 'name',
    'table' => 'users',
    'field' => 'name',
    'label' => 'Name',
    'link_to_user' => 1,
    'relationship' => 'none',
  ),
  'is_manager' => array(
    'label' => 'Manager?',
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
    'id' => 'is_manager',
    'table' => 'og_uid',
    'field' => 'is_manager',
    'relationship' => 'none',
  ),
  'managelink' => array(
    'id' => 'managelink',
    'table' => 'og_uid',
    'field' => 'managelink',
    'label' => 'Manage',
    'relationship' => 'none',
  ),
  'managelinkadmin' => array(
    'id' => 'managelinkadmin',
    'table' => 'og_uid',
    'field' => 'managelinkadmin',
    'label' => 'Admin',
    'relationship' => 'none',
  ),
  'created' => array(
    'label' => 'Member since',
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
    'id' => 'created',
    'table' => 'og_uid',
    'field' => 'created',
    'relationship' => 'none',
  ),
  'rid' => array(
    'label' => 'User Roles',
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
    'type' => 'separator',
    'separator' => ', ',
    'empty' => '',
    'exclude' => 0,
    'id' => 'rid',
    'table' => 'users_roles',
    'field' => 'rid',
    'relationship' => 'none',
  ),
  'edit_node' => array(
    'label' => 'Edit Roles',
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
    'text' => 'Edit roles',
    'exclude' => 0,
    'id' => 'edit_node',
    'table' => 'users',
    'field' => 'edit_node',
    'relationship' => 'none',
  ),
  'nid' => array(
    'id' => 'nid',
    'table' => 'node',
    'field' => 'nid',
    'relationship' => 'nid',
  ),
));
$handler->override_option('sorts', array(
  'is_admin' => array(
    'id' => 'is_admin',
    'table' => 'og_uid',
    'field' => 'is_admin',
    'order' => 'DESC',
    'relationship' => 'none',
  ),
  'is_active' => array(
    'id' => 'is_active',
    'table' => 'og_uid',
    'field' => 'is_active',
    'order' => 'ASC',
    'relationship' => 'none',
  ),
  'name' => array(
    'id' => 'name',
    'table' => 'users',
    'field' => 'name',
    'order' => 'ASC',
    'relationship' => 'none',
  ),
));
$handler->override_option('arguments', array(
  'nid' => array(
    'default_action' => 'not found',
    'style_plugin' => 'default_summary',
    'style_options' => array(
      'count' => TRUE,
      'override' => FALSE,
      'items_per_page' => 25,
    ),
    'wildcard' => 'all',
    'wildcard_substitution' => 'All',
    'title' => '%1 Team',
    'breadcrumb' => '',
    'default_argument_type' => 'fixed',
    'default_argument' => '',
    'validate_type' => 'og_group_types',
    'validate_fail' => 'not found',
    'break_phrase' => 0,
    'not' => 0,
    'id' => 'nid',
    'table' => 'og_uid',
    'field' => 'nid',
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
      'support_forum_issue' => 0,
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
      '6' => 0,
      '4' => 0,
    ),
    'validate_argument_type' => 'tid',
    'validate_argument_is_member' => 1,
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
    'default_options_div_prefix' => '',
    'validate_argument_transform' => 0,
    'validate_user_restrict_roles' => 0,
    'validate_argument_node_flag_name' => '*relationship*',
    'validate_argument_node_flag_test' => 'flaggable',
    'validate_argument_node_flag_id_type' => 'id',
    'validate_argument_user_flag_name' => '*relationship*',
    'validate_argument_user_flag_test' => 'flaggable',
    'validate_argument_user_flag_id_type' => 'id',
  ),
));
$handler->override_option('filters', array(
  'status' => array(
    'id' => 'status',
    'table' => 'users',
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
));
$handler->override_option('access', array(
  'type' => 'none',
));
$handler->override_option('cache', array(
  'type' => 'none',
));
$handler->override_option('header', 'In the Open Green Map platform, Registered Mapmakers are called Team Leaders. Mapmakers can:
  <ul>
  <li>Create new maps and manage multiple projects such as theme, district or school Open Green Maps that involve different people.
  <li>Invite Coordinator(s) or Team Members to help create and manage each OGM map.
  <li>Opt to take public suggestions to enhance the map(s). If this option is active in the map, the Team is responsible for reviewing and approving (or not) the public suggestions before it appears on the map.
  </ul>
  NOTE: Green Mapmakers have full access to all our Green Mapmaking resources and tools for all kinds of Green Map projects at <a href="http://greenmap.org/">GreenMap.org</a>, including this Map platform.

  The Coordinator has additional permissions so they can help manage the project. Coordinators can:
  <ul>
  <li>Add new sites that will appear instantly with their username on the bottom of each site.
  <li>Edit any of the sites on the map.
  <li>Review and approve (or not) the public suggestions before it appears on the map.
  <li>Invite Team Members.
  <li>Make widgets.
  </ul>

  The Team Members can:
  <ul>
  <li>Add new sites that will appear instantly with their username on the bottom of each site.
  <li>Edit any of their own sites.
  </ul>');
$handler->override_option('header_format', '3');
$handler->override_option('header_empty', 1);
$handler->override_option('empty_format', '1');
$handler->override_option('items_per_page', 90);
$handler->override_option('use_pager', '1');
$handler->override_option('distinct', 0);
$handler->override_option('style_plugin', 'table');
$handler->override_option('style_options', array(
  'grouping' => '',
  'override' => 0,
  'sticky' => 0,
  'order' => 'asc',
  'columns' => array(
    'name' => 'name',
    'managelink' => 'managelink',
    'managelinkadmin' => 'managelinkadmin',
    'is_manager' => 'is_manager',
    'is_admin' => 'is_admin',
    'is_active' => 'is_active',
  ),
  'info' => array(
    'name' => array(
      'sortable' => 0,
      'separator' => '&nbsp;',
    ),
    'managelink' => array(
      'separator' => '',
    ),
    'managelinkadmin' => array(
      'separator' => '',
    ),
    'is_manager' => array(
      'separator' => '',
    ),
    'is_admin' => array(
      'sortable' => 0,
      'separator' => '',
    ),
    'is_active' => array(
      'sortable' => 0,
      'separator' => '',
    ),
  ),
  'default' => '-1',
));
$handler = $view->new_display('page', 'Page', 'page');
$handler->override_option('relationships', array(
  'nid' => array(
    'label' => 'Group node (member)',
    'required' => 0,
    'id' => 'nid',
    'table' => 'og_uid',
    'field' => 'nid',
    'override' => array(
      'button' => 'Use default',
    ),
    'relationship' => 'none',
  ),
));
$handler->override_option('fields', array(
  'name' => array(
    'id' => 'name',
    'table' => 'users',
    'field' => 'name',
    'label' => 'Name',
    'link_to_user' => 1,
    'relationship' => 'none',
  ),
  'is_manager' => array(
    'label' => 'Manager?',
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
    'id' => 'is_manager',
    'table' => 'og_uid',
    'field' => 'is_manager',
    'relationship' => 'none',
  ),
  'managelink' => array(
    'id' => 'managelink',
    'table' => 'og_uid',
    'field' => 'managelink',
    'label' => 'Manage',
    'relationship' => 'none',
  ),
  'managelinkadmin' => array(
    'id' => 'managelinkadmin',
    'table' => 'og_uid',
    'field' => 'managelinkadmin',
    'label' => 'Admin',
    'relationship' => 'none',
  ),
  'created' => array(
    'label' => 'Member since',
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
    'id' => 'created',
    'table' => 'og_uid',
    'field' => 'created',
    'relationship' => 'none',
  ),
  'rid' => array(
    'label' => 'User Roles',
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
    'type' => 'separator',
    'separator' => ', ',
    'empty' => '',
    'exclude' => 0,
    'id' => 'rid',
    'table' => 'users_roles',
    'field' => 'rid',
    'relationship' => 'none',
  ),
  'nid' => array(
    'label' => 'Edit Roles',
    'alter' => array(
      'alter_text' => 1,
      'text' => 'Edit Roles',
      'make_link' => 1,
      'path' => 'og/users/[nid]/roles',
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
    'id' => 'nid',
    'table' => 'node',
    'field' => 'nid',
    'relationship' => 'nid',
    'override' => array(
      'button' => 'Use default',
    ),
  ),
));
$handler->override_option('path', 'node/%/team_members');
$handler->override_option('menu', array(
  'type' => 'none',
  'title' => 'Map Team',
  'description' => '',
  'weight' => '10',
  'name' => 'navigation',
));
$handler->override_option('tab_options', array(
  'type' => 'normal',
  'title' => 'List',
  'description' => '',
  'weight' => '0',
));
// END PASTE
  $views[$view->name] = $view;
  return $views;
}
