<?php
// $Id: views-bonus-export-xml.tpl.php,v 1.1 2008/10/28 02:18:32 neclimdul Exp $
/**
 * @file views-view-table.tpl.php
 * Template to display a view as a table.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $rows: An array of row items. Each row is an array of content
 *   keyed by field ID.
 * - $header: an array of haeaders(labels) for fields.
 * - $themed_rows: a array of rows with themed fields.
 * @ingroup views_templates
 */

$hostname = 'http://'. check_plain($_SERVER["SERVER_NAME"]). base_path();

// Short tags act bad below in the html so we print it here.
print '<?xml version="1.0" encoding="UTF-8"?'.'>'."\n";
print '<kml xmlns="http://www.opengis.net/kml/2.2">'."\n";

print "<Document>\n";

foreach ($themed_rows as $count => $row) {
  foreach ($row as $field => $content) {
    $label = $header[$field] ? $header[$field] : $field;
    if ($label == "icon") {
      $primary_term = NULL;
      $primary_terms = taxonomy_get_term_by_name($content);
      foreach($primary_terms as $possible_primary_term) {
        if ($possible_primary_term->vid == 1) {
          $primary_term = $possible_primary_term;
        }
      }
      if ($primary_term) {
        $url = $hostname."sites/default/files/kml_icons/".$primary_term->tid.".png";
        print '
<Style id="icon'.$primary_term->tid.'">
  <IconStyle>
    <Icon>
      <href>'.$url.'</href>
    </Icon>
    <hotSpot x="3" y="1" xunits="pixels" yunits="pixels" />
  </IconStyle>
</Style>
';
      }
    }
  }
}

foreach ($themed_rows as $count => $row) {
  print "<Placemark>\n";
  foreach ($row as $field => $content) {
    $label = $header[$field] ? $header[$field] : $field;

    //skip output if the label is "extra"
    //this allows for multiple fields to be combined
    //via the views interface without printing
    //invalid elements to the kml file
    if ($label == "extra") {
     //do nothing
    }
    else {

      if ($label == "icon") {
        $label = 'styleUrl';
        $primary_term = NULL;
        $primary_terms = taxonomy_get_term_by_name($content);
        foreach($primary_terms as $possible_primary_term) {
          if ($possible_primary_term->vid == 1) {
            $primary_term = $possible_primary_term;
          }
        }
        if ($primary_term) {
          $content = "#icon".$primary_term->tid;
        }
      }

      $is_a_point = "NO";
      if ($label == "coordinates") {
        $is_a_point = "YES";
      }
      if ($is_a_point == "YES") {
        print "<Point>";
      }
      $is_description = "NO";
      if ($label == "description") {
        $is_description = "YES";
      }
      print "<". $label .">";
      if ($is_description == "YES") {
        print "<![CDATA[";
      }
      print $content;
      if ($is_description == "YES") {
        print "]]>";
      }
      print "</". $label.">";
      if ($is_a_point == "YES") {
        print "</Point>";
      }
    }
  } // foreach
  print "</Placemark>\n";
} // foreach
print "</Document>\n";
print "</kml>\n";
