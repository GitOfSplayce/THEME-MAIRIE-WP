<div <?php post_class('item front_post tranz p-border'); ?>> 

	<?php if ( has_post_thumbnail()) : ?>
    
        <div class="imgwrap">
            
              <?php the_post_thumbnail( 'thumbnail',array('class' => "grayscale grayscale-fade")); ?>
        
        </div>
         
    <?php endif; ?>
        
    <h3><a href="<?php citygov_permalink(); ?>"><?php the_title(); ?></a></h3>
    
	<?php citygov_meta_front();  ?>
    
    <p class="teaser"><?php echo citygov_excerpt( get_the_excerpt(), '140'); ?><span class="helip">...</span><?php citygov_meta_more();  ?></p>

</div>