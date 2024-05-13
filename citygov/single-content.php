<div <?php post_class('item normal tranz '); ?>>
    
    <div class="item_inn tranz p-border">
            
        <?php citygov_meta_full(); ?>
                             
        <div class="entry" itemprop="text">
              
            <?php 
            
                the_content(); 
            
            ?>
            
            <div class="clearfix"></div>
            
        </div><!-- end .entry -->
        
        <div class="clearfix"></div>
        
            <?php 
                    
				echo '<div class="post-pagination">';
				wp_link_pages( array( 'before' => '<div class="page-link">', 'after' => '</div>',
				'link_before' => '<span>', 'link_after' => '</span>', ) );
				wp_link_pages(array(
					'before' => '<p>',
					'after' => '</p>',
					'next_or_number' => 'next_and_number', # activate parameter overloading
					'nextpagelink' => esc_html__('Next','citygov'),
					'previouspagelink' => esc_html__('Previous','citygov'),
					'pagelink' => '%',
					'echo' => 1 )
				);
				echo '</div>';
            
                get_template_part('/single-info');
                
                comments_template(); 
                
            ?>
        
	</div><!-- end .item_inn -->
      
</div>