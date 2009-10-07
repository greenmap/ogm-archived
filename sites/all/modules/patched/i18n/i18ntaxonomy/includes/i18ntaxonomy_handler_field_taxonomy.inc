<?php
// $Id$

/**
* Field handler to provide simple renderer that allows linking to a taxonomy
* term.
*/
class i18ntaxonomy_handler_field_taxonomy extends views_handler_field_taxonomy {
  function pre_render($values) {
    foreach ($values as $key => $value) {
      if (isset($value->term_data_name)) {
        $t_name = tt('taxonomy:term:'. $value->tid .':name', $value->term_data_name);
        $values[$key]->term_data_name = $t_name;
      }
    }
  }
}