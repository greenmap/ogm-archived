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
  
   <?php
	if($_GET['view']) {
		echo '<script type="text/javascript" src="'.base_path().drupal_get_path('module','widget').'/map.js"></script>';
	}
  ?>
  
</head>

<body class="not-front no-sidebars simple">
<div id="page"><div id="page-inner">


      <div id="content"><div id="content-inner">
<?php
/*while(list($k,$v) = each($_GET)){
	echo $k . " " . $v . "|";
}*/
print($nid);
?>

        <div id="content-area">
          <?php print $content; ?>
        </div>



      </div></div> <!-- /#content-inner, /#content -->

</div></div>
</body>
</html>
