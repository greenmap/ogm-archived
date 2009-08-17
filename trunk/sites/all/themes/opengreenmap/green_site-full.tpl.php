<!--green_site-full.tpl.php-->
<?php

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
</div>


<h2 class="icontitle"><?php print $title; ?></h2>

<div class="taximage">
  <?php print $primary_icon .  $secondary_icons; ?>
</div>

<?php
// prepare content for MAIN tab
if($node->field_image[0]['value'] > '') {
  $image = $node->field_image;
  $image['widget']['thumbnail_width'] = '100';

  $media_thumb = theme('emimage_image_thumbnail', $image, $node->field_image[0], 'image_thumbnail', $node);
} elseif($node->field_video[0]['value'] > '') {
  $media_thumb = theme('emvideo_video_thumbnail', $node->field_video, $node->field_video[0], 'video_thumbnail', $node);
}

// RM $siteicons code moved up along with icons display code ////////////
if($node->field_accessible_by_public_tran[0]['value'] == 1) {
  $siteicons .= '<li>' . '<img src="' . base_path() . path_to_theme() . '/images/accessible.png" alt="' . t('accessible') . '" title="' . t('accessible') . '">' . '</li>';
}
if($node->field_child_friendly[0]['value'] == 1) {
  $siteicons .= '<li>' . '<img src="' . base_path() . path_to_theme() . '/images/youth.png" alt="' . t('youth friendly') . '" title="' . t('youth friendly') . '">' . '</li>';
}
if($node->field_appointment_needed[0]['value'] == 1) {
  $siteicons .= '<li>' . '<img src="' . base_path() . path_to_theme() . '/images/appointment.png" alt="' . t('appointment necessary - call first') . '" title="' . t('appointment necessary - call first') . '">' . '</li>';
}
if($node->field_accessible_by_public_tran[0]['value'] == 1) {
  $siteicons .= '<li>' . '<img src="' . base_path() . path_to_theme() . '/images/transport.png" alt="' . t('accessible by public transport') . '" title="' . t('accessible by public transport') . '">' . '</li>';
}
if($node->field_free_entry[0]['value'] == 1) {
  $siteicons .= '<li>' . '<img src="' . base_path() . path_to_theme() . '/images/free.png" alt="' . t('free entry') . '" title="' . t('free entry') . '">' . '</li>';
}
if($node->field_involved[0]['value'] == 'yes') {
  $siteicons .= '<li>' . '<img src="' . base_path() . path_to_theme() . '/images/insider_icon.gif" alt="' . t('the person who mapped this is involved in this site') . '" title="' . t('the person who mapped this is involved in this site') . '">' . '</li>';
}

$contents = '<div id="mediathumbs">' . $media_thumb ;

  $contents .= '<div class="fivestar">';//RM relocated here
      $contents .= fivestar_widget_form($node);
    $contents .= '</div>';

    $contents .= '<div id="siteactions">';
      $contents .= '<ul>';
        $contents .= '<li>' . format_plural($comment_count, '1 comment', '@count comments') . '</li>';
        $contents .= '<li>' . l(t('share this site'), 'forward/' . $node->nid . '/simple') . '</li>';
        $contents .= '<li>' . flag_create_link('report_green_site', $node->nid);
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

    if ($field_phone[0] > '') {
      $contents .= '<div class="fieldphone">'. content_format('field_phone', $field_phone[0]) .'</div>';
    }
    if ($field_email[0] > '') {
      $contents .= '<div class="fieldemail">'. content_format('field_email', $field_email[0]) .'</div>';
    }
    if ($field_web[0] > '') {
      $link = str_replace('<a href=', '<a target="_parent" href=', content_format('field_web', $field_web[0]));
      $contents .= '<div class="fieldweb">'. $link .'</div>';
    }


  $contents .= '<div class="meta">';
  $imgalt = t('Part of a community map.');
  $contents .= '<img class="map_icon" src="' . base_path() . path_to_theme() . '/images/grey_icon.gif" width="20px" height="19px" alt="'  . $imgalt . '" title="'  . $imgalt . '"/>';
  $contents .= '<div class="submitted_text">';

  if(count($node->og_groups_both) > 0) {
    list($group_nid) = array_keys($node->og_groups_both);
    $group_title = $node->og_groups_both[$group_nid];
    $contents .= l($group_title, 'node/'.$group_nid, array('target' =>'_top', 'title' => t('View this Open Green Map')));
  }
  if($node->uid){
    $contents .= '<br />'. t('added @date by <a href="@profile_link" title="View Profile">@name</a>',
    array('@date' => date('m/Y', $node->created), '@profile_link' => url('user/'. $node->uid), '@name' => $node->name));
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
  $contents .= views_embed_view('site_mini_map');
//   }

  $contents .= '</div>';

  // prepare content for COMMENT tab
  $comments = '<p>' . comment_render($node) . '</p>';
  if (arg(0) == 'node' && is_numeric(arg(1)) && arg(2) == 'simple') {
    $comments = preg_replace('@<a href="/user[^>]*>(.*?)</a>@s', '$1', $comments);
    $comments = preg_replace('@<div class="links">.*?</div>@s', '', $comments);
    $comments_redirect = '<input name="destination" type="hidden" value="node/'.arg(1).'/simple" />';
    $comments = str_replace('<input type="submit"', $comments_redirect.'<input type="submit"', $comments);
  }

  // prepare content for CONNECTIONS tab
  // get directions
  $connections = connections_output_connections($node);

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
    $media = array_merge($media, $node->field_video);
  }
  // add contributed videos
  $result = db_query('SELECT a.nid FROM {content_type_video} AS a, {node} AS b WHERE field_site_0_nid = %d AND a.nid = b.nid AND b.status = 1', $node->nid);
  while ($line = db_fetch_object($result)) {
    $medianode = node_load(array('nid' => $line->nid));
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
    $medianode->field_video_0[0]['view'] = theme('emvideo_video_video', array_merge($medianode->field_video_0, array('widget' => array('video_width' => 320, 'video_height' => 240))), $medianode->field_video_0[0], 'video_video', $medianode);
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
      $media = array_merge($media, $node->field_image);
    }
  }
  // add contributed photos
  $result = db_query('SELECT a.nid FROM {content_type_photo} AS a, {node} AS b WHERE field_site_1_nid = %d AND a.nid = b.nid AND b.status = 1', $node->nid);
  while ($line = db_fetch_object($result)) {
    $medianode = node_load(array('nid' => $line->nid));
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
    $medianode->field_photo[0]['view'] = theme('emimage_image_full', array_merge($medianode->field_photo, array('widget' => array('full_width' => 320, 'full_height' => 240))), $medianode->field_photo[0], 'image_full', $medianode);
    $medianode->field_photo[0]['view'] = str_replace('<a href=', '<a target="_blank" href=', $medianode->field_photo[0]['view']);
    $media = array_merge($media, $medianode->field_photo);
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

    /*
    the slideshare api doesn't provide much control, in particular the
    document height, width, and thumbnail sizes are fixed.  currently (02 june
    2009) the API returns a flash object 477 pixels wide and 510 pixels high,
    plus two JPEG thumbnails (170x220 and 120x155).
    to make this fit in the infowindow, we change the size of the returned
    object and drop the link to other documents by this slideshare user.
    (we retain the title link above the document so users can go directly to
    slideshare.net if desired.)
    for reference, sample embed code from the API is shown here (with newlines
    added):

    <div style="width:477px;text-align:left" id="__ss_1523145">
      <a style="font:14px Helvetica,Arial,Sans-serif;display:block;margin:12px 0 3px 0;text-decoration:underline;" href="http://www.slideshare.net/matt_openflows/lorem-ipsum-title?type=document" title="Lorem Ipsum title">Lorem Ipsum title</a>
      <object style="margin:0px" width="477" height="510">
        <param name="movie" value="http://static.slidesharecdn.com/swf/ssplayerd.swf?doc=loremipsum-090602133056-phpapp02&stripped_title=lorem-ipsum-title" />
        <param name="allowFullScreen" value="true" />
        <param name="allowScriptAccess" value="always" />
        <embed src="http://static.slidesharecdn.com/swf/ssplayerd.swf?doc=loremipsum-090602133056-phpapp02&stripped_title=lorem-ipsum-title" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="477" height="510"></embed>
      </object>
      <div style="font-size:11px;font-family:tahoma,arial;height:26px;padding-top:2px;">View more 
        <a style="text-decoration:underline;" href="http://www.slideshare.net/">PDF documents</a>
        from 
        <a style="text-decoration:underline;" href="http://www.slideshare.net/matt_openflows">matt_openflows</a>.
      </div>
    </div>
    */

    $embed_code = str_replace('<a href=', '<a target="_blank" href=', $embed_code);
    $embed_code = preg_replace('@width:\d+px@', 'width:320px', $embed_code);
    $embed_code = preg_replace('@width="\d+"@', 'width="320"', $embed_code);
    $embed_code = preg_replace('@height="\d+"@', 'height="240"', $embed_code);
    $embed_code = preg_replace('@<div[^>]*>View more.*?</div>@', '', $embed_code);
    $medianode->field_document[0]['view'] = $embed_code;
    $medianode->field_document[0]['thumb'] = $medianode->field_document[0]['data']['THUMBNAILSMALLURL'][0];
    $media = array_merge($media, $medianode->field_document);
  }

  $multimedia .= '<div id="multimedia_main">';
  if (empty($media)) {
    $multimedia .= '<div id="multimedia_main_na">';
    if (user_access('create video content') && user_access('create document content') && user_access('create photo content')) {
      $multimedia .= t('Be the first to add a <a target="_parent" href="@photo_link">photo</a>, <a target="_parent" href="@video_link">video</a>, or <a target="_parent" href="@document_link">PDF</a> about this site! Each expresses a personal perspective.',
          array(
            '@photo_link' => base_path().'node/add/photo?isSimple=true&destination=node/'.$node->nid.'/simple&nid='.$node->nid.'&node_title='.htmlspecialchars($node->title),
            '@video_link' => base_path().'node/add/video?isSimple=true&destination=node/'.$node->nid.'/simple&nid='.$node->nid.'&node_title='.htmlspecialchars($node->title),
            '@document_link' => base_path().'node/add/document?isSimple=true&destination=node/'.$node->nid.'/simple&nid='.$node->nid.'&node_title='.htmlspecialchars($node->title),
            ));
    }
    else {
      $multimedia .= t('Registered users can post photos, videos, and documents here.');
    }
    $multimedia .= '</div>';
  }
  else {
    // randomize array
    shuffle($media);
    // display first multimedia object
    $multimedia .= $media[0]['view'];
  }
  $multimedia .= '</div>';

  if (!empty($media)) {
    $multimedia .= '<div id="multimedia_description">';
    $multimedia .= multimedia_content_media_description($media[0], $name);
    $multimedia .= '</div>';
    if (user_access('create video content') && user_access('create document content') && user_access('create photo content')) {
      $multimedia .= '<p id="multimedia_selector_title">';
      $multimedia .= t('add <a target="_parent" href="@photo_link">photo</a>, <a target="_parent" href="@video_link">video</a>, <a target="_parent" href="@document_link">PDF</a>',
          array(
            '@photo_link' => base_path().'node/add/photo?isSimple=true&destination=node/'.$node->nid.'/simple&nid='.$node->nid.'&node_title='.htmlspecialchars($node->title),
            '@video_link' => base_path().'node/add/video?isSimple=true&destination=node/'.$node->nid.'/simple&nid='.$node->nid.'&node_title='.htmlspecialchars($node->title),
            '@document_link' => base_path().'node/add/document?isSimple=true&destination=node/'.$node->nid.'/simple&nid='.$node->nid.'&node_title='.htmlspecialchars($node->title),
            )).
          '</p>';
    }
    $multimedia .= '<div id="multimedia_selector">';
      // start doing the javascript
      $js = 'var multimedia_main = new Array();';
      $js .= 'var multimedia_description = new Array();';
      $multimedia .= '<ul>';
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
          } else {
            // DEBUG
            $multimedia .= '<li>Error: unknown media type</li>';
          }
        }
      $multimedia .= '</ul>';
      // output the javascript
      $multimedia .= '<script type="text/javascript">'.$js.'</script>';
    $multimedia .= '</div>';
  }

  // Impacts tab
  $impacts = impacts_output_impacts($node);

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
  $comments_tab_title = $comment_count ?
    t('Comments (@comment-count)', array('@comment-count' => $comment_count))
    : t('Comments');
  // theme('comment_wrapper') pulls in comments formatted in template.php, though it doesn't work. comment_render($node) does work but it shows up twice.
  $form['tabs']['tab2'] = array(
    '#type' => 'tabpage',
    '#title' => $comments_tab_title,
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
<!--/green_site-full.tpl.php-->
