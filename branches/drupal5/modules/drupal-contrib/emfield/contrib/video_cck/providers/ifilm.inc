<?php
// $Id: ifilm.inc,v 1.3 2007/09/06 22:18:25 aaron Exp $

define('VIDEO_CCK_IFILM_MAIN_URL', 'http://www.ifilm.com/');

function video_cck_ifilm_info() {
  $name = t('iFilm');
  $features = array(
    array(t('Autoplay'), t('No'), t('In the works...')),
    array(t('RSS Attachment'), t('No'), ''),
    array(t('Thumbnails'), t('Yes'), ''),
  );
  return array(
    'provider' => 'ifilm',
    'name' => $name,
    'url' => VIDEO_CCK_IFILM_MAIN_URL,
    'settings_description' => t('These settings specifically affect videos displayed from !ifilm.', array('!ifilm' => l($name, VIDEO_CCK_IFILM_MAIN_URL, array('target' => '_blank')))),
    'supported_features' => $features,
  );
}

function video_cck_ifilm_settings() {
  $form = array();
  return $form;
}

function video_cck_ifilm_extract($embed) {
  return array(
    // http://www.ifilm.com/video/2836119/collection/19459/channel/comedy
    // <embed width="448" height="365" src="http://www.ifilm.com/efp" quality="high" bgcolor="000000" name="efp" align="middle" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="flvbaseclip=2836119&"> </embed> <h1><a href="http://www.ifilm.com/video/2836119">"I Lost It" with Tom Cruize and Jesus</a></h1><span>Posted Mar 25, 2007</span><p>What happens when Jesus, Abe Lincoln, Tom Cruise, Dustin Hoffman, Buddha and Einstein play a friendly game of poker?</p>
    '@ifilm\.com/video/([^/&"]*)@i',
  );
}

function video_cck_ifilm_request($embed, $cacheable = TRUE) {
  return NULL;
}

function video_cck_ifilm_video_link($video_code) {
  return 'http://www.ifilm.com/video/' . $video_code;
}

function theme_video_cck_ifilm_flash($embed, $width, $height, $autoplay) {
  // TODO: figure out autoplay...
  if ($embed) {
    $autoplay = $autoplay ? ' autoplay="true"' : '';
    $output = '<embed width="' . $width . '" height="' . $height . '" src="http://www.ifilm.com/efp" quality="high" bgcolor="000000" name="efp" align="middle" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="flvbaseclip=' . $embed . '&"' . $autoplay . '> </embed>';
  }
  return $output;
}

function video_cck_ifilm_thumbnail($field, $item, $formatter, $node, $width, $height) {
  $picturelink = substr($item['value'], 0, 7);
  return 'http://img1.ifilmpro.com/resize/image/stills/films/resize/istd/' . $picturelink . '.jpg?width=' . $width;
}

function video_cck_ifilm_video($embed, $width, $height, $field, $item, $autoplay) {
  $output = theme('video_cck_ifilm_flash', $embed, $width, $height, $autoplay);
  return $output;
}

function video_cck_ifilm_preview($embed, $width, $height, $field, $item, $autoplay) {
  $output = theme('video_cck_ifilm_flash', $embed, $width, $height, $autoplay);
  return $output;
}
