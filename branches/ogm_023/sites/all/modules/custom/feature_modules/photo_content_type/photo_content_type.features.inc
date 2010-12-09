<?php

/**
 * Implementation of hook_node_info().
 */
function photo_content_type_node_info() {
  $items = array(
    'photo' => array(
      'name' => t('Photo'),
      'module' => 'features',
      'description' => t('A photo of a site on a map'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'has_body' => '1',
      'body_label' => t('Description'),
      'min_word_count' => '0',
      'help' => '',
    ),
  );
  return $items;
}
