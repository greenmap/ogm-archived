<?php
// $debug = TRUE;

// bootstrap drupal
include 'includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

global $user;

if (!empty($update_free_access) || $user->uid == 1) {

  // set up the query for old polygons
  $query = 'SELECT
    n.nid AS green_site_nid
    , n.uid AS user_id
    , n.title AS green_site
    , asText(ctgs.field_field_poly_0_gmap_shapes) shape
  FROM
    {node} n
    INNER JOIN {content_type_green_site} ctgs ON n.vid=ctgs.vid
    LEFT JOIN {og_ancestry} oga ON n.nid=oga.nid
    LEFT JOIN {node} n2 ON oga.group_nid = n2.nid
  WHERE
    n.type = "green_site"
    AND n.title NOT LIKE "test%"
    AND ctgs.field_field_poly_0_gmap_shapes IS NOT NULL
  ORDER BY
    n.type
    , n.nid';

  //   $query .= ' LIMIT 3';

  if ($debug) {
  print '<pre>';

  //   $sample_area = node_load(9789);
  //   $sample_line = node_load(9788);

  //   print_r($sample_area);
  //   print_r($sample_line);
  }
  $result = db_query($query);

  $no_taxonomy = array();
  $no_map = array();
  while ($row = db_fetch_array($result)) {
    // figure out if this is a line or area
    if (strstr($row['shape'], 'LINESTRING')) {
      $type = 'green_route';
    }
    elseif (strstr($row['shape'], 'POLYGON')) {
      $type = 'green_area';
    }
    // load the old node so that we can use it as a base for the new
    $node = node_load($row['green_site_nid']);

    // unset a bunch of stuff that should be regenerated
    unset($node->nid);
    unset($node->vid);
    unset($node->path);
    unset($node->locations[0]['lid']);
    unset($node->location['lid']);

    // reset the node type
    $node->type = $type;


    if ($type == 'green_area' ) {

      // set the old  poly info, and part of the new field
      $node->field_area_contour = array(0 => array(
        'geo' => $row['shape'],
      ));
    }
    elseif ($type == 'green_route') {
      $node->field_line_contour = array(0 => array(
        'geo' => $row['shape'],
      ));
    }
    if (!$debug) {
      // save the new node
      node_validate($node);
      node_submit($node);
      node_save($node);

      // flag some corner cases
      if (old_poly_conversion_check_poly_terms($row['green_site_nid']) == 0) {
        $no_taxonomy[$row['green_site_nid']] = array(
          'title' => $node->title,
          'author id' => $node->uid,
          'author' => $node->name,
          'map' => $node->og_groups_both,
          'new nid' => $node->nid,
          'old nid' => $row['green_site_nid'],
        );
      }
      elseif (count($node->og_groups) == 0) {
        $no_map[$row['green_site_nid']] = array(
          'title' => $node->title,
          'author id' => $node->uid,
          'author' => $node->name,
          'new nid' => $node->nid,
          'old nid' => $row['green_site_nid'],
        );
      }

      // and now delete the old node
      node_delete($row['green_site_nid']);

      $output .= '<strong>Converted:</strong> '. $node->title .' - Old nid = '. $row['green_site_nid'] .' - New nid = '. $node->nid .'<br />';
    }
    else {
      print '<h3>'. old_poly_conversion_check_poly_terms($row['green_site_nid']) .'</h3>';
//       print_r( $node);
    }
  }  // end while loop

  if (count($no_taxonomy > 0)) {
    $errors .= '<h3>These lines or areas are not in a line or area taxonomy.</h3>';
    foreach ($no_taxonomy as $oldnid => $info) {
      $errors .= $info['title'] .' - '. $info['author'] .' - '. $info['author id'] .' - '. $info['map'] .' - Old nid '. $info['old nid']. ' - New nid '. $node->nid .'<br />';
    }
  }
  if (count($no_map > 0)) {
    $errors .= '<h3>These lines or areas are not associated with a group/map.</h3>';
    foreach ($no_map as $oldnid => $info) {
      $errors .= $info['title'] .' - '. $info['author'] .' - '. $info['author id'] .' - Old nid '. $info['old nid']. ' - New nid '. $node->nid .'<br />';
    }
  }
  print $errors .'<br /><br />'. $output;

  die;
}
else {
  print 'nothing to see here';
}


function old_poly_conversion_check_poly_terms($nid) {
  // tids that define areas and lines
  $tids = "('312', '309', '313', '318', '317', '311', '314', '324', '325', '328', '329', '330', '332', '321')";
  $query = db_query('SELECT COUNT(*) FROM {term_node} tn LEFT JOIN {node} n ON n.nid = tn.nid AND n.vid = tn.vid WHERE n.nid = %d AND tn.tid IN '. $tids, $nid);
  return db_result($query);

}


?>