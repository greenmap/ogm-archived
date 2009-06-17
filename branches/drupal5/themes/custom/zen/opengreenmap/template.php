<?php
drupal_add_js(path_to_theme() .'/opengreenmap/jquery.hoverIntent.minified.js');
drupal_add_js(path_to_theme() .'/opengreenmap/superfish.js');
drupal_add_js(path_to_theme() .'/opengreenmap/custom_user_menu.js');

// $Id: template.php,v 1.1.2.1 2008/02/14 11:38:36 johnalbin Exp $

/**
 * @file
 *
 * OVERRIDING THEME FUNCTIONS
 *
 * The Drupal theme system uses special theme functions to generate HTML output
 * automatically. Often we wish to customize this HTML output. To do this, we
 * have to override the theme function. You have to first find the theme
 * function that generates the output, and then "catch" it and modify it here.
 * The easiest way to do it is to copy the original function in its entirety and
 * paste it here, changing the prefix from theme_ to phptemplate_ or zen_. For
 * example:
 *
 *   original: theme_breadcrumb()
 *   theme override: zen_breadcrumb()
 *
 * DIFFERENCES BETWEEN ZEN SUB-THEMES AND NORMAL DRUPAL SUB-THEMES
 *
 * The Zen theme allows its sub-themes to have their own template.php files. The
 * only restriction with these files is that they cannot redefine any of the
 * functions that are already defined in Zen's main template files:
 *   template.php, template-menus.php, and template-subtheme.php.
 * Every theme override function used in those files is documented below in this
 * file.
 *
 * Also remember that the "main" theme is still Zen, so your theme override
 * functions should be named as such:
 *  theme_block()      becomes  zen_block()
 *  theme_feed_icon()  becomes  zen_feed_icon()  as well
 *
 * However, there are two exceptions to the "theme override functions should use
 * 'zen' and not 'mytheme'" rule. They are as follows:
 *
 * Normally, for a theme to define its own regions, you would use the
 * THEME_regions() fuction. But for a Zen sub-theme to define its own regions,
 * use the function name
 *   STARTERKIT_regions()
 * where STARTERKIT is the name of your sub-theme. For example, the zen_classic
 * theme would define a zen_classic_regions() function.
 *
 * For a sub-theme to add its own variables, instead of _phptemplate_variables,
 * use these functions:
 *   STARTERKIT_preprocess_page(&$vars)     to add variables to the page.tpl.php
 *   STARTERKIT_preprocess_node(&$vars)     to add variables to the node.tpl.php
 *   STARTERKIT_preprocess_comment(&$vars)  to add variables to the comment.tpl.php
 *   STARTERKIT_preprocess_block(&$vars)    to add variables to the block.tpl.php
 */


/*
 * Initialize theme settings
 */
include_once 'theme-settings-init.php';


/*
 * Sub-themes with their own page.tpl.php files are seen by PHPTemplate as their
 * own theme (seperate from Zen). So we need to re-connect those sub-themes
 * with the main Zen theme.
 */
include_once './'. drupal_get_path('theme', 'zen') .'/template.php';


/*
 * Add the stylesheets you will need for this sub-theme.
 *
 * To add stylesheets that are in the main Zen folder, use path_to_theme().
 * To add stylesheets thar are in your sub-theme's folder, use path_to_subtheme().
 */

// Add any stylesheets you would like from the main Zen theme.
drupal_add_css(path_to_subtheme() .'/html-elements.css', 'theme', 'all');
drupal_add_css(path_to_theme() .'/tabs.css', 'theme', 'all');

// Then add styles for this sub-theme.
drupal_add_css(path_to_subtheme() .'/layout.css', 'theme', 'all');
drupal_add_css(path_to_subtheme() .'/opengreenmap.css', 'theme', 'all');

// Avoid IE5 bug that always loads @import print stylesheets
zen_add_print_css(path_to_subtheme() .'/print.css');


/**
 * Declare the available regions implemented by this theme.
 *
 * @return
 *   An array of regions.
 */

function opengreenmap_regions() {
  return array(
    'left' => t('left sidebar'),
    'right' => t('right sidebar'),
    'navbar' => t('navigation bar'),
    'content_top' => t('content top'),
    'content_bottom' => t('content bottom'),
    'header' => t('header'),
    'footer' => t('footer'),
    'closure_region' => t('closure'),
    'header_advert' => t('header advert'),
    'devel' => t('devel'),
  );
}
// */


/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return
 *   A string containing the breadcrumb output.
 */
/* -- Delete this line if you want to use this function
function zen_breadcrumb($breadcrumb) {
  return '<div class="breadcrumb">'. implode(' › ', $breadcrumb) .' ›</div>';
}
// */


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

/**
 * Override or insert PHPTemplate variables into the node templates.
 *
 * @param $vars
 *   A sequential array of variables to pass to the theme template.
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_node(&$vars) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert PHPTemplate variables into the comment templates.
 *
 * @param $vars
 *   A sequential array of variables to pass to the theme template.
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_comment(&$vars) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert PHPTemplate variables into the block templates.
 *
 * @param $vars
 *   A sequential array of variables to pass to the theme template.
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_block(&$vars) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */


/**
 * Override the Drupal search form using the search-theme-form.tpl.php file.
 */

function phptemplate_search_theme_form($form) {
  return _phptemplate_callback('search_theme_form', array('form' => $form), array('search-theme-form'));
}
// */

/**
 * Generate the HTML representing a given menu item ID.
 *
 * An implementation of theme_menu_item_link()
 *
 * @param $item
 *   array The menu item to render.
 * @param $link_item
 *   array The menu item which should be used to find the correct path.
 * @return
 *   string The rendered menu item.
 */
/* -- Delete this line if you want to use this function
function zen_menu_item_link($item, $link_item) {
  // If an item is a LOCAL TASK, render it as a tab
  $tab = ($item['type'] & MENU_IS_LOCAL_TASK) ? TRUE : FALSE;
  return l(
    $tab ? '<span class="tab">'. check_plain($item['title']) .'</span>' : $item['title'],
    $link_item['path'],
    !empty($item['description']) ? array('title' => $item['description']) : array(),
    !empty($item['query']) ? $item['query'] : NULL,
    !empty($link_item['fragment']) ? $link_item['fragment'] : NULL,
    FALSE,
    $tab
  );
}
// */

/**
 * Duplicate of theme_menu_local_tasks() but adds clear-block to tabs.
 */
/* -- Delete this line if you want to use this function
function zen_menu_local_tasks() {
  $output = '';

  if ($primary = menu_primary_local_tasks()) {
    $output .= '<ul class="tabs primary clear-block">'. $primary .'</ul>';
  }
  if ($secondary = menu_secondary_local_tasks()) {
    $output .= '<ul class="tabs secondary clear-block">'. $secondary .'</ul>';
  }

  return $output;
}
// */

/**
 * Overriding theme_comment_wrapper to add CSS id around all comments
 * and add "Comments" title above
 */
/* -- Delete this line if you want to use this function
function zen_comment_wrapper($content) {
  return '<div id="comments"><h2 id="comments-title" class="title">'. t('Comments') .'</h2>'. $content .'</div>';
}
// */

/**
 * Duplicate of theme_username() with rel=nofollow added for commentators.
 */
/* -- Delete this line if you want to use this function
function zen_username($object) {

  if ($object->uid && $object->name) {
    // Shorten the name when it is too long or it will break many tables.
    if (drupal_strlen($object->name) > 20) {
      $name = drupal_substr($object->name, 0, 15) .'...';
    }
    else {
      $name = $object->name;
    }

    if (user_access('access user profiles')) {
      $output = l($name, 'user/'. $object->uid, array('title' => t('View user profile.')));
    }
    else {
      $output = check_plain($name);
    }
  }
  else if ($object->name) {
    // Sometimes modules display content composed by people who are
    // not registered members of the site (e.g. mailing list or news
    // aggregator modules). This clause enables modules to display
    // the true author of the content.
    if ($object->homepage) {
      $output = l($object->name, $object->homepage, array('rel' => 'nofollow'));
    }
    else {
      $output = check_plain($object->name);
    }

    $output .= ' ('. t('not verified') .')';
  }
  else {
    $output = variable_get('anonymous', t('Anonymous'));
  }

  return $output;
}
// */



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
function phptemplate_user_profile($user, $fields = array()) {
  // Pass to phptemplate, including translating the parameters to an associative array. The element names are the names that the variables
  // will be assigned within your template.
  /* potential need for other code to extract field info */
  return _phptemplate_callback('user_profile', array('user' => $user, 'fields' => $fields));
}


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

function zen_menu_local_task($mid, $active, $primary) {
  $item = menu_get_item($mid);
  //remove og tab for adding a user
  $pattern1 = '/og\/users\/(\d+)\/add_user/';
  preg_match($pattern1, $item['path'], $c1);
  $matches1 = count($c1);

  // rename 'email' tab for groups, to 'email members'
  $pattern2 = '/node\/(\d+)\/email/';
  preg_match($pattern2, $item['path'], $c2);
  $matches2 = count($c2);

  if ($matches1) {
    return '';
  }

  elseif ($matches2) {
    // change title of menu link
	$item['title'] = t('Email Team');
	$link = theme('menu_item_link', $item, $item);
	if($active) {
		$activeclass = "active";
	}
	return '<li class="' . $activeclass . '">'. $link ."</li>\n";
  }

  elseif ($active) {
  	// Drupal default
    return '<li class="active">'. menu_item_link($mid) ."</li>\n";
  }
  else {
  	// Drupal default
    return '<li>'. menu_item_link($mid) ."</li>\n";
  }
}

/**
 * Custom user login block
 */

function opengreenmap_custom_login() {
  global $user;

  $output = '<div id="custom-login">';
  if ($user->uid == 0) {
    $output .= '<div class="additional">';
    $output .= '<ul class="menu"><li>'. l(t('Create new account'), 'user/register');
//     $menu = module_invoke('menu', 'block', 'view', 161);
    $output .= $menu['content'];

    $output .= '</li></ul></div>';
    $output .= '<div class="uaction">';
    $output .= l(t('Log In'), 'user/login');
    $output .= '</div>';
  }
  else {
//     $output .= '<div class="name">'. $user->name .':</div>';
    $output .= '<div class="additional">';
//     $output .= l(t('My account'), 'user');
    $output .= '<ul class="menu"><li><span class="name">'. $user->name .'</span>';

    $menu = module_invoke('menu', 'block', 'view', 161);
    $output .= $menu['content'];

    $output .= '</li></ul></div>';
    $output .= '<div class="uaction">';
    $output .= l(t('Log Out'), 'logout');
    $output .= '</div>';
  }
  $output .= '</div>';
  print $output;
}

