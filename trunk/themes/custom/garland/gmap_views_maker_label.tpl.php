<?php
  $marker_label = '';
  foreach ($view->field as $field) {
    $marker_label .= '<div class="gmapstyle-'. $field['field'] .'">'. views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $entry, $view) .'</div>';
  }
  print $marker_label; ?>