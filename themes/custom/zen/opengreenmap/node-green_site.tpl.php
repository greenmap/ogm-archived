<?php


/**
 *	This file outputs the site's InfoWindow bubble as HTML.
 *
 *	The matching CSS is atm in modules/custom/gmap_marker/bubble.css. See also gmap_marker.{js,module}.
 */




// get all the icon/taxonomy information
$primary_term_tid = $node->primary_term->tid;
$primary_term_name = $node->primary_term->name;
$primary_icon = taxonomy_image_display($primary_term_tid, "title='$primary_term_name'");

// get genre
$genre_name_lc = '';
$categories = taxonomy_get_parents($primary_term_tid);
foreach ($categories as $category) {
	$genres = taxonomy_get_parents($category->tid);
}

// GH: bandaid for now
if (is_array($genres)) {
	foreach ($genres as $genre) {
		$genre_name_lc = strtolower($genre->name);
		$genre_name_lc = str_replace(' ', '_', $genre_name_lc);
		$genre_name_lc = str_replace('&', '', $genre_name_lc);			// special case for "culture_&_society"
	}
}

// get secondary icons
$secondary_icons = array();
foreach ($node->taxonomy as $key => $val) {
	if ($key != $primary_term_tid) {
		// GH: there might be a more elegant way to get the name (title) here than the hack below
		$secondary_icons[] = taxonomy_image_display($key);
		$secondary_icons[count($secondary_icons)-1] = str_replace('alt="', 'alt="" title="', $secondary_icons[count($secondary_icons)-1]);
	}
}


// GH: not sure if we want to keep this
// TT: we do want this
?>
<div id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?> <?php print $node_classes.' '.$genre_name_lc ?>"> 
<?php


if ($teaser) {


?>
	<div id="bubble_small">

		<!--
		<div id="bubble_small_more">
			<a href="#" onclick="javascript:gotoTab(1);">
				more info &gt;&gt;
			</a>
		</div>
		-->

		<?php
		if(node_access('update',$node) == true){
			echo "<div id='bubble_small_edit'>". l(t("edit"),'node/'.$node->nid."/edit")."</div>";
		}
		?>
		
		<div id="bubble_icons">
			<?php if ($primary_icon) { ?>
				<div id="bubble_icon_primary">
					<?php print $primary_icon; ?>
				</div>
			<?php } ?>
			<?php foreach ($secondary_icons as $si) { ?>
				<?php // GH: change alt to title (HACK, see above) ?>
				<?php $si = str_replace(' alt=', ' alt="" title=', $si); ?>
				<?php print $si; ?>
			<?php } ?>
		</div>

		<div class="bubble_small_title <?php print $genre_name_lc; ?>">
			<a href="#" rel='1' class='maximize'>
				<?php print $title; ?>
			</a>
		</div>

		<div id="bubble_left">
			<div id="bubble_media<?php if (empty($node->field_image[0]['view']) && empty($node->field_video[0]['view'])) print ' bubble_media_missing';?>">
				<a href="#" rel='4' class='maximize'>
					<?php if (!empty($node->field_image[0]['view'])) { ?>
						<?php $img = strip_tags($node->field_image[0]['view'], '<img>'); ?>
						<?php print $img; ?>
					<?php } elseif (!empty($node->field_video[0]['view'])) { ?>
						<?php $video = strip_tags($node->field_video[0]['view'], '<img>'); ?>
						<?php print $video; ?>
					<?php } else {
						// we don't print "Add your photo" for now
					}?>
				</a>
			</div>
		</div>

		<div id="bubble_middle">
			<div id="bubble_small_rating">
				<!-- TODO: remove one star, right way to to customize it -->
				<?php // print fivestar_widget_form($node); ?>
				<?php print fivestar_static($content_type = 'node', $content_id = $node->nid, $node_type = 'green_site'); ?>
			</div>
			<div id="bubble_small_comment">
			
				<img src="<?php print base_path(); ?>files/comments_bubble.gif">
				<!-- TODO: add link -->
				<a href="#" rel='2' class='maximize'>
					<?php if ($node->comment_count == 0) { ?>
						<?php print t('comment'); ?>
					<?php } else { ?>
						<?php print $node->comment_count.' '.t('comments'); ?>
					<?php } ?>
				</a>
				 <?php
				 $contents .= '<br><span class="submitted">';
		$contents .= '<img src="' . base_path() . path_to_theme() . '/img/mapper.gif" width="20px" height="19px" alt="' . t('added') . date('m/Y', $node->created) . t('by') . $node->name . '"/>';
		$contents .= t('added') . ' ' . date('m/Y', $node->created) . ' ' ;
		if($node->uid){
			$contents .= t('by') . ' ' . l($node->name,'user/' . $node->uid) . ' ';
		}
		if($node->og_groups_both[$node->og_groups[0]] > '') {
			$contents .= t('to') . ' ' . l($node->og_groups_both[$node->og_groups[0]],'node/'.$node->og_groups[0], array('target' =>'_top') );
		}
		// debug
		//print_r($node);
		$contents .= '</span>';
		print $contents;
		?>
			</div>
		</div>

		<div id="bubble_right">
			<div id="bubble_small_address">
				<?php if ($location['name'] != '') { ?>
					<p><?php print $location['name']; ?></p>
				<?php } ?>
				<?php if ($location['street'] != '') { ?>
					<p><?php print $location['street']; ?></p>
				<?php } ?>
				<?php if ($location['additional'] != '') { ?>
					<p><?php print $location['additional']; ?></p>
				<?php } ?>
				<?php if ($location['city'] != '') { ?>
					<p><?php print $location['city']; ?></p>
				<?php } ?>
				<?php if ($field_phone[0]['value'] != '') { ?>
					<p><?php print $field_phone[0]['value']; ?></p>
				<?php } ?>
			</div>
		</div>


		<?php $flag = _abuse_get_status('node', $node->nid); ?>
		<?php if ($flag == 'Pending' || $flag == 'Hidden') { ?>
			<div id="bubble_small_flagged">
				<strong>Flagged Site.</strong> Please view with caution!
			</div>
		<?php } ?>
		
	</div>
<?php


} else {
	// fetch the maximized bubble from an external file (for now)
	include('green_site-full.tpl.php');
}


?>
</div>

