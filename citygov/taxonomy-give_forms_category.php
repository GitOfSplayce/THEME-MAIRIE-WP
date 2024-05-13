
<?php get_header(); ?>

<div class="page-header">

    <?php the_post_thumbnail('citygov_header',array('class' => 'standard grayscale grayscale-fade'));?>
    
    <div class="container">

        <h1 itemprop="name" class="give-form-title entry-title"><?php single_tag_title(); ?></h1>
    
    </div>
        
</div>

<div id="core" class="container_alt page tmnf-donations-page">
	<?php
    if ( have_posts() ) : ?>
    
        <?php
        do_action('my-give-before-archive-loop');
        while ( have_posts() ) : the_post();?>
            <div <?php post_class('give-archive-item'); ?>>
                
                <div class="image-wrap">
                    <?php the_post_thumbnail('citygov_small',array('class' => 'standard grayscale grayscale-fade')); ?>
                </div>
                
                <div class="item_inn p-border">
                
					<?php 
                        $id = get_the_ID();
                        $shortcode = '[give_goal id="' . $id . '"]'; echo do_shortcode( $shortcode );
                    ?>
                
                    <h2 class="give-form-title">
                        <a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                    </h2>
        
                    <p class="teaser"><?php the_excerpt(); ?></p>
                    
                    <a class="mainbutton" href="<?php echo get_the_permalink(); ?>"><?php esc_html_e('Donate Now','citygov');?></a>
                    
                    <div class="clearfix"></div>
                
                </div>
    
            </div>
        <?php endwhile;
    else : ?>
    
        <h2><?php esc_html_e('Sorry, no donation forms found.','citygov');?></h2>
    
    <?php endif;
    wp_reset_postdata();
    do_action('my-give-after-archive-loop');
    ?>


</div><!-- end .container -->
    
<div class="clearfix"></div>
    
<?php get_footer(); ?>