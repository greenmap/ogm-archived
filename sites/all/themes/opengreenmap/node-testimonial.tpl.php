<!--node-testimonial.tpl.php-->
<div class="node <?php print $node_classes ?>" id="node-<?php print $node->nid; ?>"><div class="node-inner">
  <?php if($teaser): ?>
  	
	  <div class="content">
	    <?php print $content; ?>
		<?php print '- ' . l($node->title, $node->field_testimonial_link[0]['url'], array('rel' => 'lightframe')); ?>
	  </div>	
	
	
  <?php else: ?>
	  
	  
	  <?php if ($page == 0): ?>
	    <h2 class="title">
	      <a href="<?php print $node_url; ?>"><?php print $title; ?></a>
	    </h2>
	  <?php endif; ?>
	
	  <?php if ($unpublished) : ?>
	    <div class="unpublished"><?php print t('Unpublished'); ?></div>
	  <?php endif; ?>
	
	  <?php if ($picture) print $picture; ?>
	
	  <?php if (count($taxonomy)): ?>
	    <div class="taxonomy"><?php print t('in !categories', array('!categories' => $terms)); ?></div>
	  <?php endif; ?>
	
	  <div class="content">
	    <?php print $content; ?>
	  </div>
	
	  <?php if ($links): ?>
	    <div class="links">
	      <?php print $links; ?>
	    </div>
	  <?php endif; ?>
   <?php endif; ?>
</div></div> <!-- /node-inner, /node -->
<!--/node-testimonial.tpl.php-->
