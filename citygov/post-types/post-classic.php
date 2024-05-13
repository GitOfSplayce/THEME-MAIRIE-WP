          	<div <?php post_class('item tranz'); ?>>               	
			
				<?php if ( has_post_thumbnail()) : ?>
                
                    <div class="imgwrap">
                        
                          <?php the_post_thumbnail( 'citygov_small',array('class' => "grayscale grayscale-fade")); ?>
                    
                    </div>
                     
                <?php endif; ?>
                    
                <h2><a href="<?php citygov_permalink(); ?>"><?php the_title(); ?></a></h3>
                
                <?php citygov_meta_full();  ?>
                
                <p class="teaser"><?php echo citygov_excerpt( get_the_excerpt(), '110'); ?><span class="helip">...</span><?php citygov_meta_more();  ?></p>
        
            </div>