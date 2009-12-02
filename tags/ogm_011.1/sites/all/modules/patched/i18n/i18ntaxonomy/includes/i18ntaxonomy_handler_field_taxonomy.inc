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
        $tid = (isset($value->term_data_tid)) ? $value->term_data_tid : $value->tid;
        $values[$key]->term_data_name = tt('taxonomy:term:'. $tid .':name', $value->term_data_name);
      }
    }
  }
}
