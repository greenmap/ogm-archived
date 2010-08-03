<?php
/*
$_GET['isSimple'] = false;
if ( (arg(0)=='node' && arg(2) == 'simple') || (arg(0)=='forward' && arg(2) == 'simple') || (arg(0)=='abuse' && arg(4) == 'simple') || $_GET[theme] == 'simple' ) {
	$_GET['isSimple'] = true;
	include('page-simple.tpl.php');
	return;
}
if(arg(0) == 'greenmap_widget'){
	$_GET['isSimple'] = true;
	include('page-simple.tpl.php');
	return;
}
*/
global $language;
if ($_GET['isSimple']) {
	include('page-simple.tpl.php');
	return;
}
if ($_GET['lightboxtheme']) {
	include('page-inlightbox.tpl.php');
	return;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--page.tpl.php-->
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language; ?>" xml:lang="<?php print $language->language; ?>">

<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>
  <script type="text/javascript">
    var Drupal_base_path = '<?php print base_path()?>';
    var Drupal_language = '<?php print $language->language ?>';
  </script>

  <!--[if IE]>
    <link rel="stylesheet" href="<?php print base_path() . path_to_theme(); ?>/ie.css" type="text/css">
    <?php if ($subtheme_directory && file_exists($subtheme_directory .'/ie.css')): ?>
      <link rel="stylesheet" href="<?php print $base_path . $subtheme_directory; ?>/ie.css" type="text/css">
    <?php endif; ?>
  <![endif]-->
  <!--[if IE 8]>
    <link rel="stylesheet" href="<?php print base_path() . path_to_theme(); ?>/ie8.css" type="text/css">
    <?php if ($subtheme_directory && file_exists($subtheme_directory .'/ie.css')): ?>
      <link rel=" stylesheet" href="<?php print $base_path . $subtheme_directory; ?>/ie.css" type="text/css">
      <link rel="stylesheet" href="<?php print $base_path . $subtheme_directory; ?>/ie8.css" type="text/css">
    <?php endif; ?>
  <![endif]-->
 <!--[if IE 7]>
    <link rel="stylesheet" href="<?php print base_path() . path_to_theme(); ?>/ie7.css" type="text/css">
    <?php if ($subtheme_directory && file_exists($subtheme_directory .'/ie.css')): ?>
      <link rel=" stylesheet" href="<?php print $base_path . $subtheme_directory; ?>/ie.css" type="text/css">
    <?php endif; ?>
  <![endif]-->



  <?php print $scripts; ?>
</head>

<body class="<?php print $body_classes; ?>">

  <div id="page"><div id="page-inner">

    <a name="top" id="navigation-top"></a>
    <?php /* <div id="skip-to-nav"><a href="#navigation"><?php print t('Skip to Navigation'); ?></a></div> */ ?>

    <div id="header"><div id="header-inner" class="clear-block">


      <?php if ($header): ?>
        <div id="header-blocks">
          <?php print $header; ?>
        </div> <!-- /#header-blocks -->
      <?php endif; ?>
    </div></div> <!-- /#header-inner, /#header -->

      <?php if ($logo || $site_name || $site_slogan || $title): ?>
        <div id="logo-title">
        <?php opengreenmap_custom_login();?>
          <?php if ($logo): ?>
            <div id="logo"><a href="<?php print $language->language == 'en' ? '/home' : url('<front>'); ?>" title="<?php print t('Home'); ?>" rel="home"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" id="logo-image" /></a></div>
          <?php endif; ?>

          <?php if ($site_name): ?>
            <?php
              // Use an H1 only on the homepage
              $tag = $is_front ? 'h1' : 'div';
            ?>
            <<?php print $tag; ?> id='site-name'><strong>
              <a href="<?php print $base_path; ?>" title="<?php print t('Home'); ?>" rel="home">
                <?php print $site_name; ?>
              </a>
            </strong></<?php print $tag; ?>>
          <?php endif; ?>

		  <?php $titlestyle = $node_is_map ? 'node_is_map' : ''; ?>
		  <?php if ($title): ?>
			  <div class="maptitle <?php print $titlestyle; ?>">
				  <h1 class="title"><?php print $title; ?></h1>
				  <?php if ($node_is_map): ?>
				  	<span id="location"><?php print $location['city'] . ' ' . $location['country'] ; ?></span>
				  <?php endif; ?>
			  </div>
		  <?php endif; ?>


      <?php if ($site_slogan): ?>
        <div id='site-slogan'><?php print $site_slogan; ?></div>
      <?php endif; ?>

      <?php if ($header_advert): ?>
        <div id="header_advert">
          <?php print $header_advert; ?>
        </div> <!-- /#header-advert -->
      <?php endif; ?>

        </div> <!-- /#logo-title -->
      <?php endif; ?>



    <div id="main" class="clear-block"><div id="main-inner" class="clear-block<?php if ($secondary_links || $navbar) { print ' with-navbar'; } ?>">
      <div id="content"><div id="content-inner">

        <?php if ($mission): ?>
          <div id="mission"><?php print $mission; ?></div>
        <?php endif; ?>

        <?php if ($content_top): ?>
          <div id="content-top">
            <?php print $content_top; ?>
          </div> <!-- /#content-top -->
        <?php endif; ?>

        <!--[if lt IE 7]>
        <center>
        <div class="messages warning ie_warning_message" style="text-align: center; width: 50%;">
          <?php print(t('This website is not optimized for IE6 or below. Please upgrade or switch to another browser.')); ?>
        </div>
        </center>
        <![endif]-->

        <?php if ($breadcrumb or $tabs or $help or $messages): ?>
          <div id="content-header">
            <?php print $breadcrumb; ?>
            <?php print $messages; ?>
            <?php if ($tabs): ?>
              <?php
              if (arg(0) == 'node' && is_numeric(arg(1)) && arg(2) && !$node) {
                $node = node_load(arg(1));
              }
              if ($node->type == 'green_map') {
                $view_string = t('View');
                $tabs = str_replace('<span class="tab">'. $view_string .'</span>',
                    '<span class="tab">'.t('View Map').'</span>', $tabs);
              }
              ?>
              <div class="tabs"><?php print $tabs; ?></div>
            <?php endif; ?>
            <?php print $help; ?>
          </div> <!-- /#content-header -->
        <?php endif; ?>

        <div id="content-area">
          <?php print $content; ?>
        </div>

        <?php if ($feed_icons): ?>
          <div class="feed-icons"><?php print $feed_icons; ?></div>
        <?php endif; ?>

        <?php if ($content_bottom): ?>
          <div id="content-bottom">
            <?php print $content_bottom; ?>
          </div> <!-- /#content-bottom -->
        <?php endif; ?>

      </div></div> <!-- /#content-inner, /#content -->

      <?php if ($secondary_links || $navbar): ?>
        <div id="navbar"><div id="navbar-inner">

          <a name="navigation" id="navigation"></a>

          <?php if ($secondary_links): ?>
            <div id="secondary">
              <?php print theme('links', $secondary_links); ?>
            </div> <!-- /#secondary -->
          <?php endif; ?>

          <?php print $navbar; ?>

        </div></div> <!-- /#navbar-inner, /#navbar -->
      <?php endif; ?>

      <?php if ($sidebar_left): ?>
        <div id="sidebar-left"><div id="sidebar-left-inner">
          <?php print $sidebar_left; ?>
        </div></div> <!-- /#sidebar-left-inner, /#sidebar-left -->
      <?php endif; ?>

      <?php if ($right): ?>
        <div id="sidebar-right"><div id="sidebar-right-inner">
          <?php print $right; ?>
        </div></div> <!-- /#sidebar-right-inner, /#sidebar-right -->
      <?php endif; ?>

    </div></div> <!-- /#main-inner, /#main -->

    <div id="footer"><div id="footer-inner">

      <div id="footer-message"><?php print $footer_message; ?></div>

    </div></div> <!-- /#footer-inner, /#footer -->
  </div></div> <!-- /#page-inner, /#page -->


  <?php if ($closure_region  || $search_box): ?>
    <div id="closure-region" class="clear-block">
      <?php
      $theme_path = base_path().path_to_theme().'/images/';
      $donate_image = 'donate_button.gif';
      $donate_link = url('donate');
      if ($language->language == 'es' || $language->language == 'pt-br') {
        $donate_image = 'donate_'. $language->language .'.gif';
      }
      if ($language->language == 'es') {
        $donate_link = url('donar');
      }
      $donate_image = $theme_path.$donate_image;
      ?>
      <div id="donte-button"><a href="<?php print $donate_link ?>"><img src="<?php print $donate_image; ?>" alt="<?php print t('Donate to GreenMaps') ?>"></a></div>
      <div id="closure-blocks"><?php print $closure_region; ?></div>
      <?php if ( FALSE ): // was if ( $search_box ), but search box needs to be disabled due to redundancy ?>
        <div id="search-box">
          <?php print $search_box; ?>
        </div> <!-- /#search-box -->
      <?php endif; ?>
    </div><!-- /#clusure-region -->
  <?php endif; ?>

  <?php if($devel): ?>
    <div id="devel" class="clear-block"><?php print $devel; ?></div>
  <?php endif;?>

  <?php print $closure; ?>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try{
var pageTracker = _gat._getTracker("UA-418876-5");
pageTracker._trackPageview();
} catch(err) {}</script>

</body>
</html>
<!--/page.tpl.php-->
