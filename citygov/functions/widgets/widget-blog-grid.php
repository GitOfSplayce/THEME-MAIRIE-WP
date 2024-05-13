<?php
add_action('widgets_init', 'citygov_blog_grid');

function citygov_blog_grid()
{
	register_widget('citygov_blog_grid');
}

class citygov_blog_grid extends WP_Widget {
	
	public function __construct() {
		$widget_ops = array('classname' => 'citygov_blog_grid', 'description' => esc_html__('!!Posts block for Elementor only!!','citygov'));
       	parent::__construct(false, esc_html__('Themnific: Blog Grid','citygov'),$widget_ops);  
	}
	
	function widget($args, $instance)
	{
		extract($args);
		
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$post_type = 'all';
		$layout = isset( $instance['layout'] ) ? esc_attr( $instance['layout'] ) : '';
		$categories = isset( $instance['categories'] ) ? esc_attr( $instance['categories'] ) : '';
		$posts = isset( $instance['posts'] ) ? esc_attr( $instance['posts'] ) : '';
		$offset_posts = isset( $instance['offset_posts'] ) ? esc_attr( $instance['offset_posts'] ) : '';
		$tags_selection = isset( $instance['tags_selection'] ) ? esc_attr( $instance['tags_selection'] ) : '';
		
		echo wp_kses_post($before_widget);
		?>
		
		<?php
		$post_types = get_post_types();
		unset($post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item']);
		
		if($post_type == 'all') {
			$post_type_array = $post_types;
		} else {
			$post_type_array = $post_type;
		}
		?>
		
        	<?php if ( $title == "") {} else { ?>
        
				<h3 class="widget content_widget"><span><a href="<?php echo get_category_link($categories); ?>"><?php echo esc_attr($title); ?></a></span></h3>
			
            <?php } ?>
            
			<?php
			$recent_posts = new WP_Query(array(
				'showposts' => $posts,
				'ignore_sticky_posts' => 1,
				'cat' => $categories,
				'offset' => esc_attr($offset_posts),
				'post_status' => 'publish',
				'tag' => esc_attr($tags_selection)
			));
			?>
            <div class="grid_blogger <?php echo esc_attr($layout); ?>">
			<?php  while($recent_posts->have_posts()): $recent_posts->the_post();if(has_post_format('aside')){ } elseif(has_post_format('quote')){ }else { ?>

                            <?php if(has_post_format('aside')){} else {
								get_template_part('/post-types/post-front-grid');
                            }?>

			<?php } endwhile;wp_reset_postdata(); ?>
			</div>
			<div class="clearfix"></div>
		
		<?php
		echo wp_kses_post($after_widget);
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['post_type'] = 'all';
		$instance['layout'] = $new_instance['layout'];
		$instance['categories'] = $new_instance['categories'];
		$instance['posts'] = sanitize_text_field($new_instance['posts']);
		$instance['offset_posts'] = sanitize_text_field($new_instance['offset_posts']);
		$instance['tags_selection'] = sanitize_text_field($new_instance['tags_selection']);
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Recent Posts', 'post_type' => 'all', 'layout' => 'tmnf_columns_3','categories' => 'all', 'posts' => 4, 'offset_posts' => '','tags_selection' => '');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title (optional)','citygov'); ?></label>
			<input class="widefat" style="width: 100%;" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('categories')); ?>"><?php esc_html_e('Filter by Category','citygov'); ?></label> 
			<select id="<?php echo esc_attr($this->get_field_id('categories')); ?>" name="<?php echo esc_attr($this->get_field_name('categories')); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>all categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo esc_attr($category->term_id); ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo esc_attr($category->cat_name); ?></option>
				<?php } ?>
			</select>
		</p>
        
        <p>
			<label for="<?php echo esc_attr($this->get_field_id('layout')); ?>"><?php esc_html_e('Layout','citygov'); ?>: </label>
			<select id="<?php echo esc_attr($this->get_field_id('layout')); ?>" name="<?php echo esc_attr($this->get_field_name('layout')); ?>" class="widefat">
				<?php 
				$layout_options = apply_filters('em_widget_order_ddm', array(
					'tmnf_columns_4' => esc_html__('4 Columns','citygov'),
					'tmnf_columns_3' => esc_html__('3 Columns','citygov'),
					'tmnf_columns_2' => esc_html__('2 Columns','citygov'),
					'tmnf_columns_1' => esc_html__('1 Columns','citygov')
				)); 
				?>
				<?php foreach( $layout_options as $key => $value) : ?>   
	 			<option value='<?php echo esc_attr($key); ?>' <?php echo esc_attr($key == $instance['layout']) ? "selected='selected'" : ''; ?>>
	 				<?php echo esc_html($value); ?>
	 			</option>
				<?php endforeach; ?>
			</select>
        </p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('posts')); ?>"><?php esc_html_e('Number of posts','citygov'); ?></label>
			<input class="widefat" style="width: 40px;" id="<?php echo esc_attr($this->get_field_id('posts')); ?>" name="<?php echo esc_attr($this->get_field_name('posts')); ?>" value="<?php echo esc_attr($instance['posts']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('offset_posts')); ?>"><?php esc_html_e('Offset posts','citygov'); ?></label>
			<input class="widefat" style="width: 40px;" id="<?php echo esc_attr($this->get_field_id('offset_posts')); ?>" name="<?php echo esc_attr($this->get_field_name('offset_posts')); ?>" value="<?php echo esc_attr($instance['offset_posts']); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('tags_selection')); ?>"><?php esc_html_e('Filter by a tag (write tags separated by commas)','citygov'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('tags_selection')); ?>" name="<?php echo esc_attr($this->get_field_name('tags_selection')); ?>" value="<?php echo esc_attr($instance['tags_selection']); ?>" />
		</p>
		

	<?php }
}
?>