<?php

/*
 *   the key to the array must be '#pattern#' where pattern is the string to
 *   match. See the manual for preg_replace for details. 
 *
 *   You can also use '/pattern/'
 */
$by_referer_config = array(
  // key is a pattern to match in a drupal path
    '#mobile/list#' => array(
    // string 'referers' is always the key here
    'referers' => array(
      // key is pattern for referer, value is name of theme
      '#greenmap.org/greenhouse/files/widget/wgn.html#' => 'widgetized','#greenmap.org/greenhouse/files/widget/wgngreen.html#' => 'widgetizedgreen','#/sites/all/themes/frontsearch/ogmfront.html#' => 'frontsearch'
    ),
  ),
   '#^taxsearch#' => array(
    // string 'referers' is always the key here
    'referers' => array(
      // key is pattern for referer, value is name of theme
      '#greenmap.org/greenhouse/files/widget/wgn.html#' => 'widgetized','#greenmap.org/greenhouse/files/widget/wgngreen.html#' => 'widgetizedgreen','#greenmap.org/greenhouse/files/widget/ogmfront.html#' => 'frontsearch'

    ),
  ),
 	//new mobile edits
 	//maplocate is the map result page
     '#maplocate#' => array(
    // string 'referers' is always the key here
    'referers' => array(
      // key is pattern for referer, value is name of theme
      '#markfielbig.com/files/web#' => 'iphoneapp','#addsites/locate.html#' => 'iphoneapp'
    ),
  ),
  //mobile is just the root for errors
     '#mobile#' => array(
    // string 'referers' is always the key here
    'referers' => array(
      // key is pattern for referer, value is name of theme
      '#markfielbig.com/files/web#' => 'iphoneapp','#addsites/locate.html#' => 'iphoneapp'
    ),
  ),
  //add is the actual suggest page with the form in it
     '#^node/add/green-site#' => array(
    // string 'referers' is always the key here
    'referers' => array(
      // key is pattern for referer, value is name of theme
      '#markfielbig.com/files/web#' => 'iphoneapp','#addsites/locate.html#' => 'iphoneapp','#opengreenmap.org/maplocate#' => 'iphoneapp'
    ),
  ),
  'DEBUG' => FALSE,
);
