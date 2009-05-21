<?php

//echo "baaab2|<br>";
//echo base_path() ."<br>";
//echo $_SERVER['REQUEST_URI']."<br>";
//echo strrpos($_SERVER['REQUEST_URI'],base_path())."<br>";

//phpinfo();
// $comment_count isn't defined in some of the earliest sites, don't know why.
if ($comment_count == NULL){
	$comment_count = 0;
}


if ($page == 0): ?>
  <h2><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
<?php endif; ?>

<?php
//echo $_SESSION['parentPage'];
echo l(t('Back'),$_SESSION['parentPage'],array('target' => '_top') );
?>

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
	
	$contents .= '<div class="meta">';
  $img_alt = t('This site was added by an official Mapmaker');
  $contents .= '<img class="submitted_icon" src="' . base_path() . path_to_theme() . '/img/mapper.gif" width="20px" height="19px" alt="'  . $img_alt . '" title="'  . $img_alt . '"/>';

      
  $contents .= '<div class="submitted_text">';
		$contents .= t('added') . ' ' . date('m/Y', $node->created) . ' ' ;
		if($node->og_groups_both[$node->og_groups[0]] > '') {
			$contents .= t('to') . ' ' . l($node->og_groups_both[$node->og_groups[0]],'node/'.$node->og_groups[0], array('target' =>'_top') );
		}
    if($node->uid){
			$contents .= '<br />' . t('by') . ' ' . l($node->name,'user/' . $node->uid) . ' ';
		}
		
		// debug
		//print_r($node);
		$contents .= '</div>';
 
	$contents .= '</div>';

echo $contents;
  // this sets up the tabs for the page
/*
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
  */
?>