<div id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?> clear-block">


<?php if ($page == 0): ?>
  <h2><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
<?php endif; ?>


<?php
foreach($node->taxonomy as $key => $value) {
	$tid = $key;
	$icon = taxonomy_image_display($tid);
	$category_tid = taxonomy_get_parents($tid);
	foreach($category_tid as $key2 => $value2) {
		$genre_tids = taxonomy_get_parents($key2); // this gets the  genre, to be inserted as a class into things that need to be colored according to category
		foreach($genre_tids as $key3 => $value3) {
			$genre_tid = $key3;
			$genre_name = $value3->name;
			$genre_name_lc = strtolower($genre_name);
		}
	}
}
?>
<div class="taximage <?php print $genre_name_lc; ?>">
	<?php print $icon . $terms; ?>
</div>

<h1 class="icontitle <?php print $genre_name_lc; ?>"><?php print $title; ?></h1>

<div class="greenmapnodelocation">
	<?php  // print minimap if it exists, or otherwise print a message telling them to set lat & long
	
	$block = module_invoke('gmap_location', 'block', 'view', 0); 
	if ($block) {
		print $block['content']; 
	} else {
		$maperror = l(t('Error: We were not able to get the latitude and longitude for your site from the information you entered. 
						Please edit your site, and click the location on the large map.'),'node/' . $node->nid . '/edit', NULL, NULL, 'gmap-loc1-gmap0');
		print $maperror;
	} ?>
</div>

<div class="fivestar">
	<?php
	$fivestarwidget = fivestar_widget_form($node);
	print $fivestarwidget;
	?>
</div>

<?php if ($location[name] > '') { ?>
    <div class="location name"> <?php print $location[name]; ?> </div>
<?php } ?>
<?php if ($location[street] > '') { ?>
    <div class="location street"> <?php print $location[street]; ?> </div>
<?php } ?>
<?php if ($location[additional] > '') { ?>
    <div class="location additional"> <?php print $location[additional]; ?> </div>
<?php } ?>
<?php if ($location[city] > '') { ?>
    <div class="location city"> <?php print $location[city]; ?> </div>
<?php } ?>
<?php if ($location[postal_code] > '' || $location[province] > '') { ?>
    <div class="location postalcode"> <?php print $location[province] . ' ' . $location[postal_code]; ?> </div>
<?php } ?>


<?php if ($field_phone[0] > '') { ?>
    <div class="fieldphone"> <?php print content_format('field_phone', $field_phone[0]); ?> </div>
<?php } ?>
<?php if ($field_email[0] > '') { ?>
    <div class="fieldemail"> <?php print content_format('field_email', $field_email[0]); ?> </div>
<?php } ?>
<?php if ($field_web[0] > '') { ?>
    <div class="fieldweb"> <?php print content_format('field_web', $field_web[0]); ?> </div>
<?php } ?>

<div class="meta">
	<span class="submitted"><img src="<?php print base_path() . path_to_theme() . '/img/mapper.gif' ?>" width="20px" height="19px" alt="mapped by <?php print $node->name; ?>" />mapped by <?php print l($node->name,'user/' . $node->uid); ?></span>
	<?php
		if($links[abuse_flag_node] > '') { // this doesn't work properly - doesn't hide this for people who created the site
			?><span class="flag">
			<?php $img_code = '<img src="' . base_path() . path_to_theme() . '/img/flag.gif" alt="Flag this as innapropriate" />'; 
			print l($img_code,'abuse/report/node/' . $node->nid, NULL, NULL, NULL, NULL, TRUE); ?>
			<?php 
			print l(t('flag this'),'abuse/report/node/' . $node->nid);
			?></span><?php 
		}
	?>
</div>

<?php // print theme('comment_wrapper') ; // doesn't work ?>
  <?php
  // prepare content for the media tab
  if(content_format('field_image', $field_image[0]) > '') {
  	foreach ($field_image as $item) { 
    	$images .= content_format('field_image', $item);
	} 
  }
  if(content_format('field_video', $field_video[0]) > '') {
  	foreach ($field_video as $item) { 
    	$videos .= content_format('field_video', $item); 
	} 
  }  
  if($images > '' || $videos > '') {
  	$multimedia = $images . $videos;
  }
  
  // this sets up the tabs for the page

  $form = array();

  $form['tabs'] = array(
    '#type' => 'tabset',
  );
  $form['tabs']['tab1'] = array(
    '#type' => 'tabpage',
    '#title' => t('Overview'),
	'#weight' => '-6',
    '#content' => content_format('field_details', $field_details[0]) 
  );
  // theme('comment_wrapper') pulls in comments formatted in template.php, though it doesn't work. comment_render($node) does work but it shows up twice.
  $form['tabs']['tab2'] = array(
    '#type' => 'tabpage',
    '#title' => t('Comments'),
	'#weight' => '-4',
    '#content' => '<div class="mycomments">'  . comment_render($node) . '</div>', 
  );
//  $form['tabs']['tab3'] = array(
//    '#type' => 'tabpage',
//    '#title' => t('Connections'),
//	'#weight' => '-2',
//    '#content' => t('Links to the mapmaker details, other sites submitted by user, downloadable Green Maps'),
//  );
if($multimedia) {  
  $form['tabs']['tab4'] = array(
    '#type' => 'tabpage',
    '#title' => t('Multimedia'),
	'#weight' => '0',
    '#content' => $multimedia,
  );
}
//  $form['tabs']['tab5'] = array(
//    '#type' => 'tabpage',
//    '#title' => t('Nearby Sites'),
//	'#weight' => '2',
//    '#content' => t('Links to the mapmaker details, other sites submitted by user, other nearby sites, etc.'),
//  );

  print tabs_render($form);
?>

<?php
  if ($links) {
    print $links;
  }
?>

<pre>
<?php
//	print_r($node); // output all data for theming 
?>
</pre>


</div>