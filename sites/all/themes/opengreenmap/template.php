<?php
/**
 * @file
 * Contains theme override functions and preprocess functions for the theme.
 *
 * ABOUT THE TEMPLATE.PHP FILE
 *
 *   The template.php file is one of the most useful files when creating or
 *   modifying Drupal themes. You can add new regions for block content, modify
 *   or override Drupal's theme functions, intercept or make additional
 *   variables available to your theme, and create custom PHP logic. For more
 *   information, please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/theme-guide
 *
 * OVERRIDING THEME FUNCTIONS
 *
 *   The Drupal theme system uses special theme functions to generate HTML
 *   output automatically. Often we wish to customize this HTML output. To do
 *   this, we have to override the theme function. You have to first find the
 *   theme function that generates the output, and then "catch" it and modify it
 *   here. The easiest way to do it is to copy the original function in its
 *   entirety and paste it here, changing the prefix from theme_ to STARTERKIT_.
 *   For example:
 *
 *     original: theme_breadcrumb()
 *     theme override: STARTERKIT_breadcrumb()
 *
 *   where STARTERKIT is the name of your sub-theme. For example, the
 *   zen_classic theme would define a zen_classic_breadcrumb() function.
 *
 *   If you would like to override any of the theme functions used in Zen core,
 *   you should first look at how Zen core implements those functions:
 *     theme_breadcrumbs()      in zen/template.php
 *     theme_menu_item_link()   in zen/template.php
 *     theme_menu_local_tasks() in zen/template.php
 *
 *   For more information, please visit the Theme Developer's Guide on
 *   Drupal.org: http://drupal.org/node/173880
 *
 * CREATE OR MODIFY VARIABLES FOR YOUR THEME
 *
 *   Each tpl.php template file has several variables which hold various pieces
 *   of content. You can modify those variables (or add new ones) before they
 *   are used in the template files by using preprocess functions.
 *
 *   This makes THEME_preprocess_HOOK() functions the most powerful functions
 *   available to themers.
 *
 *   It works by having one preprocess function for each template file or its
 *   derivatives (called template suggestions). For example:
 *     THEME_preprocess_page    alters the variables for page.tpl.php
 *     THEME_preprocess_node    alters the variables for node.tpl.php or
 *                              for node-forum.tpl.php
 *     THEME_preprocess_comment alters the variables for comment.tpl.php
 *     THEME_preprocess_block   alters the variables for block.tpl.php
 *
 *   For more information on preprocess functions and template suggestions,
 *   please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/node/223440
 *   and http://drupal.org/node/190815#template-suggestions
 */

/*
 * Add any conditional stylesheets you will need for this sub-theme.
 *
 * To add stylesheets that ALWAYS need to be included, you should add them to
 * your .info file instead. Only use this section if you are including
 * stylesheets based on certain conditions.
 */
/* -- Delete this line if you want to use and modify this code
// Example: optionally add a fixed width CSS file.
if (theme_get_setting('STARTERKIT_fixed')) {
  drupal_add_css(path_to_theme() . '/layout-fixed.css', 'theme', 'all');
}
// */

/**
 * Implementation of HOOK_theme().
 */
function STARTERKIT_theme(&$existing, $type, $theme, $path) {
  $hooks = zen_theme($existing, $type, $theme, $path);
  // Add your theme hooks like this:
  /*
  $hooks['hook_name_here'] = array( // Details go here );
  */
  // @TODO: Needs detailed comments. Patches welcome!
  return $hooks;
}
/**
 * Override or insert variables into all templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered (name of the .tpl.php file.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_page(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_node(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_comment(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_block(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

drupal_add_js(path_to_theme() .'/jquery.hoverIntent.minified.js');
drupal_add_js(path_to_theme() .'/superfish.js');
drupal_add_js(path_to_theme() .'/custom_user_menu.js');


/* left over from the D5 theme version*/
/*
 * Initialize theme settings
 */
// include_once 'theme-settings-init.php';




/**
 * Override or insert PHPTemplate variables into the page templates.
 *
 * @param $vars
 *   A sequential array of variables to pass to the theme template.
 */

function opengreenmap_preprocess_page(&$vars) {
  //if (arg(0) == 'node' && is_numeric(arg(1)) && arg(2) == '') {
   // $vars['content_is_node'] = TRUE;
  // }
  // print_r($vars['node']->field_city_region[0]['value']);
  if($vars['node']->type == 'green_map'){
  	$vars['node_is_map'] = TRUE;
	if($country = $vars['node']->field_country[0]['value']){
// 		  $countries = location_views_countries();
  $countries =  _location_supported_countries();
   		  $countryname = $countries[$country];
	}
	$vars['location'] = array('city' => $vars['node']->field_city_region[0]['value'], 'country' => $countryname);
  }
}

/* TT - custom code to tweak the exposed filter */

function phptemplate_views_filters($form) {
	$view = $form['view']['#value'];
		// print_r($view);
		foreach ($view->exposed_filter as $count => $expose) {
		   $label = '<h3>'.$expose['label'].'</h3>'; // this does nothing
		   // print_r($form);
		   // print_r($form["filter0"]["#options"]);
		   // could hack with $form["filter0"][#options];
		   // $form["filter0"]["#options"]["#prefix"] = 'xxx';
		   $formelement = drupal_render($form["op$count"]) . drupal_render($form["filter$count"]);
		   $o .= '<div class="form-element-'.$count.'">'.$label.$formelement.'</div>';
		}

	$o .=  drupal_render($form['submit']);

	return $o . drupal_render($form);
}


/***** TT - custom code to theme popup info windows *****/

function phptemplate_gmap_views_marker_label_removeme($view,$fields,$entry) {
  $marker_label = '';
  $marker_directions = '';
//  drupal_add_css(path_to_theme() .'/histmarkers_map.css');
  $marker_label = '<div class="gmap-infowin">'
        .'... <b>some html containing php to grab relevant $node info for tab1 called Marker</b>'
        .'</div>'
  ;

  $marker_directionstxt = '... <b>some html for tab2 called Directions</b>...';

  $marker_directions = '<div class="gmap-infowin">'
        .'<h1 class="title">Directions</h1>'
        .'<div class="marker-text">'. $marker_directionstxt
        .'</div>'
        .'</div>'
  ;

  $marker_tabs = array(
    'Marker' => $marker_label,
    'Directions' => $marker_directions,
  );
  return $marker_tabs;
}


//***** TT - twostage theming of popup window

function phptemplate_gmap_views_marker_label_removeme3($view, $fields, $entry) {
$marker_tabs = array();
$marker_tabs[0] = _phptemplate_callback('gmap_views_marker_label', array('view' => $view, 'fields' =>
$fields, 'entry' => $entry));
$marker_tabs[1] = $entry->node_title ;
$marker_tabs[2] = $entry->nid;
return $marker_tabs;
}


/**
* Theme a gmap marker label.
*/
function phptemplate_gmap_views_marker_label_removeme2($view, $fields, $entry) {
return _phptemplate_callback('gmap_views_marker_label', array('view' => $view, 'fields' =>
$fields, 'entry' => $entry));
}

/**
 * Switch to different tpl file if viewing simple version
 */

/**
* This snippet loads up different page-type.tpl.php layout
* files automatically. For use in a page.tpl.php file.
*
* This works with Drupal 4.5,  Drupal 4.6 and Drupal 4.7
*/

if (arg(0)=="node" && arg(2)=="simple") {/* check if the path is example.com/admin */
    include 'page-simple.tpl.php'; /*load a custom page-admin.tpl.php */
    return; }

/**
* Catch the theme_user_profile function, and redirect through the template api
*/
// function phptemplate_user_profile($user, $fields = array()) {
//   // Pass to phptemplate, including translating the parameters to an associative array. The element names are the names that the variables
//   // will be assigned within your template.
//   /* potential need for other code to extract field info */
//   return _phptemplate_callback('user_profile', array('user' => $user, 'fields' => $fields));
// }


/*insert more layout calls here before the call to page-default.tpl.php */


/**
 * views template to output a view.
 * This code was generated by the views theming wizard
 * Date: Tue, 07/01/2008 - 13:23
 * View: list_of_impacts_for_site
 *
 * This function goes in your template.php file
 */
function phptemplate_views_view_list_list_of_impacts_for_site($view, $nodes, $type) {
  $fields = _views_get_fields();

  $taken = array();

  // Set up the fields in nicely named chunks.
  foreach ($view->field as $id => $field) {
    $field_name = $field['field'];
    if (isset($taken[$field_name])) {
      $field_name = $field['queryname'];
    }
    $taken[$field_name] = true;
    $field_names[$id] = $field_name;
  }

  // Set up some variables that won't change.
  $base_vars = array(
    'view' => $view,
    'view_type' => $type,
  );

  foreach ($nodes as $i => $node) {
    $vars = $base_vars;
    $vars['node'] = $node;
    $vars['count'] = $i;
    $vars['stripe'] = $i % 2 ? 'even' : 'odd';
    foreach ($view->field as $id => $field) {
      $name = $field_names[$id];
      $vars[$name] = views_theme_field('views_handle_field', $field['queryname'], $fields, $field, $node, $view);
      if (isset($field['label'])) {
        $vars[$name . '_label'] = $field['label'];
      }
    }
    $items[] = _phptemplate_callback('impact', $vars);
  }
  if ($items) {
    return theme('item_list', $items);
  }
}


/**
 * TT - Duplicate of theme_menu_local_task()
 * But this removes the og tab for adding a user.
 * If we ever upgrade to Drupal 6 we can use hook_menu_alter() instead
 */

// function zen_menu_local_task($mid, $active, $primary) {
//   $item = menu_get_item($mid);
//   //remove og tab for adding a user
//   $pattern1 = '/og\/users\/(\d+)\/add_user/';
//   preg_match($pattern1, $item['path'], $c1);
//   $matches1 = count($c1);
//
//   // rename 'email' tab for groups, to 'email members'
//   $pattern2 = '/node\/(\d+)\/email/';
//   preg_match($pattern2, $item['path'], $c2);
//   $matches2 = count($c2);
//
//   if ($matches1) {
//     return '';
//   }
//
//   elseif ($matches2) {
//     // change title of menu link
// 	$item['title'] = t('Email Team');
// 	$link = theme('menu_item_link', $item, $item);
// 	if($active) {
// 		$activeclass = "active";
// 	}
// 	return '<li class="' . $activeclass . '">'. $link ."</li>\n";
//   }
//
//   elseif ($active) {
//   	// Drupal default
//     return '<li class="active">'. menu_item_link($mid) ."</li>\n";
//   }
//   else {
//   	// Drupal default
//     return '<li>'. menu_item_link($mid) ."</li>\n";
//   }
// }

/**
 * Custom user login block
 */

function opengreenmap_custom_login() {
  global $user;

  $output = '<div id="custom-login">';
  if ($user->uid == 0) {
    $output .= '<span class="additional">';
    $output .=  l(t('Create new account'), 'user/register');
    $output .= '</span>';
    $output .= '<span class="uaction">';
    $output .= l(t('Log In'), 'user/login', array('query' => array('destination' => 'user')));
    $output .= '</span>';
  }
  else {
    $output .= '<span class="additional">';
    $output .= '<span class="name">'. $user->name .'</span>';
    $output .= '</span>';
    $output .= '<span class="uaction">';
    $output .= l(t('Log Out'), 'logout');
    $output .= '</span>';
  }
  $output .= '</div>';
  print $output;
}

