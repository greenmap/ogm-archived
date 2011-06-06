<?php

// usage:
//   drush php-script <name of this file>

// get every photo

$sql = "SELECT nid FROM node WHERE type = '%s'";
$type = 'photo';
if ( ! og_is_group_post_type($type) ) {
  trigger_error("The type \"$type\"is not set up to be posted to groups. Exiting.");
  exit();
}
$res = db_query($sql, $type);


// iterate on photos

$f = 'field_site_1';

while ( $ph = db_fetch_object($res) ) {
  $photo = node_load($ph->nid);
  if ( ! is_array($photo->og_groups) ) {
    $photo->og_groups = array();
  }
  $sites = array();
  if ( is_array($photo->{$f}) ) {
    foreach ( $photo->{$f} as $site_nid ) {
      $sites[] = node_load($site_nid);
    }
  } else {
    trigger_error("Found a photo with with nid ". $photo->nid ." having no values for $f");
  }
  foreach ( $sites as $site ) {
    if ( isset($site->og_public) ) {
      $photo->og_public = $site->og_public;
    }
    if ( !is_array($site->og_groups) ) {
      trigger_error("Found a site with no group, ignoring it.");
    } else {
      $photo->og_groups += $site->og_groups;
      print "Putting photo with nid ". $photo->nid ." into group with nid ". reset($site->og_groups) ." and possibly other groups too.\n";
      og_save_ancestry($photo);
    }
  }
}

print "Rebuilding node access table(s). This will take a long time...\n";
node_access_rebuild();
