<!--node-green_map.tpl.php-->
<div id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?> <?php print $node_classes ?> clear-block">

<?php if($node->og_private == 1){ drupal_set_message(t('This map is private and can only be seen by members of the mapmaking team')) ; } ?>

<?php if ($page == 0): ?>
  <h2><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
<?php endif; ?>

  <div class="content">
    <?php print $content ?>
  </div>

<?php
  if ($links) {
    print $links;
  }
?>
</div>
<!--/node-green_map.tpl.php-->
