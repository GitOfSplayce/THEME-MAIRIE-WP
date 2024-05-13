<?php
/*
Template Name: Builder (with breadcrumbs)
Template Post Type: post, page, event
*/
?>
<?php get_header(); ?>

<div class="page-header">

    <?php if ( has_post_thumbnail()){
		
		the_post_thumbnail('citygov_header',array('class' => 'standard grayscale grayscale-fade'));
    
    } else { 
    
    	if(empty($themnific_redux['tmnf-header-image']['url'])) {} else { ?>
            
                <img class="page-header-img" src="<?php echo esc_url($themnific_redux['tmnf-header-image']['url']);?>" alt="<?php the_title_attribute(); ?>"/>
                
        <?php } 
        
    } ?>
    
    <div class="container">

    	<div class="main-breadcrumbs">
        
        	<?php citygov_breadcrumbs()?>
            
        </div>

        <h1 itemprop="headline" class="entry-title"><?php the_title(); ?></h1>
    
    </div>
        
</div>
                
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <div id="content_start" class="tmnf_anchor"></div>

	<?php the_content();  ?>

<?php endwhile; endif; ?>
    
<div class="clearfix"></div>
    
<?php get_footer(); ?>