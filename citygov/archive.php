<?php get_header(); 
$themnific_redux = get_option( 'themnific_redux' );?>
	
<div class="page-header">

	<?php if(empty($themnific_redux['tmnf-header-image']['url'])) {} else { ?>
        
            <img class="page-header-img" src="<?php echo esc_url($themnific_redux['tmnf-header-image']['url']);?>" alt="<?php the_title_attribute(); ?>"/>
            
    <?php }  ?>
      
    <div class="container">
    
            <?php if (is_category()) { ?>
    			<h1 class="archiv"><span class="maintitle"><?php single_cat_title(); ?></span>
    			<span class="subtitle"><?php echo strip_tags(category_description()); ?> </span></h1> 
        
            <?php } elseif (is_day()) { ?>
            
    			<h1 class="archiv"><span class="maintitle"><?php the_time( get_option( 'date_format' ) ); ?></span>
    			<span class="subtitle"><?php esc_html_e('Archive','citygov');?></span></h1>  

            <?php } elseif (is_month()) { ?>
            
    			<h1 class="archiv"><span class="maintitle"><?php the_time( 'F, Y' ); ?></span>
    			<span class="subtitle"><?php esc_html_e('Archive','citygov');?></span></h1>  

            <?php } elseif (is_year()) { ?>
            
    			<h1 class="archiv"><span class="maintitle"><?php the_time( 'Y' ); ?></span>
    			<span class="subtitle"><?php esc_html_e('Archive','citygov');?></span></h1>  

            <?php } elseif (is_author()) { ?>
            
    			<h1 class="archiv"><span class="maintitle"><?php  $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); echo esc_attr($curauth->nickname);?></span>
                <span class="subtitle"><?php echo esc_attr($curauth->user_description); ?></span></h1>
                
            <?php } elseif (is_tag()) { ?>
            
    			<h1 class="archiv"><span class="maintitle"><?php echo single_tag_title( '', true); ?></span>
    			<span class="subtitle"><?php esc_html_e('Tag Archive','citygov');?></span></h1>  
            
            <?php } ?>
    
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
                    
                                    <h1 class="post entry-title" itemprop="headline"><?php esc_html_e('Nothing found here','citygov');?></h1>
                                
                                    <h4><?php esc_html_e('Perhaps You will find something interesting from these lists...','citygov');?></h4>
                                
                                    <div class="hrline"></div>
                                
                                    <?php get_template_part('/includes/uni-404-content');?>
                                
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