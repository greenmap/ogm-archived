<?php
// $Id: template.php,v 1.4.2.1 2007/04/18 03:38:59 drumm Exp $

/**
 * Sets the body-tag class attribute.
 *
 * Adds 'sidebar-left', 'sidebar-right' or 'sidebars' classes as needed.
 */
function phptemplate_body_class($sidebar_left, $sidebar_right) {
  if ($sidebar_left != '' && $sidebar_right != '') {
    $class = 'sidebars';
  }
  else {
    if ($sidebar_left != '') {
      $class = 'sidebar-left';
    }
    if ($sidebar_right != '') {
      $class = 'sidebar-right';
    }
  }

  if (isset($class)) {
    print ' class="'. $class .'"';
  }
}

/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return a string containing the breadcrumb output.
 */
function phptemplate_breadcrumb($breadcrumb) {
  if (!empty($breadcrumb)) {
    return '<div class="breadcrumb">'. implode(' › ', $breadcrumb) .'</div>';
  }
}

/**
 * Allow themable wrapping of all comments - this overrides default placement of comments. to print comments, use theme('comment_wrapper')
 */
function phptemplate_comment_wrapperOLD($content = '', $type = 'comments') {
  // Cache values with these static variables.
  // Will fill when $content has value and $type is 'comments' --default.
  static $all_comments;
  // Will fill when $content has value and $type is 'form'.
  static $comment_form;
 
  // Default output.
  $output = '';
 
  // if $content has a value then fill static variables depending on $type.
  // else fill $output to return below.
  if (!empty($content)) {
    if ($type == 'comments') {
      $all_comments = $content;
    }
    elseif ($type == 'form') {
      $comment_form = $content;
    }
  }
  else {
    if (isset($all_comments)) {
      $output .= $all_comments;
    }
    if (isset($comment_form)) {
      $output .= $comment_form;
    }
  }
 
  // Double check $output before returning the surrounding markup.
  if (!empty($output)) {
    return '<div id="comments">'. $output .'</div>';
  } else {
  	return 'error: no comments...<br>' . $content;
  }
}

function phptemplate_comment_wrappersimple($content = '') {
  // Cache values with these static variables.
  static $all_comments;

  // Default output.
  $output = '';
 
  // if $content has a value then fill static variable.
  // else fill $output to return below.
  if (!empty($content)) {
    $all_comments = $content;
  }
  elseif (isset($all_comments)) {
    $output .= $all_comments;
  }
 
  // Double check $output before returning the surrounding markup.
  if (!empty($output)) {
    return '<div id="comments">'. $output .'</div>';
  }
}



function phptemplate_comment_wrapper($content, $type = null) {
  static $node_type;
  if (isset($type)) $node_type = $type;
  
  if (!$content) {
    return '<p>'. t('No comments.') . '</p>';
  }
  elseif (!$content || $node_type == 'forum') {
    return '<div id="comments">'. $content . '</div>';
  }
  else {
    return '<div id="comments"><h2 class="comments">'. t('Comments') .'</h2>'. $content .'</div>';
  }
}

/**
 * Override or insert PHPTemplate variables into the templates.
 */
function _phptemplate_variables($hook, $vars) {
  if ($hook == 'page') {

    if ($secondary = menu_secondary_local_tasks()) {
      $output = '<span class="clear"></span>';
      $output .= "<ul class=\"tabs secondary\">\n". $secondary ."</ul>\n";
      $vars['tabs2'] = $output;
    }

    // Hook into color.module
    if (module_exists('color')) {
      _color_page_alter($vars);
    }
    return $vars;
  }
  return array();
}

/**
 * Returns the rendered local tasks. The default implementation renders
 * them as tabs.
 *
 * @ingroup themeable
 */
function phptemplate_menu_local_tasks() {
  $output = '';

  if ($primary = menu_primary_local_tasks()) {
    $output .= "<ul class=\"tabs primary\">\n". $primary ."</ul>\n";
  }

  return $output;
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


/**
* Theme a gmap marker label.
*/
function phptemplate_gmap_views_marker_label($view, $fields, $entry) {
return _phptemplate_callback('gmap_views_marker_label', array('view' => $view, 'fields' =>
$fields, 'entry' => $entry));
}