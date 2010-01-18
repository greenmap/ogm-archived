<?php
// $Id: node.tpl.php,v 1.4 2008/09/15 08:11:49 johnalbin Exp $

/**
 * @file node.tpl.php
 *
 * Theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: Node body or teaser depending on $teaser flag.
 * - $picture: The authors picture of the node output from
 *   theme_user_picture().
 * - $date: Formatted creation date (use $created to reformat with
 *   format_date()).
 * - $links: Themed links like "Read more", "Add new comment", etc. output
 *   from theme_links().
 * - $name: Themed username of node author output from theme_user().
 * - $node_url: Direct url of the current node.
 * - $terms: the themed list of taxonomy term links output from theme_links().
 * - $submitted: themed submission information output from
 *   theme_node_submitted().
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $teaser: Flag for the teaser state.
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 */
 
$primary_term_tid = $node->primary_term->tid;
$primary_icon = taxonomy_image_display($primary_term_tid);

// get secondary icons
$secondary_icons = '';
foreach ($node->taxonomy as $tid => $tax) {
  if ($tid != $primary_term_tid) {
    // @todo move this to a theme function
    $secondary_icon = taxonomy_image_display($tid);
    $secondary_icons .= $secondary_icon;
  }
} 

// phone
if ($node->field_phone[0]['value']) {
  $phone = '<a href="tel:' . check_plain($node->field_phone[0]['value']) . '">' . check_plain($node->field_phone[0]['value']) . '</a>';
}

// address
$address = '';
if ($node->locations[0]['street']) {
  $address = check_plain($node->locations[0]['street']) . '<br />';
}
if ($node->locations[0]['city']) {
  $address .= check_plain($node->locations[0]['city']) . ', ';
}
if ($node->locations[0]['province']) {
  $address .= check_plain($node->locations[0]['province']) . ', ';
}
if ($node->locations[0]['postal_code']) {
  $address .= check_plain($node->locations[0]['postal_code']);
}
if ($address) {
  $address = l($address, 'http://maps.google.com/maps?q=' . $node->locations[0]['street'] . ',' . $node->locations[0]['city'] . ',' . $node->locations[0]['province_name'] . ',' . $node->locations[0]['postal_code'] .',' . $node->locations[0]['country_name'] . '&ll=' . $node->locations[0]['latitude'] . ',' . $node->locations[0]['longitude'], array('absolute' => TRUE, 'html' => TRUE));
}

// description
if ($node->field_details[0]['value']) {
  $description_full = check_plain($node->field_details[0]['value']);
  $description_short = truncate_utf8($description_full, 200, TRUE);
  $description = $description_short . ' ' . t('read more'); // @todo - link all this to another page with full details and other misc data including accessibility icons
}

// comment - Take either the most recent comment, or the most recent impact
// @todo - this is horrible - embed a view instead
$comment = '';
$comment = comment_render($node->nid);
if ($comment) {
  $comment = truncate_utf8($comment, 200) . ' ' . t('read more');  // @todo link this to another page with all comments
} else {
  $comment = t('Be the first to comment'); // @todo link
}

// multimedia - Take the most recent photo, or video
$multimedia = '';
if ($node->field_image[0]['view']) {
  $multimedia = theme('emimage_image', 'field_image', $node->field_image[0], 'image_thumbnail', $node, $node->field_image[0]['value'], '', '', $title = '', $link = NULL);
}
//if (!$multimedia) { $multimedia = $node->field_video[0]['view']; }
?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>"><div class="node-inner">

  <div class="title-icons">
    <div class="icons">
      <?php print $primary_icon . $secondary_icons; ?>
    </div>
    <h2 class="title">
      <?php print $title; ?>
    </h2>
  </div>
  
  <div class="details">
    <div class="contact">
      <span class="phone">
        <?php print $phone; ?>
      </span>
      <span class="address">
        <?php print $address; ?>
      </span>
    </div>
    <div class="description">
      <?php print $description; ?>
    </div>
  </div>
  
  <div class="openviews">
    <h3><?php print t('Open Views'); ?></h3>
    <div>
      <div class="rating-comment">
        <?php print fivestar_static('node', $node->nid,'vote', $node->type); // @todo - add back the necessary css ?>
        <?php print $comment; ?>
      </div>
      <div class="multimedia">
        <?php print $multimedia; ?>
      </div>
    </div>
  </div>

  <?php print $links; ?>

</div></div> <!-- /node-inner, /node -->
