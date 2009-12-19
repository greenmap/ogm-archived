<?php
// $Id$

/**
 * @file
 * Provide a views handlers for primary_term data fields.
 */

class views_handler_field_primary_term_tid extends views_handler_field {
  function render($values) {
    $tid = $values->{$this->field_alias};
    $term = taxonomy_get_term($tid);
    return $term->name;
  }
}
