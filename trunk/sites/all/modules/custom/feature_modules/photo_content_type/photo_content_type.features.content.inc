<?php

/**
 * Implementation of hook_content_default_fields().
 */
function photo_content_type_content_default_fields() {
  $fields = array();

  // Exported field: field_awaiting_approval
  $fields['photo-field_awaiting_approval'] = array(
    'field_name' => 'field_awaiting_approval',
    'type_name' => 'photo',
    'display_settings' => array(
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
      '4' => array(
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
      'weight' => '2',
      'description' => '',
      'type' => 'optionwidgets_select',
      'module' => 'optionwidgets',
    ),
  );

  // Exported field: field_image_local
  $fields['photo-field_image_local'] = array(
    'field_name' => 'field_image_local',
    'type_name' => 'photo',
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
      'weight' => '-1',
      'description' => 'Add just one photo at a time, then submit. ',
      'type' => 'imagefield_widget',
      'module' => 'imagefield',
    ),
  );

  // Exported field: field_photo
  $fields['photo-field_photo'] = array(
    'field_name' => 'field_photo',
    'type_name' => 'photo',
    'display_settings' => array(
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
      'full_width' => '500',
      'full_height' => '0',
      'full_link' => '0',
      'preview_width' => '240',
      'preview_height' => '0',
      'preview_link' => '0',
      'thumbnail_width' => '100',
      'thumbnail_height' => '180',
      'thumbnail_link' => 'node',
      'providers' => array(
        'flickr' => 'flickr',
        'photobucket' => 'photobucket',
        'picasa' => 'picasa',
        'custom_url' => 0,
        'slideshare' => 0,
      ),
      'emimport' => 0,
      'label' => 'photo',
      'weight' => '-2',
      'description' => 'Your image needs to be online in a photo-sharing service. The following services are provided: Flickr.com (enter the URL above image) or Photobucket.com (enter the Direct Link on left). The photo will be displayed appropriately from this link. If it did not work, make sure your Flickr or Photobucket account is set in Public mode.',
      'type' => 'emimage_textfields',
      'module' => 'emimage',
    ),
  );

  // Exported field: field_site_1
  $fields['photo-field_site_1'] = array(
    'field_name' => 'field_site_1',
    'type_name' => 'photo',
    'display_settings' => array(
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
    'type' => 'nodereference',
    'required' => '1',
    'multiple' => '0',
    'module' => 'nodereference',
    'active' => '1',
    'referenceable_types' => array(
      'green_site' => 'green_site',
      'admin_message' => 0,
      'faq' => 0,
      'green_map' => 0,
      'poly' => 0,
      'impact' => 0,
      'mapmaker_profile' => 0,
      'page' => 0,
      'photo' => 0,
      'poll' => 0,
      'story' => 0,
      'testimonial' => 0,
      'video' => 0,
    ),
    'advanced_view' => '--',
    'advanced_view_args' => '',
    'widget' => array(
      'default_value' => array(
        '0' => array(
          'nid' => '0',
          'error_field' => 'field_site_1][nids',
        ),
      ),
      'default_value_php' => '',
      'label' => 'site',
      'weight' => '1',
      'description' => 'Your image needs to be online in a photo-sharing service. Enter the URL or Embed Code here. The photo will be displayed appropriately from this link.',
      'type' => 'nodereference_select',
      'module' => 'nodereference',
    ),
  );

  // Translatables
  // Included for use with string extractors like potx.
  t('Awaiting Approval');
  t('User-Uploaded Image');
  t('photo');
  t('site');

  return $fields;
}
