<?php

/**
 * Implementation of HOOK_theme().
 */
function STARTERKIT_theme(&$existing, $type, $theme, $path) {
  $hooks = zen_theme($existing, $type, $theme, $path);
  return $hooks;
}

drupal_add_js(path_to_theme() .'/superfish.js');
drupal_add_js(path_to_theme() .'/custom_user_menu.js');

/**
 * Override or insert PHPTemplate variables into the page templates.
 *
 * @param $vars
 *   A sequential array of variables to pass to the theme template.
 */

function opengreenmap_preprocess_page(&$vars) {
  if($vars['node']->type == 'green_map'){
  	$vars['node_is_map'] = TRUE;
	if($country = $vars['node']->field_country[0]['value']){
  $countries =  _location_supported_countries();
   		  $countryname = $countries[$country];
	}
	$vars['location'] = array('city' => $vars['node']->field_city_region[0]['value'], 'country' => $countryname);
  }
}

/* TT - custom code to tweak the exposed filter */

function phptemplate_views_filters($form) {
	$view = $form['view']['#value'];
		foreach ($view->exposed_filter as $count => $expose) {
		   $label = '<h3>'.$expose['label'].'</h3>'; // this does nothing
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
 * Return rendered tabset.
 *
 * @themable
 */
function phptemplate_tabset($element) {
  $output = '<div id="tabs-'. $element['#tabset_name'] .'"'. drupal_attributes($element['#attributes']) .'>';
  $output .= '<ul class="tabs clear-block">';
  foreach (element_children($element) as $key) {
    if (isset($element[$key]['#type']) && $element[$key]['#type'] == 'tabpage') {
      // Ensure the tab has content before rendering it.
      if (
        (isset($element[$key]['#ajax_url']) && !empty($element[$key]['#ajax_url'])) ||
        (isset($element[$key]['#content']) && !empty($element[$key]['#content'])) ||
        (isset($element[$key]['#children']) && !empty($element[$key]['#children']))
      ) {
        $output .= '<li'. drupal_attributes($element[$key]['#attributes']) .'><a href="' . $element[$key]['#url'] . '">'. $element[$key]['#title'] .'</a></li>';
      }
    }
  }
  $output .= '</ul>';
  if (isset($element['#children'])) {
    $output .= $element['#children'];
  }
  $output .= '</div>';
  return $output;
}


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

function opengreenmap_filter_tips_more_info() {
  return '<p>'. l(
    t('More information about formatting options'),
    'filter/tips',
    array(
      'attributes' => array('target' => '_blank'),
    )
    ) .'</p>';
}


function opengreenmap_openlayers_cck_map($field = array(), $map = array()) {
  $title = check_plain($field['widget']['label']);
  $description = content_filter_xss($field['widget']['description']);
  $output = '';

  // Check for errors
  if (!empty($map['errors'])) {
    return $output;
  }

  $output = '
    <div id="openlayers-cck-map-container-' . $map['id'] . '" class="form-item openlayers-cck-map-container">
      <label for="openlayers-cck-map-' . $map['id'] . '">' . $title . ':</label>
      <div class="description openlayers-cck-map-instructions">
        ' . t('Click the tools in the upper right-hand corner of the map to switch between draw mode and zoom/pan mode. Draw your shape, double-clicking to finish. You may edit your shape using the control points. To delete a shape, select it and press the delete key. To delete a vertex hover over it and press the d key.') . '
      </div>
      ' . $map['themed'] . '
      <div class="description openlayers-cck-map-description">
        ' . $description . '
      </div>
      <div class="openlayers-cck-actions">
        <a href="#" id="' . $map['id'] . '-wkt-switcher" rel="' . $map['id'] . '">' . t('Show/Hide WKT Fields') . '</a>
      </div>
    </div>
  ';
  return $output;
}
