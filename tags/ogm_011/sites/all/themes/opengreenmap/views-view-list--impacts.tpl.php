<!--views-view-list-impacts.tpl.php-->
<?php
// $Id: views-view-list.tpl.php,v 1.3 2008/09/30 19:47:11 merlinofchaos Exp $
/**
 * @file views-view-list.tpl.php
 * Default simple view template to display a list of rows.
 *
 * - $title : The title of this group of rows.  May be empty.
 * @ingroup views_templates
 */
?>
<div class="item-list">
  <?php foreach ($rows as $id => $row): ?>
    <div class="<?php print $classes[$id] ." ". $zebra; ?>"><?php print $row; ?></div>
  <?php endforeach; ?>
</div>
<!--/views-view-list-impacts.tpl.php-->
