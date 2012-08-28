<?php

/**
 * Implementation of hook_node_info().
 */
function green_area_content_type_node_info() {
  $items = array(
    'green_area' => array(
      'name' => t('Green Area'),
      'module' => 'features',
      'description' => t('A green area or shape to appear on the map'),
      'has_title' => '1',
      'title_label' => t('Name of Area or shape'),
      'has_body' => '0',
      'body_label' => '',
      'min_word_count' => '0',
      'help' => '',
    ),
  );
  return $items;
}
