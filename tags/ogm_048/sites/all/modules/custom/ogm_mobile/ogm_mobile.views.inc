<?php
// Copied from primary_term.views.inc

/**
 * @file
 * Views data for primary_term clone for ogm_mobile. Added image support.
 */

function ogm_mobile_views_handlers() {
  return array(
    'info' => array(
        'path' => drupal_get_path('module', 'ogm_mobile'),
    ),
    'handlers' => array(
      'ogm_mobile_handler_field_primary_term_tid_clone' => array(
        'parent' => 'views_handler_field',
      ),
    ),
  );
}

/**
 * Implementation of hook_views_data().
 */
function ogm_mobile_views_data() {
  $data['primary_term']['tid_clone'] = array(
    'real field' => 'tid',
    'title' => t('Primary Term: OGM Options'),
    'help' => t('Customized Primary Term data for the node.'),
    'field' => array(
      'handler' => 'ogm_mobile_handler_field_primary_term_tid_clone',
      'click sortable' => TRUE,
      'real field' => 'tid',
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_term_node_tid',
    ),
    'argument' => array(
      'handler' => 'views_handler_argument_term_node_tid',
    ),
  );

  return $data;
}
