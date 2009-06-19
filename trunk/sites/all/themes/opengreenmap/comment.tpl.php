<!--comment.tpl.php-->
<div class="comment <?php print $comment_classes; ?>"><div class="comment-inner">
	
  <?php if ($unpublished) : ?>
    <div class="unpublished"><?php print t('Unpublished'); ?></div>
  <?php endif; ?>	
  
  <?php if ($links): ?>
    <div class="links">
      <?php print $links; ?>
    </div>
  <?php endif; ?>	
  
	<span class="submitted">
		<?php print format_date($comment->timestamp, 'custom', 'j M Y'); ?> 
		<?php
		if($comment->homepage){
			$commenter = l($comment->name,$comment->homepage);
		} elseif ($comment->uid > 0) {
			$commenter = l($comment->name, 'user/' . $comment->uid);
		} else {
			$commenter = $comment->name;
		}
		
		?>
		<?php print $commenter; ?> 
		<?php print t('wrote'); ?>: 
	</span>
	
	<span class="content">
		<?php print $content; ?>
	</span>
	
	
  <?php if (!empty($new)): ?>
    <div class="new"><?php print $new; ?></div>
  <?php endif; ?>



  <?php if ($picture) print $picture; ?>


</div></div> <!-- /comment-inner, /comment -->
<!--/comment.tpl.php-->
