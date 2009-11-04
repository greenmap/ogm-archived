<?php?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
	
		<title><?php print $head_title; ?></title>
  		<?php print $head; ?>
 		<?php print $styles; // suppressing Drupal's default styles because this is the minimal version of the mobile theme with no css ?>
 		<?php print $scripts; // suppressing Drupal's default js because this is the minimal version of the mobile theme ?>

		
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=0;" />
		<link media="screen" href="<?php print base_path() ?>sites/all/themes/richmobile/richmonile.css" type= "text/css" rel="stylesheet" />
		<script src="<?php print base_path() ?>sites/all/themes/richmobile/scripts.js" type="text/javascript" charset="utf-8"></script>
	
		<script src="http://code.google.com/apis/gears/gears_init.js" type="text/javascript" charset="utf-8"></script> 
  	    <script src="<?php print base_path() ?>sites/all/modules/custom/ogm_mobile/geo.js" type="text/javascript" charset="utf-8"></script> 

</head>


<body onLoad="setTimeout(scrollTo, 100, 0, 1);" >


 <div id="header">
		<div id="nav" onclick="javascript:showElement('navwin')">Menu</div>
			<span class="logo"><img src="http://greenmap.org/dev/ogm_miikka3/sites/all/themes/mobile/img/logo.png" height="38px"></span>
		</div>
		
		<div id="navwin" style="display:none">
	    	<div id="dropsheet"></div>	
	
	   	 <div class="wrapper">
				<div id="nav-head">
					<div id="close-nav" onclick="javascript:showElement('navwin')">&nbsp;
					</div>
				</div>
		
			<a class="row1 col1"></a>
			<a class="row1 col2"></a>
			<a class="row1 col3" href="http://greenmap.org/dev/ogm_miikka3/mobile" onclick="myEventTracker('NAV', 'Click', 'Home'); return true;"></a>
			<a class="row2 col1"></a>
			<a class="row2 col2" href="http://greenmap.org/dev/ogm_miikka3/sites/all/themes/mobile/explore.html" onclick="myEventTracker('NAV', 'Click', 'Home'); return true;"></a>
			<a class="row2 col3" href="javascript:hideNAV();"></a>
			<div style="display: block;">
			    <img src="http://greenmap.org/dev/ogm_miikka3/sites/all/themes/mobile/img/nav.png">
	        </div>	
	     </div>	
</div>



 <?php if ($logo): ?>
            <div class="masthead"><center><img src="<?php print $logo; ?>" alt="<?php print t('Open Green Map'); ?>" id="logo-image" /></center></div>
          <?php endif; ?>
    
    <?php print $breadcrumb; ?>        
     <div id="content-area">
     		<img src="http://greenmap.org/dev/ogm_miikka3/sites/all/themes/mobile/img/ogm_white_logo.png">
            <h1 class="title"><?php print $title; ?></h1>
		    <?php print $messages; ?>      
    		<?php print $pre_content; ?>        
            <?php print $content; ?>
           
        <div id="footer"><?php if ($footer_message): ?>
          &copy; Green Map&reg; System, 2009</div>
        <?php endif; ?>
        </div>
    </div>
   <?php print $closure; ?>
   
</body>   
</html>
