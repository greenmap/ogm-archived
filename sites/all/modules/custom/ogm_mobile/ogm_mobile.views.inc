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
      'views_handler_field_primary_term_tid_clone' => array(
        'parent' => 'views_handler_field',
      ),
    ),
  );
}

/**
 * Implementation of hook_views_data().
 */
function ogm_mobile_views_data() {
  $data['ogm_mobile']['table']['group'] = t('Node');
  $data['ogm_mobile']['table']['join'] = array(
    'node' => array(
      'left_field' => 'vid',
      'field' => 'vid',
    ),
    // @@@ Node_revisions?
  );

  $data['ogm_mobile']['tid'] = array(
    'title' => t('Primary Term: Term Image'),
    'help' => t('The Primary Term Image of the node.'),
    'field' => array(
      'handler' => 'views_handler_field_primary_term_tid_clone',
      'click sortable' => TRUE,
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
