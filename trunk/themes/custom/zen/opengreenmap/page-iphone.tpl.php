<?php

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
 
  <meta name = "viewport" content = "width = device-width, height=default-height initial-scale = 1.0, user-scalable = no">
  
  <style>
  body {
  	margin 0px;
  	padding:0px;
  	
  }
  #page {
  	magin: 0px;
  	padding:0px;
  	left:0;
  	top:0;
  	position:absolute;
  }
  #gmap-view_gmap-gmap0 {
 /* 	width:100% !important;
  	height:100% !important;*/
  	margin:0;
  	padding:0;
  }
  .gmnoprint a, .gmnoprint a:hover, .gmnoprint a:active, .gmnoprint avisited {
  	border:0px;
  }
  .gmnoprint a img {
  	border:0px;
  }
  #admin-menu {
  	display:none;
  }
  #closure-blocks {
  	display:none;
  }
  ul {
  	list-style-type: none;
  	padding-left:0px;
  }
  .view-item {
  	border:1px solid black;
  	margin: 2px;
  	padding:2px;
  }
  /*fdba31*/
  #list_header {
  	color:#333;
  	font-size:1.5em;
  	
  	
  }
  .genre {
  	background-color:#8cc63f;
  	font-size:1.3em;
  	color:#fff;
  	margin:2px;
  	padding:2px;
  	display:block;
  }
  #logo-image {
  	margin-top:5px;
  	width:60px;
  }
  </style>
</head>

<body class="not-front no-sidebars simple">
<div id="page"><div id="page-inner">


      <div id="content"><div id="content-inner">
<?php
/*while(list($k,$v) = each($_GET)){
	echo $k . " " . $v . "|";
}
print($nid);*/
?>

        <div id="content-area">
          <?php print $content; ?>
        </div>



      </div></div> <!-- /#content-inner, /#content -->
    <?php if ($closure_region): ?>
      <div id="closure-blocks"><?php print $closure_region; ?></div>
    <?php endif; ?>

    <?php print $closure; ?>
</div></div>
<?php
	if($_GET['device'] == 'iphone'){
		echo '<script type="text/javascript" src="'.base_path().drupal_get_path('module','widget').'/iphone_map.js"></script>';
	}
		
	
  ?>
</body>
</html>
