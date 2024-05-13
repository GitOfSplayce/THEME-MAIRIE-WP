<div class="tab-post p-border">

	<?php if ( has_post_thumbnail()) : ?>
    
        <div class="imgwrap">
        
            <?php the_post_thumbnail( 'thumbnail',array('class' => "grayscale grayscale-fade")); ?>
        
        </div>
         
    <?php endif; ?>
        
    <h4><a href="<?php citygov_permalink(); ?>"><?php the_title(); ?></a></h4>
    
	<?php citygov_meta_date();  ?>

</div>