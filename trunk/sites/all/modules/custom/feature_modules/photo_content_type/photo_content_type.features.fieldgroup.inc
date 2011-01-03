<?php

/**
 * Implementation of hook_fieldgroup_default_groups().
 */
function photo_content_type_fieldgroup_default_groups() {
  $groups = array();

  // Exported group: group_photos
  $groups['photo-group_photos'] = array(
    'type_name' => 'photo',
    'group_name' => 'group_photos',
    'label' => 'User or Hosted Photo',
    'settings' => array(
      'form' => array(
        'style' => 'fieldset',
        'description' => 'Your image can be uploaded from your desktop or already online in a photo-sharing service. The following services are provided: Flickr.com (enter the URL above image) or Photobucket.com (enter the Direct Link on left). The photo will be displayed appropriately from this link. If it did not work, make sure your Flickr or Photobucket account is set in Public mode.

Please enter only one photo on this form and then submit',
      ),
      'display' => array(
        'description' => '',
        'teaser' => array(
          'format' => 'fieldset',
          'exclude' => 0,
        ),
        'full' => array(
          'format' => 'fieldset',
          'exclude' => 0,
        ),
        '4' => array(
          'format' => 'fieldset',
          'exclude' => 0,
        ),
        '2' => array(
          'format' => 'fieldset',
          'exclude' => 0,
        ),
        '3' => array(
          'format' => 'fieldset',
          'exclude' => 0,
        ),
        'token' => array(
          'format' => 'fieldset',
          'exclude' => 0,
        ),
        'label' => 'above',
      ),
    ),
    'weight' => '-3',
    'group_type' => 'standard',
    'fields' => array(
      '0' => 'field_image_local',
      '1' => 'field_photo',
    ),
  );

  // Translatables
  // Included for use with string extractors like potx.
  t('User or Hosted Photo');

  return $groups;
}
