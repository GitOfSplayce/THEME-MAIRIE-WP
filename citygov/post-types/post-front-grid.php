<div <?php post_class('item grid_post tranz p-border'); ?>> 

	<?php if ( has_post_thumbnail()) : ?>
    
        <div class="imgwrap">
            
              <?php the_post_thumbnail( 'citygov_classic',array('class' => "grayscale grayscale-fade")); ?>
        
        </div>
         
    <?php endif; ?>
        
    <h3><a href="<?php citygov_permalink(); ?>"><?php the_title(); ?></a></h3>
    
	<?php citygov_meta_front();  ?>
    
    <p class="teaser"><?php echo citygov_excerpt( get_the_excerpt(), '140'); ?><span class="helip">...</span><br><?php citygov_meta_more();  ?></p>

</div>