<!--comment.tpl.php-->
<div class="comment <?php print $comment_classes ; ?>"><div class="comment-inner">
  
  <?php if ($unpublished) : ?>
    <div class="unpublished"><?php print t('Unpublished'); ?></div>
  <?php endif; ?> 
  
  
  <span class="content">
    <?php print $content; ?>
  </span>
  -
  <span class="submitted">
    <?php
    $commenter = $comment->name ? $comment->name : t('Anonymous');
    
    ?>
    <?php print $commenter; ?> 
  </span>
  
  <?php if ($links): ?>
    <div class="links">
      <?php print $links; ?>
    </div>
  <?php endif; ?> 
  
  
  
  <?php if (!empty($new)): ?>
    <div class="new"><?php print $new; ?></div>
  <?php endif; ?>



  <?php if ($picture) print $picture; ?>


</div></div> <!-- /comment-inner, /comment -->
<!--/comment.tpl.php-->
