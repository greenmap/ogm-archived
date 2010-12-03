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
 */ ?>
<script type="text/javascript">
 var updateLayout = function() {
  if (window.innerWidth != currentWidth) {
    currentWidth = window.innerWidth;
    var orient = (currentWidth == 320) ? "profile" : "landscape";
    document.body.setAttribute("orient", orient);
    window.scrollTo(0, 1);
  }
};

iPhone.DomLoad(updateLayout);
setInterval(updateLayout, 500);
</script>
 <?php
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
  $phone = '<a class="phone" href="tel:' . check_plain($node->field_phone[0]['value']) . '"><img class="phoneit" src="/sites/all/themes/iphoneapp/img/phoneit.gif">' . check_plain($node->field_phone[0]['value']) . '</a>';
}

// address
$address = '';
if ($node->locations[0]['street']) {
  $address = '<img class="mapit" src="/sites/all/themes/iphoneapp/img/mapit.gif">';
  $address .= check_plain($node->locations[0]['street']) . '<br />';
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
?>


  <div class="title-icons">

    <div class="icons">
      <?php print $primary_icon . $secondary_icons; ?>
    </div>

  </div>
  
  <div class="details">
    <div class="contact">
      <span class="phone" <?php if (!($address == '')){echo 'style="width:40%"';}?>>
        <?php print $phone; ?>
      </span>
      <span class="address" <?php if (!($phone == '')){echo 'style="width:40%;border-left:1px #999999 solid;"';}?>>
        <?php print $address; ?>
      </span>
      <div class="clear"></div>
    </div>
    <div class="description">
      <?php print $description_full; ?>
    </div>
  </div>
  

  <?php print $links; ?>

