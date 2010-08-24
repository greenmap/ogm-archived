<?php

// purpose: take users out of global team roles and put them in group-specific
//   roles in the og_users_roles table

// usage:
//   drush php-script <name of this file>

// some special cases:
// run this query to see who has more than one role:

/* 

SELECT users.name, inner1.* FROM (SELECT u.uid, COUNT(u.uid) roles, ur.rid
   FROM users u INNER JOIN users_roles ur ON u.uid = ur.uid GROUP BY u.uid HAVING
   roles > 1 ) inner1 INNER JOIN users ON inner1.uid = users.uid ;

*/
// these users will probably need to be manually dealt with


$sql = "
  SELECT users.name, inner1.* 
    FROM 
      ( SELECT u.uid, COUNT(u.uid) nroles, ur.rid 
          FROM {users} u 
            INNER JOIN {users_roles} ur 
              ON u.uid = ur.uid 
          GROUP BY u.uid HAVING nroles > 1 
      ) inner1 
      INNER JOIN {users}
        ON inner1.uid = users.uid ;
";
$res = db_query($sql);
$exceptions = array();
while ( $exc = db_fetch_object($res) ) {
  $exceptions[$exc->uid] = $exc;
}

$sql = "SELECT u.uid, u.name, r.name as role, r.rid
          FROM {users} u 
            INNER JOIN {users_roles} ur
              ON u.uid = ur.uid
            INNER JOIN {role} r
              ON ur.rid = r.rid
          WHERE r.name IN ( 'team leader', 'team member', 'Team Coordinator' )";
            

$res = db_query($sql);

$map_creator_rid = db_result(db_query("SELECT rid FROM {role} WHERE name = 'map creator'"));

if ( ! $map_creator_rid ) {
  trigger_error("Failed to find a role called 'map creator'. Exiting.\n");
}

// not really full users, just the selected fields above
$users = array();

while ( $o = db_fetch_object($res) ) {
  $users[] = $o;
}

foreach ( $users as $u ) {
  print "\n\n";
  if ( in_array( $u->uid, array_keys($exceptions)) ) {
    print "skipping uid $u->uid \n";
    $skipped[] = $u;
    continue;
  }
  //if leader, insert this user into the role 'map creator'
  if ( $u->role === 'team leader' ) {
    // delete first in case this is redundant
    db_query('DELETE FROM {users_roles} WHERE uid = %d AND rid = %d', $u->uid, $map_creator_rid);
    db_query('INSERT INTO {users_roles} (uid, rid) VALUES (%d, %d)', $u->uid, $map_creator_rid);
  }
  // get all that user's maps 
  $sql = "
    SELECT n.nid,n.title
      FROM node n
        INNER JOIN og_uid ou
          ON n.nid = ou.nid 
      WHERE ou.uid = %d
        AND n.type = '%s'
  ";
  $res = db_query($sql, $u->uid, 'green_map');
  while ( $map = db_fetch_object($res) ) {
    print "User $u->name with uid $u->uid has map $map->title with nid $map->nid and is the $u->role \n";
    print_r($u);
    $roles_to_insert = array($u->uid => array($u->rid => 1));
    custom_insert_into_og_users_roles($roles_to_insert, $map->nid);
    custom_remove_role_from_user($u->uid, $u->rid);
  }
}

foreach ( $skipped as $e ) {
  print "Skipped: \n";
  print_r($e);
}

menu_rebuild();

function custom_remove_role_from_user($uid, $rid) {
  $sql = 'DELETE FROM {users_roles} WHERE uid = %d AND rid = %d';
  db_query($sql, $uid, $rid);
  print "Removed role $rid from user $uid\n";
}

/**
 * Process the form submission.
 */
 // stolen from og_user_roles
//function og_user_roles_page_form_submit($form, &$form_state)

function custom_insert_into_og_users_roles($roles_to_insert, $gid) {
  foreach ($roles_to_insert as $uid => $roles) {
    foreach ($roles as $rid => $checked) {
      $exists = db_result(db_query("SELECT * FROM {og_users_roles} WHERE uid = %d AND rid = %d AND gid = %d", $uid, $rid, $gid));
      if ($checked && !$exists) {
	    $ogr_id = variable_get('og_user_roles_counter', 0) + 1;
        variable_set('og_user_roles_counter', $ogr_id);
        db_query("INSERT INTO {og_users_roles} (uid, rid, gid, ogr_id) VALUES (%d, %d, %d, %d)", $uid, $rid, $gid, $ogr_id);
        $args['rid'] = $rid;
        $args['ogr_id'] = $ogr_id;
        module_invoke_all('og', 'user update', $gid, $uid, $args);
      }
      elseif (!$checked && $exists) {
        db_query("DELETE FROM {og_users_roles} WHERE uid = %d AND rid = %d AND gid = %d", $uid, $rid, $gid);
      }
    }
  }
}
