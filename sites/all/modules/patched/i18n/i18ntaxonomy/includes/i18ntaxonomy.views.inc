<?php
// $Id$
/**
 * @file
 * Views hooks.
 */

/**
 * Implemenation of hook_views_handlers().
 */
function i18ntaxonomy_views_handlers() {
  return array(
    'handlers' => array(
      'i18ntaxonomy_handler_field_taxonomy' => array(
        'parent' => 'views_handler_field_taxonomy',
        'file' => 'includes/i18ntaxonomy_handler_field_taxonomy.inc',
      ),
      'i18ntaxonomy_handler_field_term_node_tid' => array(
        'parent' => 'views_handler_field_term_node_tid',
        'file' => 'includes/i18ntaxonomy_handler_field_term_node_tid.inc',
      ),
      
    ),
  );
}

/**
 * Implemenation of hook_views_data_alter().
 */
function i18ntaxonomy_views_data_alter(&$data) {
  $data['term_data']['name']['field']['handler'] = 'i18ntaxonomy_handler_field_taxonomy';
  $data['term_node']['tid']['field']['handler'] = 'i18ntaxonomy_handler_field_term_node_tid';
}