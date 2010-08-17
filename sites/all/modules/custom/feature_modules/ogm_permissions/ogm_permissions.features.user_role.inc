<?php

/**
 * Implementation of hook_user_default_roles().
 */
function ogm_permissions_user_default_roles() {
  $roles = array();

  // Exported role: Team Coordinator
  $roles['Team Coordinator'] = array(
    'name' => 'Team Coordinator',
  );

  // Exported role: admin
  $roles['admin'] = array(
    'name' => 'admin',
  );

  // Exported role: anonymous user
  $roles['anonymous user'] = array(
    'name' => 'anonymous user',
  );

  // Exported role: authenticated user
  $roles['authenticated user'] = array(
    'name' => 'authenticated user',
  );

  // Exported role: moderator
  $roles['moderator'] = array(
    'name' => 'moderator',
  );

  // Exported role: team leader
  $roles['team leader'] = array(
    'name' => 'team leader',
  );

  // Exported role: team member
  $roles['team member'] = array(
    'name' => 'team member',
  );

  // Exported role: translator
  $roles['translator'] = array(
    'name' => 'translator',
  );

  // Exported role: translator - advanced
  $roles['translator - advanced'] = array(
    'name' => 'translator - advanced',
  );

  return $roles;
}
