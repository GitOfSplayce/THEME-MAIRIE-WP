<div id="post-nav" class="p-border">
    <?php $prevPost = get_previous_post(false);// false = all categories
        if($prevPost) {
            $args = array(
                'posts_per_page' => 1,
                'include' => $prevPost->ID
            );
            $prevPost = get_posts($args);
            foreach ($prevPost as $post) {
                setup_postdata($post);
    ?>
        <div class="post-previous tranz p-border">
            <a class="post-nav-image" href="<?php citygov_permalink(); ?>"><?php the_post_thumbnail('thumbnail',array('class' => "grayscale grayscale-fade")); ?><span class="arrow"><i class="fa fa-chevron-left"></i>
</span></a>
            <a class="post-nav-text" href="<?php citygov_permalink(); ?>"><span><?php esc_html_e('Previous','citygov');?>:</span><br/> <?php the_title(); ?></a>
        </div>
    <?php
                wp_reset_postdata();
            } //end foreach
        } // end if
         
        $nextPost = get_next_post(false);// false = all categories
        if($nextPost) {
            $args = array(
                'posts_per_page' => 1,
                'include' => $nextPost->ID
            );
            $nextPost = get_posts($args);
            foreach ($nextPost as $post) {
                setup_postdata($post);
    ?>
        <div class="post-next tranz p-border">
            <a class="post-nav-image" href="<?php citygov_permalink(); ?>"><?php the_post_thumbnail('thumbnail',array('class' => "grayscale grayscale-fade")); ?><span class="arrow"><i class="fa fa-chevron-right"></i>
</span></a>
            <a class="post-nav-text" href="<?php citygov_permalink(); ?>"><span><?php esc_html_e('Next','citygov');?>:</span><br/> <?php echo the_title(); ?></a>
        </div>
    <?php
                wp_reset_postdata();
            } //end foreach
        } // end if
    ?>
</div>