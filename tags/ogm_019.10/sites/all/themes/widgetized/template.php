<?php
// $Id: template.php,v 1.17.2.1 2009/02/13 06:47:44 johnalbin Exp $

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
function mobile_theme(&$existing, $type, $theme, $path) {
  $hooks = zen_theme($existing, $type, $theme, $path);
  // Add your theme hooks like this:
  /*
  $hooks['hook_name_here'] = array( // Details go here );
  */
  // @TODO: Needs detailed comments. Patches welcome!
  return $hooks;
}

/**
 * Override theme_form().
 * Remove unneeded div.
 */
/*
function mobile_form($element) {
  // Anonymous div to satisfy XHTML compliance.
  $action = $element['#action'] ? 'action="'. check_url($element['#action']) .'" ' : '';
  return '<form '. $action .' accept-charset="UTF-8" method="'. $element['#method'] .'" id="'. $element['#id'] .'"'. drupal_attributes($element['#attributes']) .">\n". $element['#children'] ."\n</form>\n";
}
// */

/**
 * Override theme_form_element().
 * Remove unneeded div.
 */
function mobile_form_element($element, $value) {
  // This is also used in the installer, pre-database setup.
  $t = get_t();

  $required = !empty($element['#required']) ? '<span class="form-required" title="'. $t('This field is required.') .'">*</span>' : '';

  if (!empty($element['#title'])) {
    $title = $element['#title'];
    if (!empty($element['#id'])) {
      $output .= ' <label for="'. $element['#id'] .'">'. $t('!title: !required', array('!title' => filter_xss_admin($title), '!required' => $required)) ."</label>\n";
    }
    else {
      $output .= ' <label>'. $t('!title: !required', array('!title' => filter_xss_admin($title), '!required' => $required)) ."</label>\n";
    }
  }

  $output .= " $value\n";

  if (!empty($element['#description'])) {
    $output .= ' <div class="description">'. $element['#description'] ."</div>\n";
  }

  return $output;
}

function mobile_views_mini_pager($tags = array(), $limit = 10, $element = 0, $parameters = array(), $quantity = 9) {
  global $pager_page_array, $pager_total;

  // Calculate various markers within this pager piece:
  // Middle is used to "center" pages around the current page.
  $pager_middle = ceil($quantity / 2);
  // current is the page we are currently paged to
  $pager_current = $pager_page_array[$element] + 1;
  // max is the maximum page number
  $pager_max = $pager_total[$element];
  // End of marker calculations.


  $li_previous = theme('pager_previous', (isset($tags[1]) ? $tags[1] : t('<')), $limit, $element, 1, $parameters);
  if (empty($li_previous)) {
    $li_previous = "&nbsp;";
  }

  $li_next = theme('pager_next', (isset($tags[3]) ? $tags[3] : t('>')), $limit, $element, 1, $parameters);
  if (empty($li_next)) {
    $li_next = "&nbsp;";
  }

  if ($pager_total[$element] > 1) {
    $items[] = array(
      'class' => 'pager-previous',
      'data' => $li_previous,
    );

    $items[] = array(
      'class' => 'pager-current',
      'data' => t('@current of @max', array('@current' => $pager_current, '@max' => $pager_max)),
    );

    $items[] = array(
      'class' => 'pager-next',
      'data' => $li_next,
    );
    // return theme('item_list', $items, NULL, 'ul', array('class' => 'pager'));
    foreach ($items as $item) {
      $output .= ' <span class="' . $item['class'] . '"> ' . $item['data'] . ' </span> ';
    }
    return $output;
  }
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
function mobile_preprocess_page(&$vars, $hook) {
  if ($vars['node']->type == 'green_site') {
    unset($vars['title']);
  }
}

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
