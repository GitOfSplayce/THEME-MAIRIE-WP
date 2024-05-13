<?php
/**
 * The template for displaying comments
 */
if ( post_password_required() ) {
	return;
}
?>



<div id="comments" class="p-border">

<?php if ( have_comments() ) : ?>
    		<h3 id="comments-title" class="p-border">
			<?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				printf( esc_attr(_x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'citygov' )), get_the_title() );
			} else {
				printf(
					esc_attr(_nx(
						'%1$s Reply to &ldquo;%2$s&rdquo;',
						'%1$s Replies to &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'citygov'
					)),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}
			?>
            </h3>
            
            <div class="hrline"></div>

			<ol class="commentlist">
				<?php
					wp_list_comments('avatar_size=54');
				?>
			</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :  ?>
			<div class="navigation">
				<div class="nav-previous fl"><?php previous_comments_link( esc_html__( 'Older Comments','citygov' ) ); ?></div>
				<div class="nav-next fr"><?php next_comments_link( esc_html__( 'Newer Comments','citygov' ) ); ?></div>
			</div><!-- .navigation -->
<?php endif;  ?>

<?php else : 
	if ( ! comments_open() ) :
?>
	<p class="nocomments"><?php esc_html_e( 'Comments are closed.','citygov' ); ?></p>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php comment_form(); ?>

</div><!-- #comments -->
