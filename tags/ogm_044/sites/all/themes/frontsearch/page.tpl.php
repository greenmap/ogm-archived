<head>

<?php print $scripts; ?>
<script type="text/javascript">
function lightboxonclick(){
if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)){ 
 for (i=0;i<document.links.length;i++){
document.links[i].setAttribute("target","_blank");
}
}
else
 for (i=0;i<document.links.length;i++){
var hHref=document.links[i].getAttribute("href");
hHref = hHref + "&lightboxtheme=true";
document.links[i].setAttribute("onclick","window.parent.parent.Lightbox.start({'href':'"+hHref+"'},false,true);");
document.links[i].setAttribute("href","javascript:void(0)");
}
}


</script>

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


  <title><?php print $head_title; ?></title>


  <meta name = "viewport" content = "width = device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;">
  <style>
  body {
    -webkit-text-size-adjust: none;
    min-height: 402px;
    padding:0;
    margin: 0;
    font-family: lucida grande, verdana, helvetica, arial;
    font-size: 13px;
  }
  .masthead{
  	background-color: #99cc33;
  	padding: 1px;
  	display: none;
  }
  
  #content-area {
  margin-top: -13px;
  }
  
  .pager li{
  height: 8px !important;
  }
  
  .view-proximity{
    color: #666;
  }
  .view-proximity a{
    text-decoration: none;
  }
  
  .view-proximity li{
  list-style-type: none;
  margin-left: -39px;
  padding-bottom: 6px !important;
  height: 56px;
  width: 230px;
  }
  
  .views-row {
  border-top:1px solid #8CC63F;
padding-top:5px;
  }
  
  .views-row-even {
  background: #D7EFC2;
  }
  
  .views-row-even .views-field-title {

  }
  
  .views-field-vid {
float:left;
height:25px;
margin-top:-15px;
width:25px;
  }
  
    .views-field-vid img{
  }
  
  .forward_links {
  display: none;
  }
  
  .messages {
  display: none !important;
  }
  
  .views-field-distance {
float:left;
font-size:10px;
height:10px;
margin-left:106px;
margin-top:-44px;
padding-top:3px;
text-align:right;
width:42px;
  }
  
  
.views-row-first .views-field-distance {
margin-top:-59px !important;
}

  .views-field-vid img{
  float: left;
  margin-right: 5px;
  margin-left: 7px;
  }
  
  .views-field-title {
float:left;
font-size:12px;
line-height:14px;
margin-left:-20px;
margin-top:29px;
width:150px;
  }
  
  .box-inner {
  display: none;
  }

  .pager{
  width:75px; 
  }
  
  .icons img {
  margin-right:8px;
  }
  
  #logo-image{
  display: none;
  }
    
  h1{
  	display: none;
  }
  
  h3{
  	font-size: 0.9em;
  	color:  #666;
  	margin-top: 5px;
  	margin-bottom: 5px;
  }
  
  .alpha{
  	font-size: .75em;
  }
    
  #footer{
  	font-size: .75em;
  }

  .messages status ul, .messages status li {
  list-style: none !important;
  }
  
  a {color: #333333;}
  a:hover {text-decoration: underline;}
  
  .messages error {display: none;}
  
  </style>

  <script src="http://code.google.com/apis/gears/gears_init.js" type="text/javascript" charset="utf-8"></script> 
  <script src="<?php print base_path() ?>sites/all/modules/custom/ogm_mobile/geo.js" type="text/javascript" charset="utf-8"></script> 


<body onLoad="lightboxonclick();">
          
     <div id="content-area">
                <h1 class="title"><?php print $title; ?></h1>
		    <?php print $messages; ?>      
    		<?php print $pre_content; ?>        
            <?php print $content; ?>
           

        </div>
    </div>
   <?php print $closure; ?>
   
</body>
</html>
