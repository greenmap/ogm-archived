<?php

/**
 * Implementation of hook_node_info().
 */
function green_site_content_type_node_info() {
  $items = array(
    'green_site' => array(
      'name' => t('Green Site'),
      'module' => 'features',
      'description' => t('A green site to appear on the map'),
      'has_title' => '1',
      'title_label' => t('Name of Site'),
      'has_body' => '0',
      'body_label' => '',
      'min_word_count' => '0',
      'help' => '',
    ),
  );
  return $items;
}
