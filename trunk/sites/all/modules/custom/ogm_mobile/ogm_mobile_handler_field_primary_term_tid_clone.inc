<?php
// $Id: views_handler_field_primary_term_tid.inc,v 1.1.2.1 2010/10/13 18:20:52 brianV Exp $

/**
 * @file
 * Provide a views handlers for primary_term data fields.
 */

class ogm_mobile_handler_field_primary_term_tid_clone extends views_handler_field {

  function option_definition() {
    $options = parent::option_definition();

    $options['filepath'] = array('default' => '');
    $options['imagecache_preset'] = array('default' => '');
    $options['link_to_taxonomy'] = array('default' => FALSE);

    return $options;
  }

  /**
   * Provide "link to term" option.
   */
  function options_form(&$form, &$form_state) {
    parent::options_form($form, $form_state);

    $form['tid'] = array(
      '#title' => t('Return just tid, ignore other options'),
      '#type' => 'checkbox',
      '#default_value' => !empty($this->options['tid']),
    );

    $form['filepath'] = array(
      '#title' => t('Return just the filepath for the image'),
      '#type' => 'checkbox',
      '#default_value' => !empty($this->options['filepath']),
    );

    $form['link_to_taxonomy'] = array(
      '#title' => t('Link this image to its term page'),
      '#type' => 'checkbox',
      '#default_value' => !empty($this->options['link_to_taxonomy']),
    );

    // If ImageCache module is found, add its presets as available options
    // for how to display the image.
    if (module_exists('imagecache')) {
      $raw_presets = imagecache_presets();
      $presets[''] = t('Default');
      foreach ($raw_presets as $preset_id => $preset_info) {
        $preset = $preset_info['presetname'];
        $presets[$preset] = $preset;
      }
      $form['imagecache_preset'] = array(
        '#type' => 'select',
        '#title' => t('ImageCache preset'),
        '#options' => $presets,
        '#default_value' => $this->options['imagecache_preset'],
      );
    }
  }

  function render($values) {
    $image = '';
    $tid = $values->{$this->field_alias};
    if (!$tid) {
      return;
    }

    // Render just the ID
    if ($this->options['tid']) {
      return $tid;
    }
    // Render url
    if ($this->options['filepath']) {
      // If imagecache is set, use it in the filepath.
        if ($this->options['imagecache_preset']) {
          $image_data = taxonomy_image_get_object($tid);
          $image = imagecache_create_url('api_icon', 'taxonomy_image/' . $image_data->path);  
        }
        else {
          $image = taxonomy_image_get_url($tid);
        }
    }
    // Render image. If ImageCache preset is specified, use it.
    else if ($this->options['imagecache_preset']) {
      $image = taxonomy_image_display($tid, NULL, $this->options['imagecache_preset']);
    }
    else {
      $image = taxonomy_image_display($tid);
    }

    // Output image as a link, if option is set.
    if ($this->options['link_to_taxonomy']) {
      $image = l($image, drupal_get_path_alias(taxonomy_term_path(taxonomy_get_term($tid))), array('html' => TRUE));
    }

    return $image;
  }
}
