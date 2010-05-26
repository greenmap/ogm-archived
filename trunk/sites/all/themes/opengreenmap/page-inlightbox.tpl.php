<style type="text/css">
body {
font-family: Arial;
background: #ffffff !important;
}

.location {
margin-right: 10px;
}

#lightboxaddress-center{
padding-left:10px;
text-align: center;
}

#lightboxaddress-right{
text-align: right;
float: right;
padding-top: 10px;
}

h2.icontitle  {
border-bottom:2px solid #8cc63f;
color:#666666;
font-weight:normal;
margin:auto auto 10px;
max-height:1.3em;
overflow:hidden;
width:400px;
padding-bottom: 5px;
font-size: 30px;
}

.subinfo {
height: 86px;
border-bottom:1px solid #8CC63F;
padding-bottom:5px;
padding-left: 100px;
padding-right: 90px;
}

.field-field-involved {
display: none;
}

.field-field-details .field-label {
display: none;
}

.submittedmap {
float:left;
text-align:left;
}

.submitteduser {
float:right;
text-align:right;
}

.submitted_text {
text-align: center;
}

.submittedadded {
border-bottom:1px solid #8CC63F;
color: #666;
}

.thumbnail {
float: left;
}

.thumbnail img {
cursor: default;
}

img.submitted_icon {
float: none !important;
height:17px;
margin-bottom:-2px !important;
margin-left:1px !important;
margin-top:2px !important;
width:17px;
}

div.fivestar-widget-static, .fivestar-static-form-item, .fivestar-submit, .fivestar-form-item, .fivestar-widget {
display: none !important;
}

.field-field-details {
font-size: 14px;
}

#viewonmap a{
color:#C6006F;
font-size:13px;
font-weight:600;
letter-spacing:4px;
text-transform:uppercase;
text-decoration: none;
}

#viewonmap a:hover {
text-decoration: none;
}

#viewonmap a:hover:after {
text-decoration: none;
content: ">";
}

#viewonmap a:hover:before {
text-decoration: none;
content: "<";
}

#viewonmap {
padding-top: 5px;
text-align: center;
}

</style>

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


<body>
<div class="taximage">
<center>
  <?php print $primary_icon .  $secondary_icons; ?>
  </center>
</div>

<h2 class="icontitle"><center><?php print $title; ?></center></h2>
<center>
<div class="subinfo">


<?php
// prepare content for MAIN tab
if($node->field_image[0]['value'] > '') {
  $image = $node->field_image;
  $image['widget']['thumbnail_width'] = '100';

  $media_thumb = theme('emimage_image_thumbnail', $image, $node->field_image[0], 'image_thumbnail', $node);
} elseif($node->field_video[0]['value'] > '') {
  $media_thumb = theme('emvideo_video_thumbnail', $node->field_video, $node->field_video[0], 'video_thumbnail', $node);
}
$media_thumb = preg_replace('/<a href="[^"]+"/', '<a href="#multimedia"', $media_thumb);
?>
 <div class="thumbnail">
<?php print $media_thumb ?>
</div>
<?php if ($media_thumb > '') { ?>
<div id="lightboxaddress-right">
<?php 
$location = $node->locations[0];
?>
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
      <?php print $location[province] . ' ' . $location[postal_code]; ?></div>
        <?php } ?>
      </div>
              <?php }
              else { ?>
<div id="lightboxaddress-center">
<?php 
$location = $node->locations[0];
?>
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
      <?php print $location[province] . ' ' . $location[postal_code]; ?></div>
        <?php } ?>
      </div>

                     <?php } ?>
</center>
<div id="viewonmap">
<?php
if(count($node->og_groups_both) > 0) {
    list($group_nid) = array_keys($node->og_groups_both);
    $group_title = $node->og_groups_both[$group_nid];
    print l('View on the Map', 'node/'. $group_nid,
                    array(
                      'query' => array('autoBubbleNID' => $node->nid),
                      'attributes' => array(
                        'target' => '_top',
                        'title' => t('View this Open Green Map'))));
  }?>

</div>
</div>

<?php print($node->body); ?>


<?php
 if ($field_phone[0] > '') {
      $contents .= '<div class="fieldphone">'. content_format('field_phone', $field_phone[0]) .'</div>';
    }
    if ($field_email[0] > '') {
      $contents .= '<div class="fieldemail">'. content_format('field_email', $field_email[0]) .'</div>';
    }
    if ($field_web[0] > '') {
      $link = str_replace('<a href=', '<a target="_blank" href=', content_format('field_web', $field_web[0]));
      $contents .= '<div class="fieldweb">'. $link .'</div>';
    }
?>
 <div class="submitted_text">
 <div class="submittedadded">
 <?php print t('added @date',
      array('@date' => date('m/Y', $node->created)));
  ?>
</div>
  <div class="submittedmap">
  <img class="map_icon" src="<?php print base_path() . path_to_theme() ?>/images/grey_icon.gif" width="20px" height="19px" alt="<?php print t('Part of a community map.'); ?>" title="<?php print t('Part of a community map.'); ?>"/>

<?php
if(count($node->og_groups_both) > 0) {
    list($group_nid) = array_keys($node->og_groups_both);
    $group_title = $node->og_groups_both[$group_nid];
    print 'to ' . l($group_title, 'node/'. $group_nid,
                    array(
                      'query' => array('autoBubbleNID' => $node->nid),
                      'attributes' => array(
                        'target' => '_top',
                        'title' => t('View this Open Green Map'))));
  }?>
  </div>
   <div class="submitteduser">
  <?php print t('by <a href="@profile_link" target="_top" title="View Profile">@name</a>',
      array('@profile_link' => url('user/'. $node->uid),
        '@name' => $node->name));
  ?>
  <img class="submitted_icon" src="<?php print base_path() . path_to_theme() ?>/img/mapper.gif" width="20px" height="19px" alt="<?php print t('This site was added by an official Mapmaker'); ?>" title="<?php print t('This site was added by an official Mapmaker'); ?>">
  </div>
</div>
</body>
