<?php

/**
 * @file
 * Coordinates field handler.
 */

class location_views_handler_field_coordinates extends location_views_handler_field_latitude {

  function construct() {
    parent::construct();
    $this->additional_fields['longitude'] = 'longitude';
  }

  function render($values) {
    if ($this->options['style'] == 'dms') {
      return theme('location_latitude_dms', $values->{$this->field_alias}) .', '. theme('location_longitude_dms', $values->{$this->aliases['longitude']});
    }
    //begin patch by greenmap opengreenmap openflows mark libkuman
    elseif ($this->options['style'] == 'kml') {
      return check_plain($values->{$this->aliases['longitude']}) .', '. check_plain($values->{$this->field_alias});
    }
    //end patch by greenmap opengreenmap openflows mark libkuman
    else {
      return check_plain($values->{$this->field_alias}) .', '. check_plain($values->{$this->aliases['longitude']});
    }
  }

}
