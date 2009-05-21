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
if ($_GET['isSimple']) {
	include('page-simple.tpl.php');
	return;
}else if($_GET['iphone'] == 'iphone'){
	include('page-iphone.tpl.php');	
	return;
}/*
if(detectiPhone()){
	include('page-iphone.tpl.php');	
	return;
}*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language; ?>" xml:lang="<?php print $language; ?>">

<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>
  <script type="text/javascript">
    var Drupal_base_path = '<?php print base_path()?>';
  </script>

  <!--[if IE]>
    <link rel="stylesheet" href="<?php print $base_path . $directory; ?>/ie.css" type="text/css">
    <?php if ($subtheme_directory && file_exists($subtheme_directory .'/ie.css')): ?>
      <link rel="stylesheet" href="<?php print $base_path . $subtheme_directory; ?>/ie.css" type="text/css">
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


      <?php if ($logo || $site_name || $site_slogan || $title): ?>
        <div id="logo-title">
        <?php opengreenmap_custom_login();?>
          <?php if ($logo): ?>
            <div id="logo"><a href="<?php print $base_path; ?>" title="<?php print t('Home'); ?>" rel="home"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" id="logo-image" /></a></div>
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

    </div></div> <!-- /#header-inner, /#header -->

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

        <?php if ($breadcrumb or $tabs or $help or $messages): ?>
          <div id="content-header">
            <?php print $breadcrumb; ?>
            <?php print $messages; ?>
            <?php if ($tabs): ?>
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

      <?php if ($sidebar_right): ?>
        <div id="sidebar-right"><div id="sidebar-right-inner">
          <?php print $sidebar_right; ?>
        </div></div> <!-- /#sidebar-right-inner, /#sidebar-right -->
      <?php endif; ?>

    </div></div> <!-- /#main-inner, /#main -->

    <div id="footer"><div id="footer-inner">

      <div id="footer-message"><?php print $footer_message; ?></div>

    </div></div> <!-- /#footer-inner, /#footer -->
  </div></div> <!-- /#page-inner, /#page -->


  <?php if ($closure_region  || $search_box): ?>
    <div id="closure-region" class="clear-block">
      <div id="donte-button"><a href="http://www.opengreenmap.org/en/donate"><img src="<?php print base_path().path_to_theme(); ?>/opengreenmap/images/donate_button.gif" alt="Donate to GreenMaps"></a></div>
      <div id="closure-blocks"><?php print $closure_region; ?></div>
      <?php if ($search_box): ?>
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


</body>
</html>
