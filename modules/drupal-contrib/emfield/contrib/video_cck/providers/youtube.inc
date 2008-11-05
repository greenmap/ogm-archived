<?php
// $Id: youtube.inc,v 1.4 2007/10/17 17:28:02 aaron Exp $

define('VIDEO_CCK_YOUTUBE_MAIN_URL', 'http://www.youtube.com/');
define('VIDEO_CCK_YOUTUBE_API_INFO', 'http://youtube.com/dev');
define('VIDEO_CCK_YOUTUBE_API_APPLICATION_URL', 'http://www.youtube.com/my_profile_dev');
define('VIDEO_CCK_YOUTUBE_REST_ENDPOINT', 'http://www.youtube.com/api2_rest');

/**
 * hook video_cck_PROVIDER_info
 * this returns information relevant to a specific 3rd party video provider
 * @return
 *   an array of strings requested by various admin and other forms
 *   'name' => the translated name of the provider
 *   'url' => the url to the main page for the provider
 *   'settings_description' => a description of the provider that will be posted in the admin settings form
 *   'supported_features' => an array of rows describing the state of certain supported features by the provider.
 *      These will be rendered in a table, with the columns being 'Feature', 'Supported', 'Notes'.
 */
function video_cck_youtube_info() {
  $name = t('YouTube');
  $features = array(
    array(t('Autoplay'), t('Yes'), ''),
    array(t('RSS Attachment'), t('No'), ''),
    array(t('Show related videos'), t('Yes'), t('This is embedded in the video itself when enabled; currently not available with other providers. Set the feature above.')),
    array(t('Thumbnails'), t('Yes'), t('May not currently resize thumbnails. Must have an API key for thumbnails at the moment, although research is underway to determine an alternative to this. Set your API key above.')),
  );
  return array(
    'provider' => 'youtube',
    'name' => $name,
    'url' => VIDEO_CCK_YOUTUBE_MAIN_URL,
    'settings_description' => t('These settings specifically affect videos displayed from !youtube. You can learn more about its !api here.', array('!youtube' => l($name, VIDEO_CCK_YOUTUBE_MAIN_URL, array('target' => '_blank')), '!api' => l(t('API'), VIDEO_CCK_YOUTUBE_API_INFO, array('target' => '_blank')))),
    'supported_features' => $features,
  );
}

/**
 * hook video_cck_PROVIDER_settings
 * this should return a subform to be added to the video_cck_settings() admin settings page.
 * note that a form field will already be provided, at $form['PROVIDER'] (such as $form['youtube'])
 * so if you want specific provider settings within that field, you can add the elements to that form field.
 */
function video_cck_youtube_settings() {
  $form['youtube']['video_cck_youtube_show_related_videos'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show related videos'),
    '#default_value' => variable_get('video_cck_youtube_show_related_videos', 0),
    '#description' => t('If checked, then when playing a video from YouTube, users may hover over the video to see thumbnails & links to related videos.'),
  );
  $form['youtube']['api'] = array(
    '#type' => 'fieldset',
    '#title' => t('YouTube API'),
    '#description' => t('If you wish to be able to display YouTube thumbnails automatically, you will first need to apply for an API Developer Key from the !youtube. Note that you do not need this key to display YouTube videos themselves.', array('!youtube' => l('YouTube Developer Profile page', VIDEO_CCK_YOUTUBE_API_APPLICATION_URL, array('target' => '_blank')))),
    '#collapsible' => true,
    '#collapsed' => true,
  );
  $form['youtube']['api']['video_cck_youtube_api_key'] = array(
    '#type' => 'textfield',
    '#title' => t('YouTube API Key'),
    '#default_value' => variable_get('video_cck_youtube_api_key', ''),
    '#description' => t('Please enter your YouTube Developer Key here.'),
  );
  $form['youtube']['api']['video_cck_youtube_api_secret'] = array(
    '#type' => 'textfield',
    '#title' => t('YouTube API Secret'),
    '#default_value' => variable_get('video_cck_youtube_api_secret', ''),
    '#description' => t('If you have a secret for the YouTube API, enter it here.'),
  );
  return $form;
}

/**
 * this is a wrapper for video_cck_request_xml that includes youtube's api key
 */
function video_cck_youtube_request($method, $args = array(), $cached = false) {
  $args['dev_id'] = trim(variable_get('video_cck_youtube_api_key', ''));
  $args['method'] = $method;

  // if we've got a secret sign the arguments
  // TODO: doesn't seem to matter
//  if ($secret = trim(variable_get('video_cck_youtube_api_secret', ''))) {
//    $args['api_sig'] = md5($secret . $arghash);
//  }

  $request = module_invoke('emfield', 'request_xml', 'youtube', VIDEO_CCK_YOUTUBE_REST_ENDPOINT, $args, $cached);
  return $request;
}

/**
 * hook video_cck_PROVIDER_extract
 * this is called to extract the video code from a pasted URL or embed code.
 * @param $embed
 *   an optional string with the pasted URL or embed code
 * @return
 *   either an array of regex expressions to be tested, or a string with the video code to be used
 *   if the hook tests the code itself, it should return either the string of the video code (if matched), or an empty array.
 *   otherwise, the calling function will handle testing the embed code against each regex string in the returned array.
 */
function video_cck_youtube_extract($embed = '') {
  // src="http://www.youtube.com/v/nvbQQnvxXDk"
  // http://youtube.com/watch?v=nvbQQnvxXDk
  // http://www.youtube.com/watch?v=YzFCA-xUc8w&feature=dir
  return array(
    '@youtube\.com/v/([^"\&]+)@i',
    '@youtube\.com/watch\?v=([^"\&]+)@i',
  );
}

/**
 * hook video_cck_PROVIDER_embedded_link($video_code)
 * returns a link to view the video at the provider's site
 *  @param $video_code
 *    the string containing the video to watch
 *  @return
 *    a string containing the URL to view the video at the original provider's site
 */
function video_cck_youtube_embedded_link($video_code) {
  return 'http://www.youtube.com/watch?v=' . $video_code;
}

/**
 * the embedded flash displaying the youtube video
 */
function theme_video_cck_youtube_flash($embed, $width, $height, $autoplay) {
  if ($embed) {
    if ($autoplay) {
      $autoplay_value = '&autoplay=1';
    }
    $related = variable_get('video_cck_youtube_show_related_videos', 0);
    $output .= "<object height=\"$height\" width=\"$width\"><param name=\"movie\" value=\"http://www.youtube.com/v/$embed\"><param name=\"wmode\" value=\"transparent\"><embed src=\"http://www.youtube.com/v/$embed&rel=$related" . $autoplay_value . "\" type=\"application/x-shockwave-flash\" wmode=\"transparent\" height=\"$height\" width=\"$width\"></object>";
  }
  return $output;
}

/**
 * hook video_cck_PROVIDER_thumbnail
 * returns the external url for a thumbnail of a specific video
 * TODO: make the args: ($embed, $field, $item), with $field/$item provided if we need it, but otherwise simplifying things
 *  @param $field
 *    the field of the requesting node
 *  @param $item
 *    the actual content of the field from the requesting node
 *  @return
 *    a URL pointing to the thumbnail
 */
function video_cck_youtube_thumbnail($field, $item, $formatter, $node, $width, $height) {
  $youtube_id = $item['value'];
  $request = video_cck_youtube_request('youtube.videos.get_details', array('video_id' => $youtube_id));
  $tn = $request['THUMBNAIL_URL'][0];
  return $tn;
}

/**
 * hook video_cck_PROVIDER_video
 * this actually displays the full/normal-sized video we want, usually on the default page view
 *  @param $embed
 *    the video code for the video to embed
 *  @param $width
 *    the width to display the video
 *  @param $height
 *    the height to display the video
 *  @param $field
 *    the field info from the requesting node
 *  @param $item
 *    the actual content from the field
 *  @return
 *    the html of the embedded video
 */
function video_cck_youtube_video($embed, $width, $height, $field, $item, $autoplay) {
  $output = theme('video_cck_youtube_flash', $embed, $width, $height, $autoplay);
  return $output;
}

/**
 * hook video_cck_PROVIDER_video
 * this actually displays the preview-sized video we want, commonly for the teaser
 *  @param $embed
 *    the video code for the video to embed
 *  @param $width
 *    the width to display the video
 *  @param $height
 *    the height to display the video
 *  @param $field
 *    the field info from the requesting node
 *  @param $item
 *    the actual content from the field
 *  @return
 *    the html of the embedded video
 */
function video_cck_youtube_preview($embed, $width, $height, $field, $item, $autoplay) {
  $output = theme('video_cck_youtube_flash', $embed, $width, $height, $autoplay);
  return $output;
}
