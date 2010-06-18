<?php
// $Id$
/**
 * @file
 * Views hooks.
 */

/**
 * Implemenation of hook_views_handlers().
 */
function i18ntaxonomyviews_views_handlers() {
  return array(
    'handlers' => array(
      'i18ntaxonomyviews_handler_field_taxonomy' => array(
        'parent' => 'views_handler_field_taxonomy',
      ),
      'i18ntaxonomyviews_handler_field_term_node_tid' => array(
        'parent' => 'views_handler_field_term_node_tid',
      ),
      'i18ntaxonomyviews_handler_argument_term_node_tid' => array(
        'parent' => 'views_handler_argument_term_node_tid',
      ),
      'i18ntaxonomyviews_handler_filter_term_node_tid' => array(
        'parent' => 'views_handler_filter_term_node_tid',
      ),
      
    ),
  );
}

/**
 * Implemenation of hook_views_data_alter().
 */
function i18ntaxonomyviews_views_data_alter(&$data) {
  $data['term_data']['name']['field']['handler'] = 'i18ntaxonomyviews_handler_field_taxonomy';
  $data['term_node']['tid']['field']['handler'] = 'i18ntaxonomyviews_handler_field_term_node_tid';
  $data['term_node']['tid']['argument']['handler'] = 'i18ntaxonomyviews_handler_argument_term_node_tid';
  $data['term_node']['tid']['filter']['handler'] = 'i18ntaxonomyviews_handler_filter_term_node_tid';
}