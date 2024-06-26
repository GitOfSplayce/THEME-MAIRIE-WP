<?php get_header();
$themnific_redux = get_option( 'themnific_redux' );?>
	
<div class="page-header">

	<?php if(empty($themnific_redux['tmnf-header-image']['url'])) {} else { ?>
        
            <img class="page-header-img" src="<?php echo esc_url($themnific_redux['tmnf-header-image']['url']);?>" alt="<?php the_title_attribute(); ?>"/>
            
    <?php }  ?>
      
    <div class="container">
            
        <h1 class="archiv"><span class="maintitle"><?php echo esc_attr($s); ?></span>
        <span class="subtitle"><?php esc_html_e('Search Results','citygov');?> </span></h1>
    
    </div>
  
</div>

<div id="core">
    
    <div class="container container_alt">
    
    	<div id="content_start" class="tmnf_anchor"></div>
    
        <div id="content" class="eightcol first">
                
              <div class="blogger">
              
					<?php if (have_posts()) : ?>
                                        
                    <?php while (have_posts()) : the_post();
				  
                  		get_template_part('/post-types/post-classic');
                            
                    endwhile; ?><!-- end post -->
                    
                    <div class="clearfix"></div>
              
              </div><!-- end latest posts section-->
      
              <div class="clearfix"></div>
    
                        <div class="pagination"><?php the_posts_pagination(); ?></div>
    
                        <?php else : ?>
    
                                <div class="errorentry entry">
                    
                                    <h1 class="post entry-title" itemprop="headline"><?php esc_html_e('Oops! Nothing found here','citygov');?></h1>
                                
                                    <h5><?php esc_html_e('Take a moment and do a search below','citygov');?></h5>
	
									<?php get_search_form();?>
                                
                                </div>
                            
                            
                            </div><!-- end latest posts section-->
                            
                            
                        <?php endif; ?>               
        
            </div><!-- end #content -->
            
            <?php get_sidebar(); ?>
            
            <div class="clearfix"></div>
            
    </div><!-- end .container -->
        
    
</div><!-- end #core -->

<div class="clearfix"></div>

<?php get_footer(); ?>