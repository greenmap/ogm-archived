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

// Short tags act bad below in the html so we print it here.
print '<?xml version="1.0" encoding="UTF-8"?>';
?>

<?php
print '<kml xmlns="http://www.opengis.net/kml/2.2">';
?>

<Document>
<?php foreach ($themed_rows as $count => $row): ?>
  <Placemark>
<?php foreach ($row as $field => $content):
    $label = $header[$field] ? $header[$field] : $field;
//skip output if the label is "extra"
//this allows for multiple fields to be combined
//via the views interface without printing
//invalid elements to the kml file
    if ($label=="extra") {
   //do nothing
    }else {

    $is_a_point="NO";
    if ($label=="coordinates") {
    	$is_a_point= "YES";
    }
    if ($is_a_point=="YES") {
    	print "<Point>";
    }
    $is_description="NO";
    if ($label=="description") {
    	$is_description="YES";
    }
    print "<". $label .">";
    if ($is_description =="YES") {
    	print "<![CDATA[";
    }
    print $content;
    if ($is_description == "YES") {
    	print "]]>";
    }
    print "</". $label.">";
    if ($is_a_point=="YES") {
    	print "</Point>";
    }
    }
    ?>
<?php endforeach; ?>
  </Placemark>
<?php endforeach; ?>
</Document>
</kml>
