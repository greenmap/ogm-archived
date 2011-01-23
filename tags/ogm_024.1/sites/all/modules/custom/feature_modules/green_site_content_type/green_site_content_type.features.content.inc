<?php

/**
 * Implementation of hook_content_default_fields().
 */
function green_site_content_type_content_default_fields() {
  $fields = array();

  // Exported field: field_accessible_by_public_tran
  $fields['green_site-field_accessible_by_public_tran'] = array(
    'field_name' => 'field_accessible_by_public_tran',
    'type_name' => 'green_site',
    'display_settings' => array(
      'weight' => '1',
      'parent' => 'group_advanced_details',
      '4' => array(
        'format' => 'default',
        'exclude' => 1,
      ),
      'label' => array(
        'format' => 'above',
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'text',
    'required' => '0',
    'multiple' => '0',
    'module' => 'text',
    'active' => '1',
    'text_processing' => '0',
    'max_length' => '',
    'allowed_values' => '',
    'allowed_values_php' => ' return array(
   0 => t(\'Not accessible by public transport\'),
   1 => t(\'Accessible by public transport\'),
 );',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'value' => 0,
        ),
      ),
      'default_value_php' => NULL,
      'label' => 'Accessible by public transport',
      'weight' => '1',
      'description' => '',
      'type' => 'optionwidgets_onoff',
      'module' => 'optionwidgets',
    ),
  );

  // Exported field: field_appointment_needed
  $fields['green_site-field_appointment_needed'] = array(
    'field_name' => 'field_appointment_needed',
    'type_name' => 'green_site',
    'display_settings' => array(
      'weight' => 0,
      'parent' => 'group_advanced_details',
      '4' => array(
        'format' => 'default',
        'exclude' => 1,
      ),
      'label' => array(
        'format' => 'above',
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'text',
    'required' => '0',
    'multiple' => '0',
    'module' => 'text',
    'active' => '1',
    'text_processing' => '0',
    'max_length' => '',
    'allowed_values' => '',
    'allowed_values_php' => ' return array(
  0 => t(\'Appointment not needed\'),
  1 => t(\'Appointment needed\'),
 );',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'value' => 0,
        ),
      ),
      'default_value_php' => NULL,
      'label' => 'Appointment Needed',
      'weight' => 0,
      'description' => '',
      'type' => 'optionwidgets_onoff',
      'module' => 'optionwidgets',
    ),
  );

  // Exported field: field_awaiting_approval
  $fields['green_site-field_awaiting_approval'] = array(
    'field_name' => 'field_awaiting_approval',
    'type_name' => 'green_site',
    'display_settings' => array(
      'weight' => '9',
      'parent' => '',
      '4' => array(
        'format' => 'default',
        'exclude' => 1,
      ),
      'label' => array(
        'format' => 'above',
        'exclude' => 0,
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '2' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      '3' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'token' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'number_integer',
    'required' => '0',
    'multiple' => '0',
    'module' => 'number',
    'active' => '1',
    'prefix' => '',
    'suffix' => '',
    'min' => '1',
    'max' => '1',
    'allowed_values' => '1',
    'allowed_values_php' => '',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'value' => '',
        ),
      ),
      'default_value_php' => NULL,
      'label' => 'Awaiting Approval',
      'weight' => '9',
      'description' => '',
      'type' => 'optionwidgets_select',
      'module' => 'optionwidgets',
    ),
  );

  // Exported field: field_child_friendly
  $fields['green_site-field_child_friendly'] = array(
    'field_name' => 'field_child_friendly',
    'type_name' => 'green_site',
    'display_settings' => array(
      'weight' => '-4',
      'parent' => 'group_advanced_details',
      '4' => array(
        'format' => 'default',
        'exclude' => 1,
      ),
      'label' => array(
        'format' => 'above',
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'text',
    'required' => '0',
    'multiple' => '0',
    'module' => 'text',
    'active' => '1',
    'text_processing' => '0',
    'max_length' => '',
    'allowed_values' => '',
    'allowed_values_php' => ' return array(
   0 => t(\'Not child friendly\'),
   1 => t(\'Children welcome\'),
 );',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'value' => 0,
        ),
      ),
      'default_value_php' => NULL,
      'label' => 'Children Welcome',
      'weight' => '-4',
      'description' => '',
      'type' => 'optionwidgets_onoff',
      'module' => 'optionwidgets',
    ),
  );

  // Exported field: field_details
  $fields['green_site-field_details'] = array(
    'field_name' => 'field_details',
    'type_name' => 'green_site',
    'display_settings' => array(
      'weight' => 0,
      'parent' => '',
      '4' => array(
        'format' => 'plain',
        'exclude' => 0,
      ),
      'label' => array(
        'format' => 'above',
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'text',
    'required' => '1',
    'multiple' => '0',
    'module' => 'text',
    'active' => '1',
    'text_processing' => '1',
    'max_length' => '',
    'allowed_values' => '',
    'allowed_values_php' => '',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'value' => '',
          'format' => '1',
          '_error_element' => 'default_value_widget][field_details][0][value',
        ),
      ),
      'default_value_php' => NULL,
      'rows' => '8',
      'size' => 60,
      'label' => 'Details',
      'weight' => 0,
      'description' => 'Provide as much detail as you can about the site\'s green attributes. This is the first thing users will read about the site. The first 100 characters are the most important. 
',
      'type' => 'text_textarea',
      'module' => 'text',
    ),
  );

  // Exported field: field_email
  $fields['green_site-field_email'] = array(
    'field_name' => 'field_email',
    'type_name' => 'green_site',
    'display_settings' => array(
      'weight' => '-7',
      'parent' => 'group_advanced_details',
      '4' => array(
        'format' => 'default',
        'exclude' => 1,
      ),
      'label' => array(
        'format' => 'above',
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'email',
    'required' => '0',
    'multiple' => '0',
    'module' => 'email',
    'active' => '1',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'email' => '',
        ),
      ),
      'default_value_php' => '',
      'size' => '80',
      'link_type' => 'mailto_encrypt',
      'label' => 'Site Email',
      'weight' => '-7',
      'description' => '',
      'type' => 'email_textfield',
      'module' => 'email',
    ),
  );

  // Exported field: field_email_involved
  $fields['green_site-field_email_involved'] = array(
    'field_name' => 'field_email_involved',
    'type_name' => 'green_site',
    'display_settings' => array(
      'weight' => '8',
      'parent' => '',
      '4' => array(
        'format' => 'default',
        'exclude' => 1,
      ),
      'label' => array(
        'format' => 'above',
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'email',
    'required' => '0',
    'multiple' => '0',
    'module' => 'email',
    'active' => '1',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'email' => '',
        ),
      ),
      'default_value_php' => '',
      'size' => '60',
      'link_type' => 'mailto',
      'label' => 'Contributor Email',
      'weight' => '8',
      'description' => 'Optional - Please add your email address if you are directly involved in this site as owner, coordinator, director, manager, etc. This information will not be visible to the public.',
      'type' => 'email_textfield',
      'module' => 'email',
    ),
  );

  // Exported field: field_entry_cost
  $fields['green_site-field_entry_cost'] = array(
    'field_name' => 'field_entry_cost',
    'type_name' => 'green_site',
    'display_settings' => array(
      'weight' => '4',
      'parent' => 'group_advanced_details',
      '4' => array(
        'format' => 'default',
        'exclude' => 1,
      ),
      'label' => array(
        'format' => 'above',
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'text',
    'required' => '0',
    'multiple' => '0',
    'module' => 'text',
    'active' => '1',
    'text_processing' => '0',
    'max_length' => '',
    'allowed_values' => '',
    'allowed_values_php' => '',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'value' => '',
        ),
      ),
      'default_value_php' => '',
      'rows' => '1',
      'label' => 'Entry cost',
      'weight' => '4',
      'description' => 'If not free',
      'type' => 'text_textfield',
      'module' => 'text',
    ),
  );

  // Exported field: field_free_entry
  $fields['green_site-field_free_entry'] = array(
    'field_name' => 'field_free_entry',
    'type_name' => 'green_site',
    'display_settings' => array(
      'weight' => '3',
      'parent' => 'group_advanced_details',
      '4' => array(
        'format' => 'default',
        'exclude' => 1,
      ),
      'label' => array(
        'format' => 'above',
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'text',
    'required' => '0',
    'multiple' => '0',
    'module' => 'text',
    'active' => '1',
    'text_processing' => '0',
    'max_length' => '',
    'allowed_values' => '',
    'allowed_values_php' => ' return array(
   0 => t(\'Not free\'),
   1 => t(\'Free entry\'),
 );',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'value' => 1,
        ),
      ),
      'default_value_php' => NULL,
      'label' => 'Free entry',
      'weight' => '3',
      'description' => '',
      'type' => 'optionwidgets_onoff',
      'module' => 'optionwidgets',
    ),
  );

  // Exported field: field_image
  $fields['green_site-field_image'] = array(
    'field_name' => 'field_image',
    'type_name' => 'green_site',
    'display_settings' => array(
      'weight' => '-8',
      'parent' => 'group_videos_photos__audio',
      '4' => array(
        'format' => 'image_thumbnail',
        'exclude' => 0,
      ),
      'label' => array(
        'format' => 'above',
      ),
      'teaser' => array(
        'format' => 'image_thumbnail',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'emimage',
    'required' => '0',
    'multiple' => '0',
    'module' => 'emimage',
    'active' => '1',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'embed' => '',
          'value' => '',
        ),
      ),
      'default_value_php' => NULL,
      'full_width' => '320',
      'full_height' => '0',
      'full_link' => 'provider',
      'preview_width' => '320',
      'preview_height' => '0',
      'preview_link' => 'provider',
      'thumbnail_width' => '80',
      'thumbnail_height' => '0',
      'thumbnail_link' => 'node',
      'providers' => array(
        'flickr' => 'flickr',
        'photobucket' => 'photobucket',
        'custom_url' => 0,
        'picasa' => 0,
        'slideshare' => 0,
      ),
      'emimport' => 0,
      'label' => 'Image',
      'weight' => '-3',
      'description' => 'Your image needs to be online in a photo-sharing service. Enter the URL or Embed Code here. The photo will be displayed appropriately from this link.',
      'type' => 'emimage_textfields',
      'module' => 'emimage',
    ),
  );

  // Exported field: field_image_caption
  $fields['green_site-field_image_caption'] = array(
    'field_name' => 'field_image_caption',
    'type_name' => 'green_site',
    'display_settings' => array(
      'weight' => '-6',
      'parent' => 'group_videos_photos__audio',
      '4' => array(
        'format' => 'plain',
        'exclude' => 0,
      ),
      'label' => array(
        'format' => 'above',
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'text',
    'required' => '0',
    'multiple' => '0',
    'module' => 'text',
    'active' => '1',
    'text_processing' => '0',
    'max_length' => '',
    'allowed_values' => '',
    'allowed_values_php' => '',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'value' => '',
        ),
      ),
      'default_value_php' => '',
      'rows' => '1',
      'label' => 'Image caption or credit',
      'weight' => '-1',
      'description' => '',
      'type' => 'text_textfield',
      'module' => 'text',
    ),
  );

  // Exported field: field_image_local
  $fields['green_site-field_image_local'] = array(
    'field_name' => 'field_image_local',
    'type_name' => 'green_site',
    'display_settings' => array(
      'label' => array(
        'format' => 'above',
        'exclude' => 0,
      ),
      'teaser' => array(
        'format' => 'image_plain',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'image_plain',
        'exclude' => 0,
      ),
      '4' => array(
        'format' => 'image_plain',
        'exclude' => 0,
      ),
      '2' => array(
        'format' => 'image_plain',
        'exclude' => 0,
      ),
      '3' => array(
        'format' => 'image_plain',
        'exclude' => 0,
      ),
      'token' => array(
        'format' => 'image_plain',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'filefield',
    'required' => '0',
    'multiple' => '0',
    'module' => 'filefield',
    'active' => '1',
    'list_field' => '0',
    'list_default' => 1,
    'description_field' => '0',
    'widget' => array(
      'file_extensions' => 'jpeg jpg gif png',
      'file_path' => 'user_upload',
      'progress_indicator' => 'bar',
      'max_filesize_per_file' => '5M',
      'max_filesize_per_node' => '50M',
      'max_resolution' => '0',
      'min_resolution' => '0',
      'alt' => '',
      'custom_alt' => 0,
      'title' => '',
      'custom_title' => 0,
      'title_type' => 'textfield',
      'default_image' => NULL,
      'use_default_image' => 0,
      'label' => 'User-Uploaded Image',
      'weight' => '-2',
      'description' => '',
      'type' => 'imagefield_widget',
      'module' => 'imagefield',
    ),
  );

  // Exported field: field_involved
  $fields['green_site-field_involved'] = array(
    'field_name' => 'field_involved',
    'type_name' => 'green_site',
    'display_settings' => array(
      'weight' => '6',
      'parent' => '',
      '4' => array(
        'format' => 'default',
        'exclude' => 1,
      ),
      'label' => array(
        'format' => 'above',
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'text',
    'required' => '1',
    'multiple' => '0',
    'module' => 'text',
    'active' => '1',
    'text_processing' => '0',
    'max_length' => '',
    'allowed_values' => '',
    'allowed_values_php' => ' return array(
   \'no\' => t(\'No\'),
   \'yes\' => t(\'Yes\'),
 );',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'value' => 'no',
        ),
      ),
      'default_value_php' => NULL,
      'label' => 'Are You Directly Involved in the Site?',
      'weight' => '6',
      'description' => 'Please disclose if you are directly involved in this site as a representative or owner',
      'type' => 'optionwidgets_select',
      'module' => 'optionwidgets',
    ),
  );

  // Exported field: field_name_involved
  $fields['green_site-field_name_involved'] = array(
    'field_name' => 'field_name_involved',
    'type_name' => 'green_site',
    'display_settings' => array(
      'weight' => '7',
      'parent' => '',
      '4' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'label' => array(
        'format' => 'above',
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'text',
    'required' => '0',
    'multiple' => '0',
    'module' => 'text',
    'active' => '1',
    'text_processing' => '0',
    'max_length' => '',
    'allowed_values' => '',
    'allowed_values_php' => '',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'value' => '',
        ),
      ),
      'default_value_php' => '',
      'rows' => '1',
      'label' => 'Contributor Name',
      'weight' => '7',
      'description' => 'Optional - Please add your name if you are directly involved in this site as owner, coordinator, director, manager, etc. This information will not be visible to the public.',
      'type' => 'text_textfield',
      'module' => 'text',
    ),
  );

  // Exported field: field_phone
  $fields['green_site-field_phone'] = array(
    'field_name' => 'field_phone',
    'type_name' => 'green_site',
    'display_settings' => array(
      'weight' => '-6',
      'parent' => 'group_advanced_details',
      '4' => array(
        'format' => 'default',
        'exclude' => 1,
      ),
      'label' => array(
        'format' => 'above',
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'text',
    'required' => '0',
    'multiple' => '0',
    'module' => 'text',
    'active' => '1',
    'text_processing' => '0',
    'max_length' => '',
    'allowed_values' => '',
    'allowed_values_php' => '',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'value' => '',
        ),
      ),
      'default_value_php' => '',
      'rows' => '1',
      'label' => 'Telephone',
      'weight' => '-6',
      'description' => 'Include area code',
      'type' => 'text_textfield',
      'module' => 'text',
    ),
  );

  // Exported field: field_public_transport_directio
  $fields['green_site-field_public_transport_directio'] = array(
    'field_name' => 'field_public_transport_directio',
    'type_name' => 'green_site',
    'display_settings' => array(
      'weight' => '2',
      'parent' => 'group_advanced_details',
      '4' => array(
        'format' => 'default',
        'exclude' => 1,
      ),
      'label' => array(
        'format' => 'above',
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'text',
    'required' => '0',
    'multiple' => '0',
    'module' => 'text',
    'active' => '1',
    'text_processing' => '0',
    'max_length' => '',
    'allowed_values' => '',
    'allowed_values_php' => '',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'value' => '',
        ),
      ),
      'default_value_php' => '',
      'rows' => '3',
      'label' => 'Public Transit Directions',
      'weight' => '2',
      'description' => '',
      'type' => 'text_textarea',
      'module' => 'text',
    ),
  );

  // Exported field: field_video
  $fields['green_site-field_video'] = array(
    'field_name' => 'field_video',
    'type_name' => 'green_site',
    'display_settings' => array(
      'weight' => 0,
      'parent' => 'group_videos_photos__audio',
      '4' => array(
        'format' => 'default',
        'exclude' => 1,
      ),
      'label' => array(
        'format' => 'above',
      ),
      'teaser' => array(
        'format' => 'video_video',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'video_video',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'emvideo',
    'required' => '0',
    'multiple' => '0',
    'module' => 'emvideo',
    'active' => '1',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'embed' => '',
          'value' => '',
        ),
      ),
      'default_value_php' => NULL,
      'video_width' => '320',
      'video_height' => '240',
      'video_autoplay' => 0,
      'preview_width' => '320',
      'preview_height' => '240',
      'preview_autoplay' => 0,
      'thumbnail_width' => '80',
      'thumbnail_height' => '60',
      'thumbnail_default_path' => '',
      'providers' => array(
        'bliptv' => 'bliptv',
        'google' => 'google',
        'jumpcut' => 'jumpcut',
        'livevideo' => 'livevideo',
        'metacafe' => 'metacafe',
        'myspace' => 'myspace',
        'revver' => 'revver',
        'sevenload' => 'sevenload',
        'youtube' => 'youtube',
        'slideshare' => 0,
        'zzz_custom_url' => 0,
      ),
      'emimport' => 1,
      'thumbnail_link_title' => 'See video',
      'label' => 'Video',
      'weight' => 0,
      'description' => 'Enter the URL or Embed Code here from a video-sharing service. The embedded video will be displayed appropriately from this.
',
      'type' => 'emvideo_textfields',
      'module' => 'emvideo',
    ),
  );

  // Exported field: field_video_caption
  $fields['green_site-field_video_caption'] = array(
    'field_name' => 'field_video_caption',
    'type_name' => 'green_site',
    'display_settings' => array(
      'weight' => '3',
      'parent' => 'group_videos_photos__audio',
      '4' => array(
        'format' => 'default',
        'exclude' => 1,
      ),
      'label' => array(
        'format' => 'above',
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'text',
    'required' => '0',
    'multiple' => '0',
    'module' => 'text',
    'active' => '1',
    'text_processing' => '0',
    'max_length' => '',
    'allowed_values' => '',
    'allowed_values_php' => '',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'value' => '',
        ),
      ),
      'default_value_php' => '',
      'rows' => '1',
      'label' => 'Video caption or credit',
      'weight' => '1',
      'description' => '',
      'type' => 'text_textfield',
      'module' => 'text',
    ),
  );

  // Exported field: field_volunteer_details
  $fields['green_site-field_volunteer_details'] = array(
    'field_name' => 'field_volunteer_details',
    'type_name' => 'green_site',
    'display_settings' => array(
      'weight' => '6',
      'parent' => 'group_advanced_details',
      '4' => array(
        'format' => 'default',
        'exclude' => 1,
      ),
      'label' => array(
        'format' => 'above',
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'text',
    'required' => '0',
    'multiple' => '0',
    'module' => 'text',
    'active' => '1',
    'text_processing' => '0',
    'max_length' => '',
    'allowed_values' => '',
    'allowed_values_php' => '',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'value' => '',
        ),
      ),
      'default_value_php' => '',
      'rows' => '2',
      'label' => 'Details of Volunteer Opportunities',
      'weight' => '6',
      'description' => '',
      'type' => 'text_textarea',
      'module' => 'text',
    ),
  );

  // Exported field: field_volunteer_opportunities_a
  $fields['green_site-field_volunteer_opportunities_a'] = array(
    'field_name' => 'field_volunteer_opportunities_a',
    'type_name' => 'green_site',
    'display_settings' => array(
      'weight' => '5',
      'parent' => 'group_advanced_details',
      '4' => array(
        'format' => 'default',
        'exclude' => 1,
      ),
      'label' => array(
        'format' => 'above',
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'text',
    'required' => '0',
    'multiple' => '0',
    'module' => 'text',
    'active' => '1',
    'text_processing' => '0',
    'max_length' => '',
    'allowed_values' => '',
    'allowed_values_php' => ' return array(
  0 => t(\'No Volunteer Opportunities\'),
  1 => t(\'Volunteer Opportunities are Available\'),
 );',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'value' => 0,
        ),
      ),
      'default_value_php' => NULL,
      'label' => 'Volunteer',
      'weight' => '5',
      'description' => '',
      'type' => 'optionwidgets_onoff',
      'module' => 'optionwidgets',
    ),
  );

  // Exported field: field_web
  $fields['green_site-field_web'] = array(
    'field_name' => 'field_web',
    'type_name' => 'green_site',
    'display_settings' => array(
      'weight' => '-8',
      'parent' => 'group_advanced_details',
      '4' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'label' => array(
        'format' => 'above',
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'link',
    'required' => '0',
    'multiple' => '0',
    'module' => 'link',
    'active' => '1',
    'attributes' => array(
      'target' => '_blank',
      'rel' => '',
      'class' => '',
    ),
    'display' => array(
      'url_cutoff' => '80',
    ),
    'url' => 0,
    'title' => 'none',
    'title_value' => '',
    'enable_tokens' => 1,
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'url' => '',
        ),
      ),
      'default_value_php' => NULL,
      'label' => 'Web Address',
      'weight' => '-8',
      'description' => 'Remember to include "http://" at the start of the url. The link won\'t work if you don\'t include http://
',
      'type' => 'link',
      'module' => 'link',
    ),
  );

  // Exported field: field_wheelchair_accessible
  $fields['green_site-field_wheelchair_accessible'] = array(
    'field_name' => 'field_wheelchair_accessible',
    'type_name' => 'green_site',
    'display_settings' => array(
      'weight' => '-3',
      'parent' => 'group_advanced_details',
      '4' => array(
        'format' => 'default',
        'exclude' => 1,
      ),
      'label' => array(
        'format' => 'above',
      ),
      'teaser' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
      'full' => array(
        'format' => 'default',
        'exclude' => 0,
      ),
    ),
    'widget_active' => '1',
    'type' => 'text',
    'required' => '0',
    'multiple' => '0',
    'module' => 'text',
    'active' => '1',
    'text_processing' => '0',
    'max_length' => '',
    'allowed_values' => '',
    'allowed_values_php' => ' return array(
  0 => t(\'Not accessible\'),
  1 => t(\'Wheelchair Accessible\'),
 );',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'value' => 0,
        ),
      ),
      'default_value_php' => NULL,
      'label' => 'Wheelchair Accessible',
      'weight' => '-3',
      'description' => '',
      'type' => 'optionwidgets_onoff',
      'module' => 'optionwidgets',
    ),
  );

  // Translatables
  // Included for use with string extractors like potx.
  t('Accessible by public transport');
  t('Appointment Needed');
  t('Are You Directly Involved in the Site?');
  t('Awaiting Approval');
  t('Children Welcome');
  t('Contributor Email');
  t('Contributor Name');
  t('Details');
  t('Details of Volunteer Opportunities');
  t('Entry cost');
  t('Free entry');
  t('Image');
  t('Image caption or credit');
  t('Public Transit Directions');
  t('Site Email');
  t('Telephone');
  t('User-Uploaded Image');
  t('Video');
  t('Video caption or credit');
  t('Volunteer');
  t('Web Address');
  t('Wheelchair Accessible');

  return $fields;
}
