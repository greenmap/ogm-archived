<?php
// $Id$

/**
 * Field handler for terms.
 */
class i18ntaxonomyviews_handler_field_term_node_tid extends views_handler_field_term_node_tid {
  function pre_render($values) {
    $this->field_alias = $this->aliases['vid'];
    $vids = array();
    foreach ($values as $result) {
      if (!empty($result->{$this->aliases['vid']})) {
        $vids[] = $result->{$this->aliases['vid']};
      }
    }

    if ($vids) {
      $voc = '';
      if (!empty($this->options['limit']) && !empty($this->options['vids'])) {
        $voc = " AND td.vid IN (" . implode(', ', array_keys(array_filter($this->options['vids']))) . ")";
      }

      $result = db_query("SELECT tn.vid AS node_vid, td.* FROM {term_data} td INNER JOIN {term_node} tn ON td.tid = tn.tid WHERE tn.vid IN (" . implode(', ', $vids) . ")$voc ORDER BY td.weight, td.name");

      while ($term = db_fetch_object($result)) {
        $name = tt('taxonomy:term:'. $term->tid .':name', $term->name);
        if (empty($this->options['link_to_taxonomy'])) {
          $this->items[$term->node_vid][$term->tid] = check_plain($name);
        }
        else {
          $this->items[$term->node_vid][$term->tid] = l($name, taxonomy_term_path($term));
        }
      }
    }
  }
}

