<?php get_header();
$themnific_redux = get_option( 'themnific_redux' );?>
	
	<div class="page-header">

		<?php if(empty($themnific_redux['tmnf-header-image']['url'])) {} else { ?>
            
                <img class="page-header-img" src="<?php echo esc_url($themnific_redux['tmnf-header-image']['url']);?>" alt="<?php the_title_attribute(); ?>"/>
                
        <?php }  ?>
          
        <div class="container">
    
            <h1 itemprop="headline" class="entry-title"><?php esc_html_e('Shop','citygov');?></h1>
        
        </div>
          
     </div>

<div class="container_alt <?php if ( is_active_sidebar( 'tmnf-shop-sidebar' ) ) {echo 'tmnf-sidebar-shop-active ';} else { echo 'postbarNone-shop ';}; ?>">

	<div id="woo-site" class="post-wrapper postbarLeft">

         <div id="content" class="eightcol first">
         
            <div id="woo-inn" class="">
        
                <?php woocommerce_content(); ?>
                
            </div>    
    
        </div><!-- #content -->
        
        <div id="sidebar"  class="fourcol woocommerce">
        
            <?php if ( is_active_sidebar( 'tmnf-shop-sidebar' ) ) { ?>
            
                <div class="widgetable p-border">
                
                    <div class="sidewrap">
        
                    <?php dynamic_sidebar('tmnf-shop-sidebar') ?>
                    
                    </div>
                
                </div>
            
            <?php } ?>
               
        </div><!-- #sidebar -->
    
	</div><!-- .post-wrapper  -->
    
</div>

<?php get_footer(); ?>