<?php

/**
 * Implementation of hook_user_default_permissions().
 */
function ogm_permissions_user_default_permissions() {
  $permissions = array();

  // Exported permission: Use PHP input for field settings (dangerous - grant with care)
  $permissions['Use PHP input for field settings (dangerous - grant with care)'] = array(
    'name' => 'Use PHP input for field settings (dangerous - grant with care)',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: access administration pages
  $permissions['access administration pages'] = array(
    'name' => 'access administration pages',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: access all views
  $permissions['access all views'] = array(
    'name' => 'access all views',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: access comments
  $permissions['access comments'] = array(
    'name' => 'access comments',
    'roles' => array(
      '0' => 'admin',
      '1' => 'anonymous user',
      '2' => 'authenticated user',
    ),
  );

  // Exported permission: access content
  $permissions['access content'] = array(
    'name' => 'access content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'anonymous user',
      '2' => 'authenticated user',
    ),
  );

  // Exported permission: access devel information
  $permissions['access devel information'] = array(
    'name' => 'access devel information',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: access epostcard
  $permissions['access epostcard'] = array(
    'name' => 'access epostcard',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: access forward
  $permissions['access forward'] = array(
    'name' => 'access forward',
    'roles' => array(
      '0' => 'admin',
      '1' => 'anonymous user',
      '2' => 'authenticated user',
    ),
  );

  // Exported permission: access frontpage
  $permissions['access frontpage'] = array(
    'name' => 'access frontpage',
    'roles' => array(
      '0' => 'Team Coordinator',
      '1' => 'admin',
      '2' => 'anonymous user',
      '3' => 'authenticated user',
      '4' => 'moderator',
      '5' => 'team leader',
      '6' => 'team member',
      '7' => 'translator',
      '8' => 'translator - advanced',
    ),
  );

  // Exported permission: access service links
  $permissions['access service links'] = array(
    'name' => 'access service links',
    'roles' => array(
      '0' => 'Team Coordinator',
      '1' => 'admin',
      '2' => 'anonymous user',
      '3' => 'authenticated user',
      '4' => 'moderator',
      '5' => 'team leader',
      '6' => 'team member',
      '7' => 'translator',
      '8' => 'translator - advanced',
    ),
  );

  // Exported permission: access site reports
  $permissions['access site reports'] = array(
    'name' => 'access site reports',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: access site-wide contact form
  $permissions['access site-wide contact form'] = array(
    'name' => 'access site-wide contact form',
    'roles' => array(
      '0' => 'admin',
      '1' => 'anonymous user',
      '2' => 'authenticated user',
    ),
  );

  // Exported permission: access taxonomy images
  $permissions['access taxonomy images'] = array(
    'name' => 'access taxonomy images',
    'roles' => array(
      '0' => 'admin',
      '1' => 'anonymous user',
      '2' => 'authenticated user',
    ),
  );

  // Exported permission: access user profiles
  $permissions['access user profiles'] = array(
    'name' => 'access user profiles',
    'roles' => array(
      '0' => 'admin',
      '1' => 'anonymous user',
      '2' => 'authenticated user',
    ),
  );

  // Exported permission: administer CAPTCHA settings
  $permissions['administer CAPTCHA settings'] = array(
    'name' => 'administer CAPTCHA settings',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer actions
  $permissions['administer actions'] = array(
    'name' => 'administer actions',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer all languages
  $permissions['administer all languages'] = array(
    'name' => 'administer all languages',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer blocks
  $permissions['administer blocks'] = array(
    'name' => 'administer blocks',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer chart
  $permissions['administer chart'] = array(
    'name' => 'administer chart',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer comments
  $permissions['administer comments'] = array(
    'name' => 'administer comments',
    'roles' => array(
      '0' => 'Team Coordinator',
      '1' => 'admin',
      '2' => 'moderator',
      '3' => 'team leader',
    ),
  );

  // Exported permission: administer content types
  $permissions['administer content types'] = array(
    'name' => 'administer content types',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer date tools
  $permissions['administer date tools'] = array(
    'name' => 'administer date tools',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer faq
  $permissions['administer faq'] = array(
    'name' => 'administer faq',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer faq order
  $permissions['administer faq order'] = array(
    'name' => 'administer faq order',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer features
  $permissions['administer features'] = array(
    'name' => 'administer features',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer files
  $permissions['administer files'] = array(
    'name' => 'administer files',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer filters
  $permissions['administer filters'] = array(
    'name' => 'administer filters',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer flags
  $permissions['administer flags'] = array(
    'name' => 'administer flags',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer forward
  $permissions['administer forward'] = array(
    'name' => 'administer forward',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer gmap_marker
  $permissions['administer gmap_marker'] = array(
    'name' => 'administer gmap_marker',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer group_invite
  $permissions['administer group_invite'] = array(
    'name' => 'administer group_invite',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer imageapi
  $permissions['administer imageapi'] = array(
    'name' => 'administer imageapi',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer imagecache
  $permissions['administer imagecache'] = array(
    'name' => 'administer imagecache',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer invisimail formatter
  $permissions['administer invisimail formatter'] = array(
    'name' => 'administer invisimail formatter',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer keys
  $permissions['administer keys'] = array(
    'name' => 'administer keys',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer languages
  $permissions['administer languages'] = array(
    'name' => 'administer languages',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer lightbox2
  $permissions['administer lightbox2'] = array(
    'name' => 'administer lightbox2',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer mass contact
  $permissions['administer mass contact'] = array(
    'name' => 'administer mass contact',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer menu
  $permissions['administer menu'] = array(
    'name' => 'administer menu',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer mollom
  $permissions['administer mollom'] = array(
    'name' => 'administer mollom',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer nodes
  $permissions['administer nodes'] = array(
    'name' => 'administer nodes',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer og_user_roles
  $permissions['administer og_user_roles'] = array(
    'name' => 'administer og_user_roles',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer openlayers
  $permissions['administer openlayers'] = array(
    'name' => 'administer openlayers',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer organic groups
  $permissions['administer organic groups'] = array(
    'name' => 'administer organic groups',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer pathauto
  $permissions['administer pathauto'] = array(
    'name' => 'administer pathauto',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer permissions
  $permissions['administer permissions'] = array(
    'name' => 'administer permissions',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer recaptcha
  $permissions['administer recaptcha'] = array(
    'name' => 'administer recaptcha',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer redirects
  $permissions['administer redirects'] = array(
    'name' => 'administer redirects',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer search
  $permissions['administer search'] = array(
    'name' => 'administer search',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer service links
  $permissions['administer service links'] = array(
    'name' => 'administer service links',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer site configuration
  $permissions['administer site configuration'] = array(
    'name' => 'administer site configuration',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer site-wide contact form
  $permissions['administer site-wide contact form'] = array(
    'name' => 'administer site-wide contact form',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer taxonomy
  $permissions['administer taxonomy'] = array(
    'name' => 'administer taxonomy',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer taxonomy images
  $permissions['administer taxonomy images'] = array(
    'name' => 'administer taxonomy images',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer translations
  $permissions['administer translations'] = array(
    'name' => 'administer translations',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer url aliases
  $permissions['administer url aliases'] = array(
    'name' => 'administer url aliases',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer users
  $permissions['administer users'] = array(
    'name' => 'administer users',
    'roles' => array(
      '0' => 'admin',
      '1' => 'moderator',
    ),
  );

  // Exported permission: administer views
  $permissions['administer views'] = array(
    'name' => 'administer views',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer voting api
  $permissions['administer voting api'] = array(
    'name' => 'administer voting api',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: administer widget
  $permissions['administer widget'] = array(
    'name' => 'administer widget',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: auto assign group roles
  $permissions['auto assign group roles'] = array(
    'name' => 'auto assign group roles',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: can disable taxonomy images
  $permissions['can disable taxonomy images'] = array(
    'name' => 'can disable taxonomy images',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: cancel own vote
  $permissions['cancel own vote'] = array(
    'name' => 'cancel own vote',
    'roles' => array(
      '0' => 'admin',
      '1' => 'authenticated user',
    ),
  );

  // Exported permission: change own username
  $permissions['change own username'] = array(
    'name' => 'change own username',
    'roles' => array(
      '0' => 'admin',
      '1' => 'authenticated user',
    ),
  );

  // Exported permission: choose whether to archive mass contact messages
  $permissions['choose whether to archive mass contact messages'] = array(
    'name' => 'choose whether to archive mass contact messages',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: collapse format fieldset by default
  $permissions['collapse format fieldset by default'] = array(
    'name' => 'collapse format fieldset by default',
    'roles' => array(
      '0' => 'admin',
      '1' => 'anonymous user',
      '2' => 'authenticated user',
    ),
  );

  // Exported permission: collapsible format selection
  $permissions['collapsible format selection'] = array(
    'name' => 'collapsible format selection',
    'roles' => array(
      '0' => 'admin',
      '1' => 'anonymous user',
      '2' => 'authenticated user',
    ),
  );

  // Exported permission: configure Mobile Tools
  $permissions['configure Mobile Tools'] = array(
    'name' => 'configure Mobile Tools',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: configure member roles
  $permissions['configure member roles'] = array(
    'name' => 'configure member roles',
    'roles' => array(
      '0' => 'admin',
      '1' => 'team leader',
    ),
  );

  // Exported permission: configure restricted member roles
  $permissions['configure restricted member roles'] = array(
    'name' => 'configure restricted member roles',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: create admin_message content
  $permissions['create admin_message content'] = array(
    'name' => 'create admin_message content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: create document content
  $permissions['create document content'] = array(
    'name' => 'create document content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'anonymous user',
      '2' => 'authenticated user',
    ),
  );

  // Exported permission: create faq
  $permissions['create faq'] = array(
    'name' => 'create faq',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: create gmap macro
  $permissions['create gmap macro'] = array(
    'name' => 'create gmap macro',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: create green_area content
  $permissions['create green_area content'] = array(
    'name' => 'create green_area content',
    'roles' => array(
      '0' => 'Team Coordinator',
      '1' => 'admin',
      '2' => 'anonymous user',
      '3' => 'authenticated user',
      '4' => 'moderator',
      '5' => 'team leader',
      '6' => 'team member',
    ),
  );

  // Exported permission: create green_map content
  $permissions['create green_map content'] = array(
    'name' => 'create green_map content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'map creator',
    ),
  );

  // Exported permission: create green_route content
  $permissions['create green_route content'] = array(
    'name' => 'create green_route content',
    'roles' => array(
      '0' => 'Team Coordinator',
      '1' => 'admin',
      '2' => 'anonymous user',
      '3' => 'authenticated user',
      '4' => 'moderator',
      '5' => 'team leader',
      '6' => 'team member',
    ),
  );

  // Exported permission: create green_site content
  $permissions['create green_site content'] = array(
    'name' => 'create green_site content',
    'roles' => array(
      '0' => 'Team Coordinator',
      '1' => 'admin',
      '2' => 'anonymous user',
      '3' => 'authenticated user',
      '4' => 'moderator',
      '5' => 'team leader',
      '6' => 'team member',
    ),
  );

  // Exported permission: create impact content
  $permissions['create impact content'] = array(
    'name' => 'create impact content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'anonymous user',
      '2' => 'authenticated user',
    ),
  );

  // Exported permission: create mapmaker_profile content
  $permissions['create mapmaker_profile content'] = array(
    'name' => 'create mapmaker_profile content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'moderator',
    ),
  );

  // Exported permission: create mass_contact content
  $permissions['create mass_contact content'] = array(
    'name' => 'create mass_contact content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: create og_subgroups
  $permissions['create og_subgroups'] = array(
    'name' => 'create og_subgroups',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: create page content
  $permissions['create page content'] = array(
    'name' => 'create page content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: create photo content
  $permissions['create photo content'] = array(
    'name' => 'create photo content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'anonymous user',
      '2' => 'authenticated user',
    ),
  );

  // Exported permission: create poll content
  $permissions['create poll content'] = array(
    'name' => 'create poll content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: create story content
  $permissions['create story content'] = array(
    'name' => 'create story content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: create support_forum_issue content
  $permissions['create support_forum_issue content'] = array(
    'name' => 'create support_forum_issue content',
    'roles' => array(
      '0' => 'Team Coordinator',
      '1' => 'admin',
      '2' => 'moderator',
      '3' => 'team leader',
      '4' => 'team member',
      '5' => 'translator',
      '6' => 'translator - advanced',
    ),
  );

  // Exported permission: create testimonial content
  $permissions['create testimonial content'] = array(
    'name' => 'create testimonial content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: create transport_direction content
  $permissions['create transport_direction content'] = array(
    'name' => 'create transport_direction content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: create url aliases
  $permissions['create url aliases'] = array(
    'name' => 'create url aliases',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: create video content
  $permissions['create video content'] = array(
    'name' => 'create video content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'anonymous user',
      '2' => 'authenticated user',
    ),
  );

  // Exported permission: delete any admin_message content
  $permissions['delete any admin_message content'] = array(
    'name' => 'delete any admin_message content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: delete any document content
  $permissions['delete any document content'] = array(
    'name' => 'delete any document content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: delete any green_area content
  $permissions['delete any green_area content'] = array(
    'name' => 'delete any green_area content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'team leader',
    ),
  );

  // Exported permission: delete any green_map content
  $permissions['delete any green_map content'] = array(
    'name' => 'delete any green_map content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'team leader',
    ),
  );

  // Exported permission: delete any green_route content
  $permissions['delete any green_route content'] = array(
    'name' => 'delete any green_route content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'team leader',
    ),
  );

  // Exported permission: delete any green_site content
  $permissions['delete any green_site content'] = array(
    'name' => 'delete any green_site content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'team leader',
    ),
  );

  // Exported permission: delete any impact content
  $permissions['delete any impact content'] = array(
    'name' => 'delete any impact content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'team leader',
    ),
  );

  // Exported permission: delete any mapmaker_profile content
  $permissions['delete any mapmaker_profile content'] = array(
    'name' => 'delete any mapmaker_profile content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: delete any mass_contact content
  $permissions['delete any mass_contact content'] = array(
    'name' => 'delete any mass_contact content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: delete any page content
  $permissions['delete any page content'] = array(
    'name' => 'delete any page content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: delete any photo content
  $permissions['delete any photo content'] = array(
    'name' => 'delete any photo content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'team leader',
    ),
  );

  // Exported permission: delete any poll content
  $permissions['delete any poll content'] = array(
    'name' => 'delete any poll content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: delete any story content
  $permissions['delete any story content'] = array(
    'name' => 'delete any story content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: delete any support_forum_issue content
  $permissions['delete any support_forum_issue content'] = array(
    'name' => 'delete any support_forum_issue content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'moderator',
    ),
  );

  // Exported permission: delete any testimonial content
  $permissions['delete any testimonial content'] = array(
    'name' => 'delete any testimonial content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'team leader',
    ),
  );

  // Exported permission: delete any transport_direction content
  $permissions['delete any transport_direction content'] = array(
    'name' => 'delete any transport_direction content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'team leader',
    ),
  );

  // Exported permission: delete any video content
  $permissions['delete any video content'] = array(
    'name' => 'delete any video content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'team leader',
    ),
  );

  // Exported permission: delete own admin_message content
  $permissions['delete own admin_message content'] = array(
    'name' => 'delete own admin_message content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'authenticated user',
    ),
  );

  // Exported permission: delete own document content
  $permissions['delete own document content'] = array(
    'name' => 'delete own document content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'authenticated user',
    ),
  );

  // Exported permission: delete own green_area content
  $permissions['delete own green_area content'] = array(
    'name' => 'delete own green_area content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'authenticated user',
      '2' => 'team leader',
    ),
  );

  // Exported permission: delete own green_map content
  $permissions['delete own green_map content'] = array(
    'name' => 'delete own green_map content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'authenticated user',
      '2' => 'team leader',
    ),
  );

  // Exported permission: delete own green_route content
  $permissions['delete own green_route content'] = array(
    'name' => 'delete own green_route content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'authenticated user',
      '2' => 'team leader',
    ),
  );

  // Exported permission: delete own green_site content
  $permissions['delete own green_site content'] = array(
    'name' => 'delete own green_site content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'authenticated user',
      '2' => 'team leader',
    ),
  );

  // Exported permission: delete own impact content
  $permissions['delete own impact content'] = array(
    'name' => 'delete own impact content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'authenticated user',
    ),
  );

  // Exported permission: delete own mapmaker_profile content
  $permissions['delete own mapmaker_profile content'] = array(
    'name' => 'delete own mapmaker_profile content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'authenticated user',
    ),
  );

  // Exported permission: delete own mass_contact content
  $permissions['delete own mass_contact content'] = array(
    'name' => 'delete own mass_contact content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'authenticated user',
    ),
  );

  // Exported permission: delete own page content
  $permissions['delete own page content'] = array(
    'name' => 'delete own page content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'authenticated user',
    ),
  );

  // Exported permission: delete own photo content
  $permissions['delete own photo content'] = array(
    'name' => 'delete own photo content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'authenticated user',
    ),
  );

  // Exported permission: delete own poll content
  $permissions['delete own poll content'] = array(
    'name' => 'delete own poll content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: delete own story content
  $permissions['delete own story content'] = array(
    'name' => 'delete own story content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'authenticated user',
    ),
  );

  // Exported permission: delete own support_forum_issue content
  $permissions['delete own support_forum_issue content'] = array(
    'name' => 'delete own support_forum_issue content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'authenticated user',
      '2' => 'moderator',
    ),
  );

  // Exported permission: delete own testimonial content
  $permissions['delete own testimonial content'] = array(
    'name' => 'delete own testimonial content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'authenticated user',
    ),
  );

  // Exported permission: delete own transport_direction content
  $permissions['delete own transport_direction content'] = array(
    'name' => 'delete own transport_direction content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'authenticated user',
    ),
  );

  // Exported permission: delete own video content
  $permissions['delete own video content'] = array(
    'name' => 'delete own video content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: delete revisions
  $permissions['delete revisions'] = array(
    'name' => 'delete revisions',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: display source code
  $permissions['display source code'] = array(
    'name' => 'display source code',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: download original image
  $permissions['download original image'] = array(
    'name' => 'download original image',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: download profiles
  $permissions['download profiles'] = array(
    'name' => 'download profiles',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: edit any admin_message content
  $permissions['edit any admin_message content'] = array(
    'name' => 'edit any admin_message content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: edit any document content
  $permissions['edit any document content'] = array(
    'name' => 'edit any document content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: edit any green_area content
  $permissions['edit any green_area content'] = array(
    'name' => 'edit any green_area content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'team leader',
    ),
  );

  // Exported permission: edit any green_map content
  $permissions['edit any green_map content'] = array(
    'name' => 'edit any green_map content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'team leader',
    ),
  );

  // Exported permission: edit any green_route content
  $permissions['edit any green_route content'] = array(
    'name' => 'edit any green_route content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'team leader',
    ),
  );

  // Exported permission: edit any green_site content
  $permissions['edit any green_site content'] = array(
    'name' => 'edit any green_site content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'moderator',
      '2' => 'team leader',
    ),
  );

  // Exported permission: edit any impact content
  $permissions['edit any impact content'] = array(
    'name' => 'edit any impact content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'team leader',
    ),
  );

  // Exported permission: edit any mapmaker_profile content
  $permissions['edit any mapmaker_profile content'] = array(
    'name' => 'edit any mapmaker_profile content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: edit any mass_contact content
  $permissions['edit any mass_contact content'] = array(
    'name' => 'edit any mass_contact content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: edit any page content
  $permissions['edit any page content'] = array(
    'name' => 'edit any page content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: edit any photo content
  $permissions['edit any photo content'] = array(
    'name' => 'edit any photo content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'team leader',
    ),
  );

  // Exported permission: edit any poll content
  $permissions['edit any poll content'] = array(
    'name' => 'edit any poll content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: edit any story content
  $permissions['edit any story content'] = array(
    'name' => 'edit any story content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: edit any support_forum_issue content
  $permissions['edit any support_forum_issue content'] = array(
    'name' => 'edit any support_forum_issue content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'moderator',
      '2' => 'team leader',
    ),
  );

  // Exported permission: edit any testimonial content
  $permissions['edit any testimonial content'] = array(
    'name' => 'edit any testimonial content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: edit any transport_direction content
  $permissions['edit any transport_direction content'] = array(
    'name' => 'edit any transport_direction content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: edit any video content
  $permissions['edit any video content'] = array(
    'name' => 'edit any video content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'team leader',
    ),
  );

  // Exported permission: edit faq
  $permissions['edit faq'] = array(
    'name' => 'edit faq',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: edit own admin_message content
  $permissions['edit own admin_message content'] = array(
    'name' => 'edit own admin_message content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: edit own document content
  $permissions['edit own document content'] = array(
    'name' => 'edit own document content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: edit own faq
  $permissions['edit own faq'] = array(
    'name' => 'edit own faq',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: edit own green_area content
  $permissions['edit own green_area content'] = array(
    'name' => 'edit own green_area content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'authenticated user',
    ),
  );

  // Exported permission: edit own green_map content
  $permissions['edit own green_map content'] = array(
    'name' => 'edit own green_map content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'authenticated user',
      '2' => 'team leader',
    ),
  );

  // Exported permission: edit own green_route content
  $permissions['edit own green_route content'] = array(
    'name' => 'edit own green_route content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'authenticated user',
    ),
  );

  // Exported permission: edit own green_site content
  $permissions['edit own green_site content'] = array(
    'name' => 'edit own green_site content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'team leader',
    ),
  );

  // Exported permission: edit own impact content
  $permissions['edit own impact content'] = array(
    'name' => 'edit own impact content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'authenticated user',
    ),
  );

  // Exported permission: edit own mapmaker_profile content
  $permissions['edit own mapmaker_profile content'] = array(
    'name' => 'edit own mapmaker_profile content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'moderator',
    ),
  );

  // Exported permission: edit own mass_contact content
  $permissions['edit own mass_contact content'] = array(
    'name' => 'edit own mass_contact content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: edit own page content
  $permissions['edit own page content'] = array(
    'name' => 'edit own page content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: edit own photo content
  $permissions['edit own photo content'] = array(
    'name' => 'edit own photo content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'team leader',
    ),
  );

  // Exported permission: edit own poll content
  $permissions['edit own poll content'] = array(
    'name' => 'edit own poll content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: edit own story content
  $permissions['edit own story content'] = array(
    'name' => 'edit own story content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: edit own support_forum_issue content
  $permissions['edit own support_forum_issue content'] = array(
    'name' => 'edit own support_forum_issue content',
    'roles' => array(
      '0' => 'Team Coordinator',
      '1' => 'admin',
      '2' => 'moderator',
      '3' => 'team leader',
      '4' => 'team member',
      '5' => 'translator',
      '6' => 'translator - advanced',
    ),
  );

  // Exported permission: edit own testimonial content
  $permissions['edit own testimonial content'] = array(
    'name' => 'edit own testimonial content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: edit own transport_direction content
  $permissions['edit own transport_direction content'] = array(
    'name' => 'edit own transport_direction content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: edit own video content
  $permissions['edit own video content'] = array(
    'name' => 'edit own video content',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: execute php code
  $permissions['execute php code'] = array(
    'name' => 'execute php code',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: export sites
  $permissions['export sites'] = array(
    'name' => 'export sites',
    'roles' => array(
      '0' => 'Team Coordinator',
      '1' => 'admin',
      '2' => 'team leader',
    ),
  );

  // Exported permission: export views
  $permissions['export views'] = array(
    'name' => 'export views',
    'roles' => array(
      '0' => 'admin',
      '1' => 'team leader',
      '2' => 'team member',
    ),
  );

  // Exported permission: flush imagecache
  $permissions['flush imagecache'] = array(
    'name' => 'flush imagecache',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: import media sets
  $permissions['import media sets'] = array(
    'name' => 'import media sets',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: import sites
  $permissions['import sites'] = array(
    'name' => 'import sites',
    'roles' => array(
      '0' => 'Team Coordinator',
      '1' => 'admin',
      '2' => 'team leader',
    ),
  );

  // Exported permission: inspect all votes
  $permissions['inspect all votes'] = array(
    'name' => 'inspect all votes',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: invite using group_invite
  $permissions['invite using group_invite'] = array(
    'name' => 'invite using group_invite',
    'roles' => array(
      '0' => 'Team Coordinator',
      '1' => 'admin',
      '2' => 'team leader',
    ),
  );

  // Exported permission: make widget
  $permissions['make widget'] = array(
    'name' => 'make widget',
    'roles' => array(
      '0' => 'admin',
      '1' => 'team leader',
    ),
  );

  // Exported permission: manage de translation overview priorities
  $permissions['manage de translation overview priorities'] = array(
    'name' => 'manage de translation overview priorities',
    'roles' => array(
      '0' => 'admin',
      '1' => 'translator - advanced',
    ),
  );

  // Exported permission: manage en translation overview priorities
  $permissions['manage en translation overview priorities'] = array(
    'name' => 'manage en translation overview priorities',
    'roles' => array(
      '0' => 'admin',
      '1' => 'translator - advanced',
    ),
  );

  // Exported permission: manage es translation overview priorities
  $permissions['manage es translation overview priorities'] = array(
    'name' => 'manage es translation overview priorities',
    'roles' => array(
      '0' => 'admin',
      '1' => 'translator - advanced',
    ),
  );

  // Exported permission: manage features
  $permissions['manage features'] = array(
    'name' => 'manage features',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: manage fr translation overview priorities
  $permissions['manage fr translation overview priorities'] = array(
    'name' => 'manage fr translation overview priorities',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: manage pt-br translation overview priorities
  $permissions['manage pt-br translation overview priorities'] = array(
    'name' => 'manage pt-br translation overview priorities',
    'roles' => array(
      '0' => 'admin',
      '1' => 'translator - advanced',
    ),
  );

  // Exported permission: manage registration codes
  $permissions['manage registration codes'] = array(
    'name' => 'manage registration codes',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: manage sv translation overview priorities
  $permissions['manage sv translation overview priorities'] = array(
    'name' => 'manage sv translation overview priorities',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: manage zh-hans translation overview priorities
  $permissions['manage zh-hans translation overview priorities'] = array(
    'name' => 'manage zh-hans translation overview priorities',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: no oguseredit
  $permissions['no oguseredit'] = array(
    'name' => 'no oguseredit',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: notify of path changes
  $permissions['notify of path changes'] = array(
    'name' => 'notify of path changes',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: ogur perm 01
  $permissions['ogur perm 01'] = array(
    'name' => 'ogur perm 01',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: ogur perm 02
  $permissions['ogur perm 02'] = array(
    'name' => 'ogur perm 02',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: ogur perm 03
  $permissions['ogur perm 03'] = array(
    'name' => 'ogur perm 03',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: ogur perm 04
  $permissions['ogur perm 04'] = array(
    'name' => 'ogur perm 04',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: ogur perm 05
  $permissions['ogur perm 05'] = array(
    'name' => 'ogur perm 05',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: ogur perm 06
  $permissions['ogur perm 06'] = array(
    'name' => 'ogur perm 06',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: ogur perm 07
  $permissions['ogur perm 07'] = array(
    'name' => 'ogur perm 07',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: ogur perm 08
  $permissions['ogur perm 08'] = array(
    'name' => 'ogur perm 08',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: ogur perm 09
  $permissions['ogur perm 09'] = array(
    'name' => 'ogur perm 09',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: ogur perm 10
  $permissions['ogur perm 10'] = array(
    'name' => 'ogur perm 10',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: override email address
  $permissions['override email address'] = array(
    'name' => 'override email address',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: override flood control
  $permissions['override flood control'] = array(
    'name' => 'override flood control',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: post comments
  $permissions['post comments'] = array(
    'name' => 'post comments',
    'roles' => array(
      '0' => 'admin',
      '1' => 'anonymous user',
      '2' => 'authenticated user',
    ),
  );

  // Exported permission: post comments without approval
  $permissions['post comments without approval'] = array(
    'name' => 'post comments without approval',
    'roles' => array(
      '0' => 'admin',
      '1' => 'anonymous user',
      '2' => 'authenticated user',
    ),
  );

  // Exported permission: post with no checking
  $permissions['post with no checking'] = array(
    'name' => 'post with no checking',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: rate content
  $permissions['rate content'] = array(
    'name' => 'rate content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'authenticated user',
    ),
  );

  // Exported permission: revert revisions
  $permissions['revert revisions'] = array(
    'name' => 'revert revisions',
    'roles' => array(
      '0' => 'admin',
      '1' => 'moderator',
    ),
  );

  // Exported permission: search content
  $permissions['search content'] = array(
    'name' => 'search content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'anonymous user',
      '2' => 'authenticated user',
    ),
  );

  // Exported permission: select different theme
  $permissions['select different theme'] = array(
    'name' => 'select different theme',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: send mass contact attachments
  $permissions['send mass contact attachments'] = array(
    'name' => 'send mass contact attachments',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: send mass contact e-mails
  $permissions['send mass contact e-mails'] = array(
    'name' => 'send mass contact e-mails',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: send to users in the Map Makers category
  $permissions['send to users in the Map Makers category'] = array(
    'name' => 'send to users in the Map Makers category',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: send to users in the Open GreenMap Users category
  $permissions['send to users in the Open GreenMap Users category'] = array(
    'name' => 'send to users in the Open GreenMap Users category',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: set user location
  $permissions['set user location'] = array(
    'name' => 'set user location',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: show format selection for blocks
  $permissions['show format selection for blocks'] = array(
    'name' => 'show format selection for blocks',
    'roles' => array(
      '0' => 'admin',
      '1' => 'anonymous user',
      '2' => 'authenticated user',
    ),
  );

  // Exported permission: show format selection for comments
  $permissions['show format selection for comments'] = array(
    'name' => 'show format selection for comments',
    'roles' => array(
      '0' => 'admin',
      '1' => 'anonymous user',
      '2' => 'authenticated user',
    ),
  );

  // Exported permission: show format selection for nodes
  $permissions['show format selection for nodes'] = array(
    'name' => 'show format selection for nodes',
    'roles' => array(
      '0' => 'admin',
      '1' => 'anonymous user',
      '2' => 'authenticated user',
    ),
  );

  // Exported permission: show format tips
  $permissions['show format tips'] = array(
    'name' => 'show format tips',
    'roles' => array(
      '0' => 'admin',
      '1' => 'anonymous user',
      '2' => 'authenticated user',
    ),
  );

  // Exported permission: show more format tips link
  $permissions['show more format tips link'] = array(
    'name' => 'show more format tips link',
    'roles' => array(
      '0' => 'admin',
      '1' => 'anonymous user',
      '2' => 'authenticated user',
    ),
  );

  // Exported permission: show node map
  $permissions['show node map'] = array(
    'name' => 'show node map',
    'roles' => array(
      '0' => 'admin',
      '1' => 'anonymous user',
      '2' => 'authenticated user',
    ),
  );

  // Exported permission: show user map
  $permissions['show user map'] = array(
    'name' => 'show user map',
    'roles' => array(
      '0' => 'admin',
      '1' => 'authenticated user',
    ),
  );

  // Exported permission: skip CAPTCHA
  $permissions['skip CAPTCHA'] = array(
    'name' => 'skip CAPTCHA',
    'roles' => array(
      '0' => 'Team Coordinator',
      '1' => 'admin',
      '2' => 'authenticated user',
      '3' => 'moderator',
      '4' => 'team leader',
      '5' => 'team member',
      '6' => 'translator',
      '7' => 'translator - advanced',
    ),
  );

  // Exported permission: submit latitude/longitude
  $permissions['submit latitude/longitude'] = array(
    'name' => 'submit latitude/longitude',
    'roles' => array(
      '0' => 'admin',
      '1' => 'anonymous user',
      '2' => 'authenticated user',
    ),
  );

  // Exported permission: submit translations to localization server
  $permissions['submit translations to localization server'] = array(
    'name' => 'submit translations to localization server',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: suggest a site
  $permissions['suggest a site'] = array(
    'name' => 'suggest a site',
    'roles' => array(
      '0' => 'admin',
      '1' => 'anonymous user',
      '2' => 'authenticated user',
    ),
  );

  // Exported permission: switch users
  $permissions['switch users'] = array(
    'name' => 'switch users',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: translate content
  $permissions['translate content'] = array(
    'name' => 'translate content',
    'roles' => array(
      '0' => 'admin',
      '1' => 'translator - advanced',
    ),
  );

  // Exported permission: translate interface
  $permissions['translate interface'] = array(
    'name' => 'translate interface',
    'roles' => array(
      '0' => 'admin',
      '1' => 'translator - advanced',
    ),
  );

  // Exported permission: upload files
  $permissions['upload files'] = array(
    'name' => 'upload files',
    'roles' => array(
      '0' => 'admin',
      '1' => 'authenticated user',
    ),
  );

  // Exported permission: upload files to comments
  $permissions['upload files to comments'] = array(
    'name' => 'upload files to comments',
    'roles' => array(
      '0' => 'Team Coordinator',
      '1' => 'admin',
      '2' => 'moderator',
      '3' => 'team leader',
      '4' => 'team member',
      '5' => 'translator',
      '6' => 'translator - advanced',
    ),
  );

  // Exported permission: use PHP for block visibility
  $permissions['use PHP for block visibility'] = array(
    'name' => 'use PHP for block visibility',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: use PHP for fivestar target
  $permissions['use PHP for fivestar target'] = array(
    'name' => 'use PHP for fivestar target',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: use advanced search
  $permissions['use advanced search'] = array(
    'name' => 'use advanced search',
    'roles' => array(
      '0' => 'admin',
      '1' => 'authenticated user',
    ),
  );

  // Exported permission: use on-page translation
  $permissions['use on-page translation'] = array(
    'name' => 'use on-page translation',
    'roles' => array(
      '0' => 'admin',
      '1' => 'translator',
      '2' => 'translator - advanced',
    ),
  );

  // Exported permission: use registration codes
  $permissions['use registration codes'] = array(
    'name' => 'use registration codes',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: use views exporter
  $permissions['use views exporter'] = array(
    'name' => 'use views exporter',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: user locations
  $permissions['user locations'] = array(
    'name' => 'user locations',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: view advanced help index
  $permissions['view advanced help index'] = array(
    'name' => 'view advanced help index',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: view advanced help popup
  $permissions['view advanced help popup'] = array(
    'name' => 'view advanced help popup',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: view advanced help topic
  $permissions['view advanced help topic'] = array(
    'name' => 'view advanced help topic',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: view date repeats
  $permissions['view date repeats'] = array(
    'name' => 'view date repeats',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: view faq page
  $permissions['view faq page'] = array(
    'name' => 'view faq page',
    'roles' => array(
      '0' => 'admin',
      '1' => 'anonymous user',
      '2' => 'authenticated user',
    ),
  );

  // Exported permission: view files uploaded to comments
  $permissions['view files uploaded to comments'] = array(
    'name' => 'view files uploaded to comments',
    'roles' => array(
      '0' => 'Team Coordinator',
      '1' => 'admin',
      '2' => 'moderator',
      '3' => 'team leader',
      '4' => 'team member',
      '5' => 'translator',
      '6' => 'translator - advanced',
    ),
  );

  // Exported permission: view imagecache mapkey
  $permissions['view imagecache mapkey'] = array(
    'name' => 'view imagecache mapkey',
    'roles' => array(
      '0' => 'admin',
    ),
  );

  // Exported permission: view imagecache taxonomy_image
  $permissions['view imagecache taxonomy_image'] = array(
    'name' => 'view imagecache taxonomy_image',
    'roles' => array(
      '0' => 'admin',
      '1' => 'anonymous user',
      '2' => 'authenticated user',
    ),
  );

  // Exported permission: view revisions
  $permissions['view revisions'] = array(
    'name' => 'view revisions',
    'roles' => array(
      '0' => 'admin',
      '1' => 'moderator',
    ),
  );

  // Exported permission: view translation overview assigments
  $permissions['view translation overview assigments'] = array(
    'name' => 'view translation overview assigments',
    'roles' => array(
      '0' => 'admin',
      '1' => 'translator - advanced',
    ),
  );

  // Exported permission: view uploaded files
  $permissions['view uploaded files'] = array(
    'name' => 'view uploaded files',
    'roles' => array(
      '0' => 'admin',
      '1' => 'anonymous user',
      '2' => 'authenticated user',
    ),
  );

  // Exported permission: vote on polls
  $permissions['vote on polls'] = array(
    'name' => 'vote on polls',
    'roles' => array(
      '0' => 'admin',
      '1' => 'authenticated user',
    ),
  );

  return $permissions;
}
