<!--node-green_site.tpl.php-->
<?php


/**
 *  This file outputs the site's InfoWindow bubble as HTML.
 *
 *  The matching CSS is atm in modules/custom/gmap_marker/bubble.css. See also gmap_marker.{js,module}.
 */

function getMultiMedia($node) {
  // Multimedia tab
  // needs images/{camera,video}.png, multimedia.{css,js}
  $multimedia = '';

  // add custom  JavaScript
  drupal_add_js(drupal_get_path('theme', 'opengreenmap').'/multimedia.js', 'theme', 'footer');
  $media = array();
  // add site video
  if (!empty($node->field_video[0]['view']) && !empty($node->field_video[0]['provider'])) {
    // unfortunately, it's impossible to check if these have been deleted from
    // the provider
    $node->field_video[0]['type'] = 'video';
    $node->field_video[0]['title'] = $node->field_video_caption[0]['view'];
    $node->field_video[0]['author'] = $name;
    if (user_access('edit any green_site content')) {
      $node->field_video[0]['description'] .=
        sprintf('<div>[<a href="/node/%d/edit?destination=node%%2F%d" target="_blank">edit</a>]</div>',
            $node->nid, $node->nid);
    }
    $tmp = $node->field_video;
    $tmp[0]['view'] = str_replace('<a href="', '<a target="_blank" href="', $tmp[0]['view']);
    $media = array_merge($media, $tmp);
  }
  // add contributed videos
  $result = db_query('SELECT a.nid FROM {content_type_video} AS a, {node} AS b WHERE field_site_0_nid = %d AND a.nid = b.nid AND b.status = 1', $node->nid);
  while ($line = db_fetch_object($result)) {
    $medianode = node_load(array('nid' => $line->nid));
    if (!node_access('view', $medianode)) {
      continue;
    }
    // make sure this is a valid image
    if (!$medianode->field_video_0[0]['provider']) {
      continue;
    }
    // unfortunately, it's impossible to check if these have been deleted from
    // the provider
    $medianode->field_video_0[0]['type'] = 'video';
    $medianode->field_video_0[0]['title'] = $medianode->title;
    $medianode->field_video_0[0]['description'] = $medianode->body;
    if (user_access('edit any video content')) {
      $medianode->field_video_0[0]['description'] .=
        sprintf('<div>[<a href="/node/%d/edit?destination=node%%2F%d" target="_blank">edit</a>]</div>',
            $medianode->nid, $node->nid);
    }
    $medianode->field_video_0[0]['nid'] = $medianode->nid;
    $usr = user_load(array('uid' => $medianode->uid));
    $medianode->field_video_0[0]['author'] = theme_username($usr);
    // HACKHACK
    $medianode->field_video_0[0]['view'] = theme('emvideo_video_video', array_merge($medianode->field_video_0, array('widget' => array('video_width' => 200, 'video_height' => 150))), $medianode->field_video_0[0], 'video_video', $medianode);
    $medianode->field_video_0[0]['view'] = str_replace('<a href="', '<a target="_blank" href="', $medianode->field_video_0[0]['view']);
    $media = array_merge($media, $medianode->field_video_0);
  }
  // add site images
  if (!empty($node->field_image[0]['view']) && !empty($node->field_image[0]['provider'])) {
    // don't add deleted flickr or picasa images
    if (! ( ($node->field_image[0]['provider'] == 'flickr'
            && !$node->field_image[0]['data']['owner']) ||
            ($node->field_image[0]['provider'] == 'picasa'
             && !$node->field_image[0]['data']['original']))) {
      $node->field_image[0]['type'] = 'image';
      $node->field_image[0]['title'] = $node->field_image_caption[0]['view'];
      $node->field_image[0]['author'] = $name;
      if (user_access('edit any green_site content')) {
        $node->field_image[0]['description'] .=
          sprintf('<div>[<a href="/node/%d/edit?destination=node%%2F%d" target="_blank">edit</a>]</div>',
              $node->nid, $node->nid);
      }
      $tmp = $node->field_image;
      $tmp[0]['view'] = str_replace('<a href="', '<a target="_blank" href="', $tmp[0]['view']);
      $media = array_merge($media, $tmp);
    }
  }
  // add user-uploaded photos
  if ( $node->field_image_local[0]['view'] ) {
    $user_uploaded_images = array();
    foreach ( $node->field_image_local as $field_image_local ) {
      $usr = user_load(array('uid' => $field_image_local['uid']));
      $field_image_local['author'] = theme_username($usr);
      $field_image_local['title'] =
        $field_image_local['data']['description'] ?
          $field_image_local['data']['description'] :
          $node->title;
      $user_uploaded_images[] = $field_image_local;
    }
    $media = array_merge($media, $user_uploaded_images);
  }
  // add contributed photos
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
  while ($line = db_fetch_object($result)) {
    $medianode = node_load(array('nid' => $line->nid));
    if (!node_access('view', $medianode)) {
      continue;
    }
    if ( $medianode->field_image_local[0]['filename'] ) {
      $medianode->field_image_local[0]['type'] = 'image_local';
      $medianode->field_image_local[0]['title'] = $medianode->title;
      $medianode->field_image_local[0]['view'] = theme('imagefield_image', $medianode->field_image_local[0], '', '', array('width' => 300), FALSE);
      $medianode->field_image_local[0]['view'] = str_replace('<a href=', '<a target="_blank" href=', $medianode->field_image_local[0]['view']);
      $usr = user_load(array('uid' => $medianode->uid));
      $medianode->field_image_local[0]['author'] = theme_username($usr);
      $media = array_merge($media, $medianode->field_image_local);
    } else {
      // make sure this is a valid image
      if (!$medianode->field_photo[0]['provider']) {
        continue;
      }
      // don't add deleted flickr or picasa images
      if ($medianode->field_photo[0]['provider'] == 'flickr'
          && !$medianode->field_photo[0]['data']['owner']) {
        continue;
      }
      if ($medianode->field_photo[0]['provider'] == 'picasa'
          && !$medianode->field_photo[0]['data']['original']) {
        continue;
      }
      $medianode->field_photo[0]['type'] = 'image';
      $medianode->field_photo[0]['title'] = $medianode->title;
      $medianode->field_photo[0]['description'] = $medianode->body;
      if (user_access('edit any photo content')) {
        $medianode->field_photo[0]['description'] .=
          sprintf('<div>[<a href="/node/%d/edit?destination=node%%2F%d" target="_blank">edit</a>]</div>',
              $medianode->nid, $node->nid);
      }
      $medianode->field_photo[0]['nid'] = $medianode->nid;
      $usr = user_load(array('uid' => $medianode->uid));
      $medianode->field_photo[0]['author'] = theme_username($usr);
      // HACKHACK
      $medianode->field_photo[0]['view'] = theme('emimage_image_full', array_merge($medianode->field_photo, array('widget' => array('full_width' => 320, 'full_height' => 0))), $medianode->field_photo[0], 'image_full', $medianode);
      $medianode->field_photo[0]['view'] = str_replace('<a href=', '<a target="_blank" href=', $medianode->field_photo[0]['view']);
      $media = array_merge($media, $medianode->field_photo);
    }
  }
  // add contributed documents
  $result = db_query('SELECT a.nid FROM {content_type_document} AS a, {node} AS b WHERE field_site_2_nid = %d AND a.nid = b.nid AND b.status = 1', $node->nid);
  while ($line = db_fetch_object($result)) {
    // TODO check if these have been deleted from slideshare
    $medianode = node_load(array('nid' => $line->nid));
    $medianode->field_document[0]['type'] = 'document';
    $medianode->field_document[0]['title'] = $medianode->title;
    $medianode->field_document[0]['description'] = $medianode->body;
    if (user_access('edit any document content')) {
      $medianode->field_photo[0]['description'] .=
        sprintf('<div>[<a href="/node/%d/edit?destination=node%%2F%d" target="_blank">edit</a>]</div>',
            $medianode->nid, $node->nid);
    }
    $medianode->field_document[0]['nid'] = $medianode->nid;
    $usr = user_load(array('uid' => $medianode->uid));
    $medianode->field_document[0]['author'] = theme_username($usr);
    // HACKHACK
    $embed_code = $medianode->field_document[0]['data']['EMBED'][0];
    if (!$embed_code) {
      continue;
    }

    $embed_code = str_replace('<a href=', '<a target="_blank" href=', $embed_code);
    $embed_code = preg_replace('@width:\d+px@', 'width:320px', $embed_code);
    $embed_code = preg_replace('@width="\d+"@', 'width="320"', $embed_code);
    $embed_code = preg_replace('@height="\d+"@', 'height="342"', $embed_code);
    $embed_code = preg_replace('@<div[^>]*>View more.*?</div>@', '', $embed_code);
    $medianode->field_document[0]['view'] = $embed_code;
    $medianode->field_document[0]['view'] = str_replace('<a href="', '<a target="_blank" href="', $medianode->field_document[0]['view']);
    $medianode->field_document[0]['thumb'] = $medianode->field_document[0]['data']['THUMBNAILSMALLURL'][0];
    $media = array_merge($media, $medianode->field_document);
  }

  $multimedia .= '<div id="multimedia_main">';
  if (empty($media)) {
    $multimedia .= '<div id="multimedia_main_na">';
    if (user_access('create video content') && user_access('create document content') && user_access('create photo content')) {
      $gid = reset($node->og_groups);
      $multimedia .= t('Be the first to add a <a target="_parent" href="@photo_link">photo</a>, <a target="_parent" href="@video_link">video</a>, or <a target="_parent" href="@document_link">PDF</a> about this site! Each expresses a personal perspective.',
          array(
            '@photo_link' => base_path().'node/add/photo?destination=node/'.$node->nid.'&nid='.$node->nid.'&node_title='.htmlspecialchars($node->title) .'&suggest='. $gid,
            '@video_link' => base_path().'node/add/video?destination=node/'.$node->nid.'&nid='.$node->nid.'&node_title='.htmlspecialchars($node->title),
            '@document_link' => base_path().'node/add/document?destination=node/'.$node->nid.'&nid='.$node->nid.'&node_title='.htmlspecialchars($node->title),
            ));
    }
    else {
      $multimedia .= t('Registered users can post photos, videos, and documents here.');
    }
    $multimedia .= '</div>';
  }
  else {
    $multimedia .= '<div id="media_slideshow">';
    $multimedia .= '<ul class="bjqs">';
    foreach ($media as $item) {
        $multimedia .= '<li class="slideshow_element">';
        $multimedia .= $item['view'];
        $multimedia .= multimedia_content_media_description($item, $name);
        $multimedia .= '</li>';
    }
    $multimedia .= '</ul>';
    $multimedia .= '</div>';
    // randomize array
    //$first_media_item = array_shift($media);
    //shuffle($media);
    //array_unshift($media, $first_media_item);
    // display first multimedia object
    //$multimedia .= $media[0]['view'];
  }

  if (!empty($media)) {
    /*$multimedia .= '<div id="multimedia_selector">';
      // start doing the javascript
      $js = 'var multimedia_main = new Array();';
      $js .= 'var multimedia_description = new Array();';
      $multimedia .= '<ul class="">';
        for ($i=0; $i<count($media); $i++) {
          // add to the javascript array
          $js .= 'multimedia_main[\'multimedia_item_'.$i.'\'] = \''.str_replace(array("\r\n", "\n", "\r"), '', addslashes($media[$i]['view'])).'\';';
          $js .= 'multimedia_description[\'multimedia_item_'.$i.'\'] = \''.str_replace(array("\r\n", "\n", "\r"), '', addslashes(multimedia_content_media_description($media[$i], $name))).'\';';
          // display a custom thumbnail
          if ($media[$i]['type'] == 'video') {
            $multimedia .= '<li class="multimedia_item" id="multimedia_item_'.$i.'"><img src="'.module_invoke('emfield', 'include_invoke', 'emvideo', $media[$i]['provider'], 'thumbnail', $media, $media[$i], 'video_thumbnail', $node, 120, 120).'" width="60"></li>';
          } elseif ($media[$i]['type'] == 'image') {
            $multimedia .= '<li class="multimedia_item" id="multimedia_item_'.$i.'"><img src="'.module_invoke('emfield', 'include_invoke', 'emimage', $media[$i]['provider'], 'image_url', $media[$i]['value'], 120, 120, 'thumbnail', $media, $media[$i], $node).'" width="60"></li>';
          } elseif ($media[$i]['type'] == 'document') {
            //<li class="multimedia_item" id="multimedia_item_1"><img src="http://img.youtube.com/vi/Mv0KCD8zxls/0.jpg" width="60"></li>
            $multimedia .= '<li class="multimedia_item" id="multimedia_item_'.$i.'"><img src="'. $media[$i]['thumb'] .'" width="60"></li>';
          } else if ( $media[$i]['filepath'] ) { // <---- FIXME, not specific enough, but does that matter? --mjgoins
            if ( file_exists($media[$i]['filepath']) ) { 
              $multimedia .= '<li class="multimedia_item" id="multimedia_item_'.$i.'"><img src="/'. $media[$i]['filepath'] .'" width="60"></li>';
            }
          } else {
            // FIXME: Deal with this error somehow
          }
        }
      $multimedia .= '</ul>';
      // output the javascript
      $multimedia .= '<script type="text/javascript">'.$js.'</script>';
    $multimedia .= '</div>';*/
    if (user_access('create video content') && user_access('create document content') && user_access('create photo content')) {
      $gid = reset($node->og_groups);
      $multimedia .= '<p id="multimedia_selector_title">';
      $multimedia .= t('add <a target="_parent" href="@photo_link">photo</a>, <a target="_parent" href="@video_link">video</a>, <a target="_parent" href="@document_link">PDF</a>',
          array(
            '@photo_link' => base_path().'node/add/photo?destination=node/'.$node->nid.'&nid='.$node->nid.'&node_title='.htmlspecialchars($node->title) .'&suggest='. $gid,
            '@video_link' => base_path().'node/add/video?destination=node/'.$node->nid.'&nid='.$node->nid.'&node_title='.htmlspecialchars($node->title),
            '@document_link' => base_path().'node/add/document?destination=node/'.$node->nid.'&nid='.$node->nid.'&node_title='.htmlspecialchars($node->title),
            )).
          '</p>';
    }
  }
  $multimedia .= '</div>';
  return $multimedia;

}

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
// HGP: wat
// JD: The above is a lie! it throws a null pointer exception.

?>
<div id="node-<?php print $node->nid; ?>" class="node <?php if ($teaser) { print 'green_site_popup'; } ?><?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?> <?php print $node_classes.' '.$genre_name_lc ?>">
<?php
if ($teaser) {
?>

<!--
  <div id="bubble_small">
    <div class="maximize-link">
      <a href="javascript:void(0)" onclick="javascript:GlobalMap.getInfoWindow().maximize()"><?php print t('more info'); ?></a>
    </div>
-->

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
    <div class="top_right">
        <?php if ($location['street'] != '') { ?>
          <div class="street_address"><?php print $location['street']; ?></div>
        <?php if ($field_phone[0] > '') {
          echo '<div class="fieldphone">'. content_format('field_phone', $field_phone[0]) .'</div>';
        }
        if ($field_email[0]['email'] > '') {
          echo '<div class="fieldemail"><a href="mailto:'. $field_email[0]['safe'] . '">Contact</a></div>';
        }
        if ($field_web[0]['url'] > '') {
          $link = '<a target="_blank" href="' . $field_web[0]['display_url'] . '">Website</a>';
          echo '<div class="fieldweb">'. $link .'</div>';
        }?>
        <?php } ?>
    </div>
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
      <a href="<?php echo base_path().'en/node/'.$node->nid . '/simple' ?>">
        <?php print $title; ?>
      </a>
    </div>

  <?php
   print getMultimedia($node);
   ?><div class="left-pane"><?php

   ?><div class="left-pane-scroll"><?php
   $description = '<div class="description">' . content_format('field_details', $field_details[0], 'default', $node) . '</div>';
   print $description;
   $site_descriptors = '<ul class="site_descriptors">';
   // RM $site_descriptors code moved up along with icons display code ////////////
    if($node->field_accessible_by_public_tran[0]['value'] == 1) {
      $site_descriptors .= ' <li class="accessible">' . t('Wheelchair Accessible') . '</li> ';
    }
    if($node->field_child_friendly[0]['value'] == 1) {
      $site_descriptors .= ' <li class="youth_friendly">' . t('Youth Friendly') . '</li> ';
    }
    if($node->field_accessible_by_public_tran[0]['value'] == 1) {
      $site_descriptors .= ' <li class="public_transportation">' . t('Near Public Transit') . '</li> ';
    }
    if($node->field_free_entry[0]['value'] == 1) {
      $site_descriptors .= ' <li class="free">' . t('Free') . '</li> ';
    }
    $site_descriptors .= "</ul>";

    print $site_descriptors;

    ?>
    <div id="bubble_middle">
        <div class="bubble_rating_label">Rating:</div   float: left;> 
        <?php print fivestar_widget_form($node); drupal_add_js("Drupal.behaviors.fivestar()", "inline");?>
    </div>
    <?php
   $comments = '<div class="bubble_comments">' . comment_render($node) . '</div>'; 
   print $comments;
   ?>
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
      $contents .= '<br />'. t('updated @date by <a href="@profile_link" title="View Profile">@name</a>',
          array('@date' => date('m/Y', $node->changed), '@profile_link' => url('user/'. $node->uid), '@name' => $node->name));
    }
    $contents .= '</div>';
    $img_alt = t('This site was added by an official Mapmaker');
    $contents .= '<img class="submitted_icon" src="' . base_path() . path_to_theme() . '/img/mapper.gif" width="20px" height="19px" alt="'  . $img_alt . '" title="'  . $img_alt . '"/>';

     $countents .= '</div><!-- /meta-->';
    print $contents;?>
  </div>
  </div>
  <div class="related-content">
    <a href="<?php echo base_path().'en/node/'.$node->nid . '/simple#tabset-tab-3' ?>">
        <?php print t('Explore related content'); ?>
      </a></div>
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
