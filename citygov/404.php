<?php get_header(); 
$themnific_redux = get_option( 'themnific_redux' );?>
	
<div class="page-header">

	<?php if(empty($themnific_redux['tmnf-header-image']['url'])) {} else { ?>
        
            <img class="page-header-img" src="<?php echo esc_url($themnific_redux['tmnf-header-image']['url']);?>" alt="<?php the_title_attribute(); ?>"/>
            
    <?php }  ?>
      
    <div class="container">
        
        <div class="error-titles cntr">
        
            <h1 class="entry-title"><?php esc_html_e('404 • Page not found ','citygov');?></h1>
        
            <p>&nbsp;
            <?php esc_html_e('Oops! The page you are looking for does not exist. It might have been moved or deleted. ','citygov');?></p>
            
            	<p>&nbsp;
            	<?php esc_html_e('Try a search below...','citygov');?></p>
                    
                <div class="cntr error-search"><?php get_search_form();?></div>

<div class="clearfix"></div>
            
        
        </div>
    
    </div>
    
</div>

</div>
    
<?php get_footer(); ?>