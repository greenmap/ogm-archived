<!--comment-wrapper.tpl.php-->
<?php
// $Id: comment-wrapper.tpl.php,v 1.2 2008/09/14 12:12:38 johnalbin Exp $

/**
 * @file comment-wrapper.tpl.php
 * Default theme implementation to wrap comments.
 *
 * Available variables:
 * - $content: All comments for a given page. Also contains sorting controls
 *   and comment forms if the site is configured for it.
 *
 * The following variables are provided for contextual information.
 * - $node: Node object the comments are attached to.
 * The constants below the variables show the possible values and should be
 * used for comparison.
 * - $display_mode
 *   - COMMENT_MODE_FLAT_COLLAPSED
 *   - COMMENT_MODE_FLAT_EXPANDED
 *   - COMMENT_MODE_THREADED_COLLAPSED
 *   - COMMENT_MODE_THREADED_EXPANDED
 * - $display_order
 *   - COMMENT_ORDER_NEWEST_FIRST
 *   - COMMENT_ORDER_OLDEST_FIRST
 * - $comment_controls_state
 *   - COMMENT_CONTROLS_ABOVE
 *   - COMMENT_CONTROLS_BELOW
 *   - COMMENT_CONTROLS_ABOVE_BELOW
 *   - COMMENT_CONTROLS_HIDDEN
 *
 * @see template_preprocess_comment_wrapper()
 * @see theme_comment_wrapper()
 */
$map_overlay_types = array('green_site', 'green_route', 'green_area');

?>
<?php if ($content) { ?>
  <div id="comments">
    <?php if (!in_array($node->type , $map_overlay_types)) { ?>
      <h2 id="comments-title"><?php print t('Comments'); ?></h2>
    <?php } ?>
    <div id="comments-inner">
      <?php print $content; ?>
    </div>
  </div>
<?php } // if($content) ?>
<!--/comment-wrapper.tpl.php-->
