<?php
// $Id: page.tpl.php,v 1.14.2.6 2009/02/13 16:28:33 johnalbin Exp $

/**
 * @file page.tpl.php
 *
 * Theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $css: An array of CSS files for the current page.
 * - $directory: The directory the theme is located in, e.g. themes/garland or
 *   themes/garland/minelli.
 * - $is_front: TRUE if the current page is the front page. Used to toggle the mission statement.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Page metadata:
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $head_title: A modified version of the page title, for use in the TITLE tag.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $body_classes: A set of CSS classes for the BODY tag. This contains flags
 *   indicating the current layout (multiple columns, single column), the current
 *   path, whether the user is logged in, and so on.
 * - $body_classes_array: An array of the body classes. This is easier to
 *   manipulate then the string in $body_classes.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $mission: The text of the site mission, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $search_box: HTML to display the search box, empty if search has been disabled.
 * - $primary_links (array): An array containing primary navigation links for the
 *   site, if they have been configured.
 * - $secondary_links (array): An array containing secondary navigation links for
 *   the site, if they have been configured.
 *
 * Page content (in order of occurrance in the default page.tpl.php):
 * - $left: The HTML for the left sidebar.
 *
 * - $breadcrumb: The breadcrumb trail for the current page.
 * - $title: The page title, for use in the actual HTML content.
 * - $help: Dynamic help text, mostly for admin pages.
 * - $messages: HTML for status and error messages. Should be displayed prominently.
 * - $tabs: Tabs linking to any sub-pages beneath the current page (e.g., the view
 *   and edit tabs when displaying a node).
 *
 * - $content: The main content of the current Drupal page.
 *
 * - $right: The HTML for the right sidebar.
 *
 * Footer/closing data:
 * - $feed_icons: A string of all feed icons for the current page.
 * - $footer_message: The footer message as defined in the admin settings.
 * - $footer : The footer region.
 * - $closure: Final closing markup from any modules that have altered the page.
 *   This variable should always be output last, after all other dynamic content.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 */
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd"> 
<html>

<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; // suppressing Drupal's default styles because this is the minimal version of the mobile theme with no css ?>
  <?php // print $scripts; // suppressing Drupal's default js because this is the minimal version of the mobile theme ?>
  <meta name = "viewport" content = "width = device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;">
  <script src="http://code.google.com/apis/gears/gears_init.js" type="text/javascript" charset="utf-8"></script> 
  <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
  <script src="<?php print base_path() ?>sites/all/modules/custom/ogm_mobile/geo.js" type="text/javascript" charset="utf-8"></script>
  <link rel="stylesheet" media="all and (orientation:portrait)" href="portrait.css">
<link rel="stylesheet" media="all and (orientation:landscape)" href="landscape.css">
  <script type="text/javascript">
 var updateLayout = function() {
  if (window.innerWidth != currentWidth) {
    currentWidth = window.innerWidth;
    var orient = (currentWidth == 320) ? "profile" : "landscape";
    document.body.setAttribute("orient", orient);
    window.scrollTo(0, 1);
  }
};

iPhone.DomLoad(updateLayout);
setInterval(updateLayout, 500);
</script>
<style type="text/css">
body {
padding: 0;
}

fieldset {
background: #8cc63f !important;
border: #fff;
}

.row a {
text-decoration: none;
color:#ffffff;
font-family:arial;
font-size:20px;
font-weight:bold;
letter-spacing:3px;
text-transform:uppercase;
}

.first {
border-bottom:1px solid #ffffff;
}

.row {
min-height:33px;
padding-top:13px;
position:relative;
text-align:center;
width:100% !important;
z-index:5;
text-decoration: none;
background: url(img/buttonbg.png) repeat-x;
}

#footer {
font-size:0.75em;
margin-top:100px;
text-align:center;
}

</style>

</head>
<body onLoad="setTimeout(scrollTo, 100, 0, 1);" >

    <div class="toolbar">
    </div>
              <h1 class="title">What's on the Green Map?</h1>
<form class="panel">
<fieldset>
<a href="/sites/default/files/app/findsites/index.html">
<div class="row first">
<a href="/sites/default/files/app/findsites/index.html">Find Sites</a>
</div>
</a>
<a href="/sites/default/files/app/addsites/locate.html">
<div class="row last">
<a href="/sites/default/files/app/addsites/locate.html">Add Sites</a>
</div>
</a>

</fieldset>
        <div id="footer"><?php if ($footer_message): ?>
          &copy; Green Map&reg; System, <?php echo date("Y"); ?><br/>
          Visit GreenMap.org on your desktop
          </div>
</form>



        <?php endif; ?>
        </div>
    </div>
   <?php print $closure; ?>
   
</body>
</html>
