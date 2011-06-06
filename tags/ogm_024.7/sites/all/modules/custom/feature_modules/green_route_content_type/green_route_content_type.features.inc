<?php

/**
 * Implementation of hook_node_info().
 */
function green_route_content_type_node_info() {
  $items = array(
    'green_route' => array(
      'name' => t('Green Route'),
      'module' => 'features',
      'description' => t('A green route or line contour to appear on the map'),
      'has_title' => '1',
      'title_label' => t('Name of Route or Line'),
      'has_body' => '0',
      'body_label' => '',
      'min_word_count' => '0',
      'help' => '',
    ),
  );
  return $items;
}
