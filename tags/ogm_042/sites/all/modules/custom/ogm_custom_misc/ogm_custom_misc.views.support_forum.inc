<?php
/**
 * Implementation of hook_views_default_views().
 */
function support_forum_views_default_views() {
// BEGIN PASTE
$view = new view;
$view->name = 'support_forum';
$view->description = 'Support Forum';
$view->tag = '';
$view->view_php = '';
$view->base_table = 'node';
$view->is_cacheable = FALSE;
$view->api_version = 2;
$view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */
$handler = $view->new_display('default', 'Defaults', 'default');
$handler->override_option('relationships', array(
  'votingapi_cache' => array(
    'label' => 'Voting results',
    'required' => 0,
    'votingapi' => array(
      'value_type' => 'percent',
      'tag' => 'vote',
      'function' => 'average',
    ),
    'id' => 'votingapi_cache',
    'table' => 'node',
    'field' => 'votingapi_cache',
    'relationship' => 'none',
  ),
));
$handler->override_option('fields', array(
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
  'name' => array(
    'label' => 'Name',
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
    'link_to_user' => 0,
    'overwrite_anonymous' => 0,
    'anonymous_text' => '',
    'exclude' => 0,
    'id' => 'name',
    'table' => 'users',
    'field' => 'name',
    'relationship' => 'none',
  ),
  'created' => array(
    'label' => 'Posted',
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
    'table' => 'node',
    'field' => 'created',
    'relationship' => 'none',
  ),
  'value' => array(
    'label' => 'Rating',
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
    'set_precision' => FALSE,
    'precision' => 0,
    'decimal' => '.',
    'separator' => ',',
    'prefix' => '',
    'suffix' => '',
    'appearance' => 'fivestar_views_value_display_handler',
    'exclude' => 0,
    'id' => 'value',
    'table' => 'votingapi_cache',
    'field' => 'value',
    'relationship' => 'votingapi_cache',
  ),
));
$handler->override_option('sorts', array(
  'sticky' => array(
    'order' => 'DESC',
    'id' => 'sticky',
    'table' => 'node',
    'field' => 'sticky',
    'relationship' => 'none',
  ),
  'created' => array(
    'order' => 'DESC',
    'granularity' => 'second',
    'id' => 'created',
    'table' => 'node',
    'field' => 'created',
    'relationship' => 'none',
  ),
));
$handler->override_option('filters', array(
  'type' => array(
    'operator' => 'in',
    'value' => array(
      'support_forum_issue' => 'support_forum_issue',
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
));
$handler->override_option('access', array(
  'type' => 'role',
  'role' => array(
    '3' => 3,
    '2' => 2,
    '11' => 11,
    '6' => 6,
    '9' => 9,
    '4' => 4,
    '5' => 5,
    '7' => 7,
    '8' => 8,
  ),
));
$handler->override_option('cache', array(
  'type' => 'none',
));
$handler->override_option('title', 'Support Forum');
$handler->override_option('items_per_page', 30);
$handler->override_option('use_pager', 'mini');
$handler->override_option('style_plugin', 'table');
$handler->override_option('style_options', NULL);
$handler->override_option('row_plugin', 'node');
$handler->override_option('row_options', array(
  'relationship' => 'none',
  'build_mode' => 'teaser',
  'links' => 1,
  'comments' => 0,
));
$handler = $view->new_display('page', 'Support Forum Page', 'page_1');
$handler->override_option('header', '<h2>Welcome to the Open Green Map Support Forum</h2>

This area is setup to allow for feedback, feature requests and the sharing of ideas or tips about how to get the most from the Open Green Map platform.

You can post comments on any forum issue, as well as vote on ideas or feature requests that you like or think are important.

<a href="/node/add/support-forum-issue">Click here to create a new post</a>

Thanks for participating in this part of the community.

<strong>NETIQUETTE</strong>

Green Map System staff have set some conventions to facilitate the tracking of your issues and requests.

<ul><li><em>FIXED</em> - The bug/feature has been resolved by our team.</li>
<li><em>IN PROGRESS</em> - The bug/feature has been acknowledge and we are working to fix it soon.</li>
<li><em>FEEDBACK</em> - We need your ideas and/or suggestions.</li></ul>

<strong>--The Green Map team</strong>');
$handler->override_option('header_format', '3');
$handler->override_option('header_empty', 1);
$handler->override_option('path', 'support_forum');
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
// END PASTE
  $views[$view->name] = $view;
  return $views;
}
