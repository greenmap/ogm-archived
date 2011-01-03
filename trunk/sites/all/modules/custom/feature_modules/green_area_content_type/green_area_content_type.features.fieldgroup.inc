<?php

/**
 * Implementation of hook_fieldgroup_default_groups().
 */
function green_area_content_type_fieldgroup_default_groups() {
  $groups = array();

  // Exported group: group_advanced_details
  $groups['green_area-group_advanced_details'] = array(
    'type_name' => 'green_area',
    'group_name' => 'group_advanced_details',
    'label' => 'Advanced Details',
    'settings' => array(
      'form' => array(
        'style' => 'fieldset_collapsed',
        'description' => 'Add as much detail as possible. Really useful, but optional',
      ),
      'display' => array(
        'description' => '',
        'teaser' => array(
          'format' => 'f',
          'exclude' => 'f',
        ),
        'full' => array(
          'format' => 'f',
          'exclude' => 'f',
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
    'weight' => '1',
    'group_type' => 'standard',
    'fields' => array(
      '0' => 'field_web',
      '1' => 'field_email',
      '2' => 'field_phone',
      '3' => 'field_child_friendly',
      '4' => 'field_wheelchair_accessible',
      '5' => 'field_appointment_needed',
      '6' => 'field_accessible_by_public_tran',
      '7' => 'field_public_transport_directio',
      '8' => 'field_free_entry',
      '9' => 'field_entry_cost',
      '10' => 'field_volunteer_opportunities_a',
      '11' => 'field_volunteer_details',
    ),
  );

  // Exported group: group_videos_photos__audio
  $groups['green_area-group_videos_photos__audio'] = array(
    'type_name' => 'green_area',
    'group_name' => 'group_videos_photos__audio',
    'label' => 'Videos and Photos',
    'settings' => array(
      'form' => array(
        'style' => 'fieldset_collapsed',
        'description' => 'Your image can be uploaded from your desktop or already online in a photo-sharing service. The following services are provided: Flickr.com (enter the URL above image) or Photobucket.com (enter the Direct Link on left). The photo will be displayed appropriately from this link. If it did not work, make sure your Flickr or Photobucket account is set in Public mode.

Please enter only one photo on this form and then submit',
      ),
      'display' => array(
        'description' => '',
        'teaser' => array(
          'format' => 'f',
          'exclude' => 'f',
        ),
        'full' => array(
          'format' => 'f',
          'exclude' => 'f',
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
    'weight' => '2',
    'group_type' => 'standard',
    'fields' => array(
      '0' => 'field_image',
      '1' => 'field_image_caption',
      '2' => 'field_video',
      '3' => 'field_video_caption',
    ),
  );

  // Translatables
  // Included for use with string extractors like potx.
  t('Advanced Details');
  t('Videos and Photos');

  return $groups;
}
