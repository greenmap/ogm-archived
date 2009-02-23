<?php
// $comment_count isn't defined in some of the earliest sites, don't know why.
if ($comment_count == NULL){
	$comment_count = 0;
}


if ($page == 0): ?>
  <h2><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
<?php endif; ?>

<?php
if(node_access('update',$node) == true && $_GET['isSimple']){
	echo "<div id='bubble_full_edit'>". l(t("edit"),'node/'.$node->nid."/edit",array('target' => '_top') )."</div>";
}
?>

<div id="address">
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
		<div class="location postalcode">
			<?php print $location[province] . ' ' . $location[postal_code]; ?>
		</div>
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
</div>


<h2 class="icontitle"><?php print $title; ?></h2>

<div class="taximage">
	<?php print $primary_icon . implode(' ', $secondary_icons); ?>
</div>


  <?php
  // prepare content for MAIN tab
  if($node->field_image[0]['value'] > '') {
    $image = $node->field_image;
    $image['widget']['thumbnail_width'] = '100';

  	$media_thumb = theme('image_ncck_image_thumbnail', $image, $node->field_image[0], 'image_thumbnail', $node);
  } elseif($node->field_video[0]['value'] > '') {
  	$media_thumb = theme('video_cck_video_thumbnail', $node->field_video, $node->field_video[0], 'video_thumbnail', $node);
  }

// RM $siteicons code moved up along with icons display code ////////////
	if($node->field_accessible_by_public_tran[0]['value'] == 1) {
	$siteicons .= '<li>' . '<img src="' . base_path() . path_to_subtheme() . '/images/accessible.png" alt="' . t('accessible') . '" title="' . t('accessible') . '">' . '</li>';
}
if($node->field_child_friendly[0]['value'] == 1) {
	$siteicons .= '<li>' . '<img src="' . base_path() . path_to_subtheme() . '/images/youth.png" alt="' . t('youth friendly') . '" title="' . t('youth friendly') . '">' . '</li>';
}
if($node->field_appointment_needed[0]['value'] == 1) {
	$siteicons .= '<li>' . '<img src="' . base_path() . path_to_subtheme() . '/images/appointment.png" alt="' . t('appointment necessary - call first') . '" title="' . t('appointment necessary - call first') . '">' . '</li>';
}
if($node->field_accessible_by_public_tran[0]['value'] == 1) {
	$siteicons .= '<li>' . '<img src="' . base_path() . path_to_subtheme() . '/images/transport.png" alt="' . t('accessible by public transport') . '" title="' . t('accessible by public transport') . '">' . '</li>';
}
if($node->field_free_entry[0]['value'] == 1) {
	$siteicons .= '<li>' . '<img src="' . base_path() . path_to_subtheme() . '/images/free.png" alt="' . t('free entry') . '" title="' . t('free entry') . '">' . '</li>';
}
if($node->field_involved[0]['value'] == 'yes') {
	$siteicons .= '<li>' . '<img src="' . base_path() . path_to_subtheme() . '/images/insider_icon.gif" alt="' . t('the person who mapped this is involved in this site') . '" title="' . t('the person who mapped this is involved in this site') . '">' . '</li>';
}

  $contents = '<div id="mediathumbs">' . $media_thumb ;

  $contents .= '<div class="fivestar">';//RM relocated here
			$contents .= fivestar_widget_form($node);
		$contents .= '</div>';

  	$contents .= '<div id="siteactions">';
  		$contents .= '<ul>';
  			$contents .= '<li>' . format_plural($comment_count, '1 comment', '@count comments') . '</li>';
  			$contents .= '<li>' . l(t('share this site'), 'forward/' . $node->nid . '/simple') . '</li>';
  			$contents .= '<li>' . l(t('flag this'),'abuse/report/node/' . $node->nid . '/simple') . '</li>';
  		$contents .= '</ul>';
  	$contents .= '</div>';

	 if($siteicons > '') {  // RM - relocated here
		$contents .= '<div class="siteicons">';
			$contents .= '<ul class="links">';
				$contents .= $siteicons;
			$contents .= '</ul>';
		$contents .= '</div>';
	}

  $contents .= '</div>'; // end of media & actions

  $contents .= content_format('field_details', $field_details[0]);

/* // RM moved all this up so as sit in right side ///////
if($node->field_accessible_by_public_tran[0]['value'] == 1) {
	$siteicons .= '<li>' . '<img src="' . base_path() . path_to_subtheme() . '/images/accessible.png" alt="' . t('accessible') . '"  title="' . t('accessible') . '">' . '</li>';
}
if($node->field_child_friendly[0]['value'] == 1) {
	$siteicons .= '<li>' . '<img src="' . base_path() . path_to_subtheme() . '/images/youth.png" alt="' . t('youth friendly') . '" title="' . t('youth friendly') . '">' . '</li>';
}
if($node->field_appointment_needed[0]['value'] == 1) {
	$siteicons .= '<li>' . '<img src="' . base_path() . path_to_subtheme() . '/images/appointment.png" alt="' . t('appointment necessary - call first') . '" title="' . t('appointment necessary - call first') . '">' . '</li>';
}
if($node->field_accessible_by_public_tran[0]['value'] == 1) {
	$siteicons .= '<li>' . '<img src="' . base_path() . path_to_subtheme() . '/images/transport.png" alt="' . t('accessible by public transport') . '" title="' . t('accessible by public transport') . '">' . '</li>';
}
if($node->field_free_entry[0]['value'] == 1) {
	$siteicons .= '<li>' . '<img src="' . base_path() . path_to_subtheme() . '/images/free.png" alt="' . t('free entry') . '" title="' . t('free entry') . '">' . '</li>';
}
if($node->field_involved[0]['value'] == 'yes') {
	$siteicons .= '<li>' . '<img src="' . base_path() . path_to_subtheme() . '/images/insider_icon.gif" alt="' . t('the person who mapped this is involved in this site') . '" title="' . t('the person who mapped this is involved in this site') . '">' . '</li>';
}

	$contents .= '<div id="iconsandstars">';
	if($siteicons > '') {
		$contents .= '<div class="siteicons">';
			$contents .= '<ul class="links">';
				$contents .= $siteicons;
			$contents .= '</ul>';
		$contents .= '</div>';
	}
		$contents .= '<div class="fivestar">';
			$contents .= fivestar_widget_form($node);
		$contents .= '</div>';
	$contents .= '</div>'; // */
  $contents .= '<div class="meta">';
  $imgalt = t('Part of a community map.');
  $contents .= '<img class="map_icon" src="' . base_path() . path_to_theme() . '/images/grey_icon.gif" width="20px" height="19px" alt="'  . $imgalt . '" title="'  . $imgalt . '"/>';
  $contents .= '<div class="submitted_text">';

		if($node->og_groups_both[$node->og_groups[0]] > '') {
	   $contents .= l($node->og_groups_both[$node->og_groups[0]],'node/'.$node->og_groups[0], array('target' =>'_top') );
		}
    if($node->uid){
      $contents .= '<br />'. t('added') . ' ' . date('m/Y', $node->created) .' '. t('by') . ' ' . l($node->name,'user/' . $node->uid) . ' ';
		}
    $contents .= '</div>';
    $img_alt = t('This site was added by an official Mapmaker');
    $contents .= '<img class="submitted_icon" src="' . base_path() . path_to_theme() . '/img/mapper.gif" width="20px" height="19px" alt="'  . $img_alt . '" title="'  . $img_alt . '"/>';

		// debug
		//print_r($node);
		$contents .= '</div><!-- /meta-->';

  // ncm: insert a small map on the site pages when viewed as a node
  // as in search click throughs.
//   if (arg(0) != 'greenmap') {
    $view_name = 'site_mini_map'; //name of view
    $view_args = array();
    $view = views_get_view($view_name);
    $contents .= views_build_view('block', $view, $view_args, FALSE, $view->nodes_per_block);
//   }


	$contents .= '</div>';




  // prepare content for COMMENT tab
  $comments = '<p>' . comment_render($node) . '</p>';


	// prepare content for CONNECTIONS tab
	// get directions
	$connections = output_connections($node);



	// Multimedia tab
	// needs images/{camera,video}.png, multimedia.{css,js}
	$multimedia = '';

	// add custom  JavaScript
	drupal_add_js(drupal_get_path('theme', 'zen').'/opengreenmap/multimedia.js', 'theme', 'footer');
	$media = array();
	// add site video
	if (!empty($node->field_video[0]['view'])) {
		$node->field_video[0]['type'] = 'video';
		$node->field_video[0]['title'] = $node->field_video_caption[0]['view'];
		$node->field_video[0]['author'] = $name;
		$media = array_merge($media, $node->field_video);
	}
	// add contributed videos
	$result = db_query('SELECT a.nid FROM {content_type_video} AS a, {node} AS b WHERE field_site_0_nid = %d AND a.nid = b.nid AND b.status = 1', $node->nid);
	while ($line = db_fetch_object($result)) {
		$medianode = node_load(array('nid' => $line->nid));
		$medianode->field_video_0[0]['type'] = 'video';
		$medianode->field_video_0[0]['title'] = $medianode->title;
		$medianode->field_video_0[0]['description'] = $medianode->body;
		$medianode->field_video_0[0]['nid'] = $medianode->nid;
		$usr = user_load(array('uid' => $medianode->uid));
		$medianode->field_video_0[0]['author'] = theme_username($usr);
		// HACKHACK
		$medianode->field_video_0[0]['view'] = theme('video_cck_video_video', array_merge($medianode->field_video_0, array('widget' => array('video_width' => 320, 'video_height' => 240))), $medianode->field_video_0[0], 'video_video', $medianode);
		$media = array_merge($media, $medianode->field_video_0);
	}
	// add site images
	if (!empty($node->field_image[0]['view'])) {
		$node->field_image[0]['type'] = 'image';
		$node->field_image[0]['title'] = $node->field_image_caption[0]['view'];
		$node->field_image[0]['author'] = $name;
		$media = array_merge($media, $node->field_image);
	}
	// add contributed photos
	$result = db_query('SELECT a.nid FROM {content_type_photo} AS a, {node} AS b WHERE field_site_1_nid = %d AND a.nid = b.nid AND b.status = 1', $node->nid);
	while ($line = db_fetch_object($result)) {
		$medianode = node_load(array('nid' => $line->nid));
		$medianode->field_photo[0]['type'] = 'image';
		$medianode->field_photo[0]['title'] = $medianode->title;
		$medianode->field_photo[0]['description'] = $medianode->body;
		$medianode->field_photo[0]['nid'] = $medianode->nid;
		$usr = user_load(array('uid' => $medianode->uid));
		$medianode->field_photo[0]['author'] = theme_username($usr);
		// HACKHACK
		$medianode->field_photo[0]['view'] = theme('image_ncck_image_full', array_merge($medianode->field_photo, array('widget' => array('full_width' => 320, 'full_height' => 240))), $medianode->field_photo[0], 'image_full', $medianode);
		$media = array_merge($media, $medianode->field_photo);
	}

	$multimedia .= '<div id="multimedia_main">';
		if (empty($media))
			$multimedia .= '<div id="multimedia_main_na">' . t(' Be the first to add a ') . '<a href="'.base_path().'node/add/photo?theme=simple&destination=node/'.$node->nid.'/simple&nid='.$node->nid.'&node_title='.$node->title.'">' . t('photo') . '</a> ' . t('or') . ' <a href="'.base_path().'node/add/video?theme=simple&destination=node/'.$node->nid.'/simple&nid='.$node->nid.'&node_title='.htmlspecialchars($node->title).'">' . t('video') . '</a>' . t( ' about this site! Each image expresses a personal perspective. ') . '</div>';
		else
			// display first video
			$multimedia .= $media[0]['view'];
	$multimedia .= '</div>';



	if (!empty($media)) {
		$multimedia .= '<div id="multimedia_description">';
			$multimedia .= outputMediaDescription($media[0], $name);
		$multimedia .= '</div>';
		// randomize array
		shuffle($media);
		$multimedia .= '<p id="multimedia_selector_title">add <a href="'.base_path().'node/add/photo?theme=simple&destination=node/'.$node->nid.'/simple&nid='.$node->nid.'&node_title='.$node->title.'">photo</a>, <a href="'.base_path().'node/add/video?theme=simple&destination=node/'.$node->nid.'/simple&nid='.$node->nid.'&node_title='.htmlspecialchars($node->title).'">video</a></p>';
		$multimedia .= '<div id="multimedia_selector">';
			// start doing the javascript
			$js = 'var multimedia_main = new Array();';
			$js .= 'var multimedia_description = new Array();';
			$multimedia .= '<ul>';
				for ($i=0; $i<count($media); $i++) {
					// add to the javascript array
					$js .= 'multimedia_main[\'multimedia_item_'.$i.'\'] = \''.str_replace(array("\r\n", "\n", "\r"), '', addslashes($media[$i]['view'])).'\';';
					$js .= 'multimedia_description[\'multimedia_item_'.$i.'\'] = \''.addslashes(outputMediaDescription($media[$i], $name)).'\';';
					// display a custom thumbnail
					if ($media[$i]['type'] == 'video') {
						$multimedia .= '<li class="multimedia_item" id="multimedia_item_'.$i.'"><img src="'.module_invoke('emfield', 'include_invoke', 'video_cck', $media[$i]['provider'], 'thumbnail', $media, $media[$i], 'video_thumbnail', $node, 120, 120).'" width="60"></li>';
					} elseif ($media[$i]['type'] == 'image') {
						$multimedia .= '<li class="multimedia_item" id="multimedia_item_'.$i.'"><img src="'.module_invoke('emfield', 'include_invoke', 'image_ncck', $media[$i]['provider'], 'image_url', $media[$i]['value'], 120, 120, 'thumbnail', $media, $media[$i], $node).'" width="60"></li>';
					} else {
						// DEBUG
						$multimedia .= 'Error: unknown type';
					}
				}
			$multimedia .= '</ul>';
			// output the javascript
			$multimedia .= '<script type="text/javascript">'.$js.'</script>';
		$multimedia .= '</div>';
	}


	// Impacts tab
	$impacts = output_impacts($node);


  // this sets up the tabs for the page

  $form = array();

  $form['tabs'] = array(
    '#type' => 'tabset',
  );
  $form['tabs']['tab1'] = array(
    '#type' => 'tabpage',
    '#title' => t('Overview'),
	'#weight' => '-6',
    '#content' => $contents,
  );
  // theme('comment_wrapper') pulls in comments formatted in template.php, though it doesn't work. comment_render($node) does work but it shows up twice.
  $form['tabs']['tab2'] = array(
    '#type' => 'tabpage',
    '#title' => t('Comments') . ' (' . $comment_count . ')' ,
	'#weight' => '-4',
    '#content' => '<div class="mycomments">'  . $comments . '</div>',
  );
  $form['tabs']['tab3'] = array(
    '#type' => 'tabpage',
    '#title' => t('Connections'),
	'#weight' => '-2',
    '#content' => '<div class="connections">'  . $connections . '</div>',
  );
  $form['tabs']['tab4'] = array(
    '#type' => 'tabpage',
    '#title' => t('Multimedia'),
	'#weight' => '0',
    '#content' => '<div class="multimedia">'  . $multimedia . '</div>',
  );
  $form['tabs']['tab5'] = array(
    '#type' => 'tabpage',
    '#title' => t('Impacts'),
	'#weight' => '2',
    '#content' => '<div class="impacts">'  . $impacts . '</div>',
  );

  print tabs_render($form);
?>



