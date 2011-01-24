<!--node-green_site.tpl.php-->
<?php


/**
 *  This file outputs the site's InfoWindow bubble as HTML.
 *
 *  The matching CSS is atm in modules/custom/gmap_marker/bubble.css. See also gmap_marker.{js,module}.
 */

// get all the icon/taxonomy information
$primary_term_tid = $node->primary_term->tid;
$primary_icon = taxonomy_image_display($primary_term_tid);
$primary_term_name = preg_match('/ alt="([^"]*)" /i', $primary_icon, $matches)
  ? $matches[1] : htmlspecialchars(strip_tags($node->primary_term->name), ENT_COMPAT);
$primary_icon = str_replace('title="', 'title="'. $primary_term_name .': ', $primary_icon);

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
    $genre_name_lc = str_replace('&', '', $genre_name_lc);      // special case for "culture_&_society"
  }
}

// get secondary icons
$secondary_icons = '';
foreach ($node->taxonomy as $tid => $tax) {
  if ($tid != $primary_term_tid) {
    // GH: there might be a more elegant way to get the name (title) here than the hack below
    $secondary_icon = taxonomy_image_display($tid);
    $secondary_term_name = preg_match('/ alt="([^"]*)" /i', $secondary_icon, $matches)
      ? $matches[1] : htmlspecialchars(strip_tags($tax->name), ENT_COMPAT);
    $secondary_icons .= str_replace('title="', 'title="'. $secondary_term_name .': ', $secondary_icon);
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
    <div class="maximize-link">
      <a href="javascript:void(0)" onclick="javascript:GlobalMap.getInfoWindow().maximize()"><?php print t('more info'); ?></a>
    </div>
    <!--
    <div id="bubble_small_more">
      <a href="#" onclick="javascript:gotoTab(1);">
        more info &gt;&gt;
      </a>
    </div>
    -->

    <?php
    if(node_access('update',$node) == true){
      echo '<div id="bubble_small_edit"><a href="'. url('node/'.$node->nid."/edit") .'" target="_parent">'.t('edit').'</a></div>';
    }
    ?>

    <div id="bubble_icons">
      <?php if ($primary_icon) : ?>
        <div id="bubble_icon_primary">
          <?php print $primary_icon; ?>
        </div>
      <?php endif; ?>
      <?php if ($secondary_icons): ?>
        <?php print $secondary_icons; ?>
      <?php endif; ?>
    </div>

    <div class="bubble_small_title <?php print $genre_name_lc; ?>">
<!--       <a href="#" rel='1' class='maximize'> -->
      <a href="javascript:void(0)" onclick="javascript:GlobalMap.getInfoWindow().maximize()">
        <?php print $title; ?>
      </a>
    </div>

    <div id="bubble_left">
          <?php 
            $image_to_show = NULL;
            if ( $node->field_image_local[0]['view'] ) {
              $image_to_show = theme('imagefield_image', $node->field_image_local[0], '', '', array(width => 60, height => 80), FALSE);
            } else if ( $node->field_image[0]['view'] ) {
              $image_to_show = strip_tags($node->field_image[0]['view'], '<img>'); 
            } 
            // this doesn't work, so I'm disabling it:    --mjgoins
              //else if ( $node->field_video[0]['view'] ) {
              //$image_to_show = strip_tags($node->field_video[0]['view'], '<img>'); 
              //}
             else {
               $photos_sql = 'SELECT n.nid
                              FROM {content_type_photo} ctp
                                INNER JOIN {node} n
                                  ON n.vid = ctp.vid
                                LEFT JOIN {content_field_awaiting_approval} cfaa
                                  ON ctp.vid = cfaa.vid
                              WHERE ctp.field_site_1_nid = %d
                                AND cfaa.field_awaiting_approval_value IS NULL
                                AND n.status = 1';
               $result = db_query($photos_sql, $node->nid);
               if ( $result ) {
                 $line = db_fetch_object($result);
                 $medianode = node_load(array('nid' => $line->nid));
                 if ( $medianode->field_image_local[0]['filename'] ) {
                   $image_to_show = theme('imagefield_image', $medianode->field_image_local[0], '', '', array('width' => 80), FALSE);
                 }
               }
             }
          ?>
      <div id="bubble_media<?php if ( ! $image_to_show ) print ' bubble_media_missing';?>">
        <a href="javascript:void(0)" onclick="javascript:GlobalMap.getInfoWindow().maximize()" class="maximize" rel="4">
          <?php 
            if ( $image_to_show ) {
              print $image_to_show;
            }
          ?>
        </a>
      </div>
    </div>

    <div id="bubble_middle">
      <div id="bubble_small_rating">
        <?php print fivestar_static('node', $node->nid,'vote', $node->type); ?>
      </div>
      <div id="bubble_small_comment">

        <img src="<?php print base_path().path_to_theme().'/images/comments_bubble.gif' ?>" alt="(comments)" />
        <!-- TODO: add link -->
        <a href="javascript:void(0)" onclick="javascript:GlobalMap.getInfoWindow().maximize()" class="maximize" rel="2">
          <?php if ($comment_count == 0) { ?>
            <?php print t('Add first comment'); ?>
          <?php } else { ?>
            <?php print format_plural($comment_count, '1 comment', '@count comments'); ?>
          <?php } ?>
        </a>
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
          <p><?php print check_plain($field_phone[0]['value']); ?></p>
        <?php } ?>
      </div>
    </div>
  <?php
  $contents .= '<div class="meta meta-bubble">';
  $imgalt = t('Part of a community map.');
  $contents .= '<img class="map_icon" src="' . base_path() . path_to_theme() . '/images/grey_icon.gif" width="20px" height="19px" alt="'  . $imgalt . '" title="'  . $imgalt . '"/>';
  $contents .= '<div class="submitted_text">';
    if(count($node->og_groups_both) > 0) {
      list($group_nid) = array_keys($node->og_groups_both);
      $group_title = $node->og_groups_both[$group_nid];
      $contents .= l($group_title, 'node/'. $group_nid,
                    array(
                      'query' => array('autoBubbleNID' => $node->nid),
                      'attributes' => array(
                        'target' => '_top',
                        'title' => t('View this Open Green Map'))));
    }
    if($node->uid){
      $contents .= '<br />'. t('added @date by <a href="@profile_link" title="View Profile">@name</a>',
          array('@date' => date('m/Y', $node->created), '@profile_link' => url('user/'. $node->uid), '@name' => $node->name));
    }
    $contents .= '</div>';
    $img_alt = t('This site was added by an official Mapmaker');
    $contents .= '<img class="submitted_icon" src="' . base_path() . path_to_theme() . '/img/mapper.gif" width="20px" height="19px" alt="'  . $img_alt . '" title="'  . $img_alt . '"/>';

     $countents .= '</div><!-- /meta-->';
    print $contents;?>

  </div>
<?php
} else {
  print '<div id="green_site_full">';
  // fetch the maximized bubble from an external file (for now)
  include('green_site-full.tpl.php');
  print '</div>';
}
?>
</div>
<!--/node-green_site.tpl.php-->
