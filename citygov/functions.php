<?php

/*-----------------------------------------------------------------------------------
- Default
----------------------------------------------------------------------------------- */

add_action( 'after_setup_theme', 'citygov_theme_setup' );

function citygov_theme_setup() {
	global $content_width;

	/* Set the $content_width for things such as video embeds. */
	if ( !isset( $content_width ) )
		$content_width = 750;

	/* Add theme support for automatic feed links. */
	add_theme_support( 'post-formats', array( 'video','audio', 'gallery','quote', 'link', 'aside' ) );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_theme_support( 'responsive-embeds' );
	
	
	/* Add theme support for post thumbnails (featured images). */	
	add_theme_support('post-thumbnails');
	add_image_size('citygov_header', 1500, 650, true ); 	//(cropped)
	add_image_size('citygov_classic', 698, 500, true ); 		//(cropped)
	add_image_size('citygov_small', 350, 250, true ); 		//(cropped)
	

	/* Add custom menus */
	register_nav_menus(array(
		'main-menu' => esc_html__( 'Main Menu','citygov' ),
		'add-menu' => esc_html__( 'Additional Menu','citygov' ),
		'bottom-menu' => esc_html__( 'Footer Menu','citygov' ),
	));

	/* Add your sidebars function to the 'widgets_init' action hook. */
	add_action( 'widgets_init', 'citygov_register_sidebars' );
	
	/* Make theme available for translation */
	load_theme_textdomain('citygov', get_template_directory() . '/lang' );

}

function citygov_register_sidebars() {
	
	register_sidebar(array('name' => esc_html__( 'Sidebar','citygov' ),'id' => 'tmnf-sidebar','description' => esc_html__( 'Sidebar widget section','citygov' ),'before_widget' => '<div class="sidebar_item">','after_widget' => '</div>','before_title' => '<h3 class="widget dekoline">','after_title' => '</h3>'));
	

	//footer widgets
	register_sidebar(array('name' => esc_html__( 'Footer 1','citygov' ),'id' => 'tmnf-footer-1','description' => esc_html__( 'Widget section in footer - left','citygov' ),'before_widget' => '','after_widget' => '','before_title' => '<h3 class="widget dekoline dekoline_small">','after_title' => '</h3>'));
	register_sidebar(array('name' => esc_html__( 'Footer 2','citygov' ),'id' => 'tmnf-footer-2','description' => esc_html__( 'Widget section in footer - center/left','citygov' ),'before_widget' => '','after_widget' => '','before_title' => '<h3 class="widget dekoline dekoline_small">','after_title' => '</h3>'));
	register_sidebar(array('name' => esc_html__( 'Footer 3','citygov' ),'id' => 'tmnf-footer-3','description' => esc_html__( 'Widget section in footer - center/right','citygov' ),'before_widget' => '','after_widget' => '','before_title' => '<h3 class="widget dekoline dekoline_small">','after_title' => '</h3>'));
	register_sidebar(array('name' => esc_html__( 'Footer 4','citygov' ),'id' => 'tmnf-footer-4','description' => esc_html__( 'Widget section in footer - right','citygov' ),'before_widget' => '','after_widget' => '','before_title' => '<h3 class="widget dekoline dekoline_small">','after_title' => '</h3>'));
	
	//woo widgets
	if ( class_exists( 'WooCommerce' ) ) {
		register_sidebar(array('name' => esc_html__( 'Shop Sidebar','citygov' ),'id' => 'tmnf-shop-sidebar','description' => esc_html__( 'Sidebar widget section (displayed on shop pages)','citygov' ),'before_widget' => '<div class="sidebar_item">','after_widget' => '</div>','before_title' => '<h2 class="widget dekoline dekoline_small">','after_title' => '</h2>'));
	}

	//free widget
	register_sidebar(array('name' => esc_html__( 'Free 1','citygov' ),'id' => 'tmnf-sidebar-free-1','description' => esc_html__( 'Free widget section','citygov' ),'before_widget' => '<div class="sidebar_item">','after_widget' => '</div>','before_title' => '<h3 class="widget dekoline dekoline_small">','after_title' => '</h3>'));
	
	register_sidebar(array('name' => esc_html__( 'Free 2','citygov' ),'id' => 'tmnf-sidebar-free-2','description' => esc_html__( 'Free widget section','citygov' ),'before_widget' => '<div class="sidebar_item">','after_widget' => '</div>','before_title' => '<h3 class="widget dekoline dekoline_small">','after_title' => '</h3>'));
	
	register_sidebar(array('name' => esc_html__( 'Free 3','citygov' ),'id' => 'tmnf-sidebar-free-3','description' => esc_html__( 'Free widget section','citygov' ),'before_widget' => '<div class="sidebar_item">','after_widget' => '</div>','before_title' => '<h3 class="widget dekoline dekoline_small">','after_title' => '</h3>'));
	
	register_sidebar(array('name' => esc_html__( 'Free 4','citygov' ),'id' => 'tmnf-sidebar-free-4','description' => esc_html__( 'Free widget section','citygov' ),'before_widget' => '<div class="sidebar_item">','after_widget' => '</div>','before_title' => '<h3 class="widget dekoline dekoline_small">','after_title' => '</h3>'));
	
}

	
/*-----------------------------------------------------------------------------------
- Framework - Please refrain from editing this section 
----------------------------------------------------------------------------------- */


// Set path to Framework and theme specific functions
$functions_path = get_template_directory() . '/functions/';

// Theme specific functionality
require_once ($functions_path . 'admin-functions.php');					// Custom functions and plugins

// Add Redux options panel
if ( !isset( $themnific_redux ) && file_exists( get_template_directory()  . '/redux-framework/redux-themnific.php' ) ) {
    require_once( get_template_directory()  . '/redux-framework/redux-themnific.php' );
}

	
/*-----------------------------------------------------------------------------------
- Enqueues scripts and styles for front end
----------------------------------------------------------------------------------- */ 

function citygov_enqueue_style() {
	
	// Main stylesheet
	wp_enqueue_style( 'citygov-style', get_stylesheet_uri());
	wp_style_add_data( 'citygov-style', 'rtl', 'replace' ); 
	
	// Font Awesome css	
	wp_enqueue_style('fontawesome', get_template_directory_uri() .	'/styles/fontawesome.css');
	
}
add_action( 'wp_enqueue_scripts', 'citygov_enqueue_style' );




// themnific custom css + chnage the order of how the sytlesheets are loaded, and overrides WooCommerce styles.
function citygov_custom_order() {
	
	// place wooCommerce styles before our main stlesheet
	if ( class_exists( 'WooCommerce' ) ) {
		wp_dequeue_style( 'woocommerce_frontend_styles' );
		wp_enqueue_style('woocommerce-frontend-styles', plugins_url() .'/woocommerce/assets/css/woocommerce.css');
	
		wp_enqueue_style('citygov-woo-custom', get_template_directory_uri().	'/styles/woo-custom.css');
		wp_enqueue_style('citygov-mobile', get_template_directory_uri().'/style-mobile.css');
		wp_style_add_data( 'citygov-mobile', 'rtl', 'replace' ); 
	} else {
		wp_enqueue_style('citygov-mobile', get_template_directory_uri().'/style-mobile.css');
		wp_style_add_data( 'citygov-mobile', 'rtl', 'replace' ); 
	}
}
add_action('wp_enqueue_scripts', 'citygov_custom_order');


function citygov_enqueue_script() {	

		// Load Common scripts	
		wp_enqueue_script('citygov-ownscript', get_template_directory_uri() .'/js/ownScript.js',array( 'jquery' ),'', true);
		

		// Singular comment script		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );

}
	
add_action('wp_enqueue_scripts', 'citygov_enqueue_script');

/*-----------------------------------------------------------------------------------
- Include custom widgets
----------------------------------------------------------------------------------- */

include_once (get_template_directory() . '/functions/widgets/widget-social.php');
include_once (get_template_directory() . '/functions/widgets/widget-featured.php');
include_once (get_template_directory() . '/functions/widgets/widget-blog-list.php');
include_once (get_template_directory() . '/functions/widgets/widget-blog-grid.php');


/*-----------------------------------------------------------------------------------
- Include accessible
----------------------------------------------------------------------------------- */

include_once (get_template_directory() . '/functions/aria-walker-nav-menu.php');


/*-----------------------------------------------------------------------------------
- TGM_Plugin_Activation class.
----------------------------------------------------------------------------------- */
require_once get_template_directory()  . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'citygov_register_required_plugins' );
function citygov_register_required_plugins() {

    $plugins = array(
	

        // redux-framework
        array(
            'name'				=> esc_html__( 'Redux Framework','citygov' ),
            'slug'      		=> 'redux-framework',
            'required'  		=> true,
        ),
        // elementor
        array(
            'name'				=> esc_html__( 'Elementor','citygov' ),
            'slug'      		=> 'elementor',
            'required'  		=> true,
        ),            
		// eleslider
        array(
            'name'				=> esc_html__( 'Eleslider','citygov' ),
            'slug'      		=> 'eleslider',
			'source'            => get_template_directory() . '/plugin/eleslider.zip', // The plugin source.
            'required'  		=> true,
        ),     
        // one-click-demo-import
        array(
            'name'				=> esc_html__( 'One Click Demo Import','citygov' ),
            'slug'      		=> 'one-click-demo-import',
            'required'  		=> false,
        ),     
        // events-manager
        array(
            'name'				=> esc_html__( 'Events Manager','citygov' ),
            'slug'      		=> 'events-manager',
            'required'  		=> false,
        ),

    );
    $config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => esc_html__( 'Install Required Plugins','citygov' ),
            'menu_title'                      => esc_html__( 'Install Plugins','citygov' ),
            'installing'                      => esc_html__( 'Installing Plugin: %s','citygov' ), // %s = plugin name.
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.','citygov' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.','This theme requires the following plugins: %1$s.','citygov' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.','This theme recommends the following plugins: %1$s.','citygov' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.','citygov' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.','citygov' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.','citygov' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.','citygov' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.','citygov' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.','citygov' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins','citygov' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins','citygov' ),
            'return'                          => esc_html__( 'Return to Required Plugins Installer','citygov' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.','citygov' ),
            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s','citygov' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}

	
/*-----------------------------------------------------------------------------------
- Other theme functions
----------------------------------------------------------------------------------- */

// icons - font awesome
if ( ! function_exists ( 'citygov_icon' ) ) {
	function citygov_icon() {
		if(has_post_format('audio')) {return '<i title="'. esc_attr__('Audio','citygov').'" class="tmnf_icon fas fa-volume-up"></i>';
		}elseif(has_post_format('gallery')) {return '<i title="'. esc_attr__('Gallery','citygov').'" class="tmnf_icon fas fa-camera"></i>';
		}elseif(has_post_format('image')) {return '<i title="'. esc_attr__('Image','citygov').'" class="tmnf_icon fas fa-camera"></i>';	
		}elseif(has_post_format('link')) {return '<i title="'. esc_attr__('Link','citygov').'" class="tmnf_icon fas fa-link"></i>';			
		}elseif(has_post_format('quote')) {return '<i title="'. esc_attr__('Quote','citygov').'" class="tmnf_icon fas fa-quote-right"></i>';		
		}elseif(has_post_format('video')) {return '<i title="'. esc_attr__('Video','citygov').'" class="tmnf_icon fas fa-play-circle"></i>';
		} 	
	}
}


// link format
function citygov_permalink() {
	$linkformat = get_post_meta(get_the_ID(), 'themnific_linkss', true);
	if($linkformat) echo esc_url($linkformat); else the_permalink();
}




// new excerpt function

// Old Shorten Excerpt text for use in theme
function citygov_excerpt($text, $chars = 1620) {
	$text = $text." ";
	$text = substr($text,0,$chars);
	$text = substr($text,0,strrpos($text,' '));
	$text = $text."";
	return $text;
}

function citygov_trim_excerpt($text) {
     $text = str_replace('[', '', $text);
     $text = str_replace(']', '', $text);
     return $text;
    }
add_filter('get_the_excerpt', 'citygov_trim_excerpt');




// meta sections
if ( ! function_exists ( 'citygov_meta_date' ) ) {
	function citygov_meta_date() { ?>   
		<p class="meta meta_full <?php $themnific_redux = get_option( 'themnific_redux' ); if(isset($themnific_redux['tmnf-post-meta-dis']) ? $themnific_redux['tmnf-post-meta-dis'] : null) echo 'tmnf_hide';?>">
			<span class="post-date"><?php the_time(get_option('date_format')); ?></span>
		</p>
	<?php }
}

if ( ! function_exists ( 'citygov_meta_front' ) ) {
	function citygov_meta_front() { ?>    
		<p class="meta <?php $themnific_redux = get_option( 'themnific_redux' ); if(isset($themnific_redux['tmnf-post-meta-dis']) ? $themnific_redux['tmnf-post-meta-dis'] : null) echo 'tmnf_hide';?>">
			<span class="post-date"><?php the_time(get_option('date_format')); ?><span class="divider">|</span></span>
			<span class="categs"><?php the_category(', ') ?></span>
		</p>
	<?php
	}
}

if ( ! function_exists ( 'citygov_meta_full' ) ) {
	function citygov_meta_full() { ?>    
		<p class="meta meta_full <?php $themnific_redux = get_option( 'themnific_redux' ); if(isset($themnific_redux['tmnf-post-meta-dis']) ? $themnific_redux['tmnf-post-meta-dis'] : null) echo 'tmnf_hide';?>">
			<span class="post-date"><?php the_time(get_option('date_format')); ?><span class="divider">|</span></span>
			<span class="categs"><?php the_category(', ') ?><span class="divider">|</span></span>
			<?php 
			echo '<span class="author">'; the_author_posts_link();echo '</span>';
			?>
		</p>
	<?php
	}
}

if ( ! function_exists ( 'citygov_meta_more' ) ) {
	function citygov_meta_more() { ?>   
		<a class="read_more" href="<?php citygov_permalink() ?>"><?php esc_html_e('Read More','citygov');?> <span class="read_more_arrow">&rarr;</span> <span class="screen-reader-text"><?php the_title_attribute(); ?></span></a>
	<?php }
}



// menu description
function citygov_nav_description( $item_output, $item, $depth, $args ) {
    if ( !empty( $item->description ) ) {
        $item_output = str_replace( $args->link_after . '</a>', '<span class="menu-item-description">' . $item->description . '</span>' . $args->link_after . '</a>', $item_output );
    }
 
    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'citygov_nav_description', 10, 4 );

//Breadcrumbs
if ( ! function_exists ( 'citygov_breadcrumbs' ) ) {
	function citygov_breadcrumbs() {
		if (!is_home()) {
			echo '<span class="crumb"><a href="'. esc_url(home_url('/')).'">';
			echo esc_html__('Home','citygov');
			echo "</a></span>
	 ";
			if ('wpm_project' == get_post_type()) {
			echo '<span class="crumb">';
				$themnific_redux = get_option( 'themnific_redux' );
				if(empty($themnific_redux['tmnf-project-url'])) {echo esc_html__('Projects','citygov');} else {
					echo '<a href="'. esc_url($themnific_redux['tmnf-project-url']).'">';
					echo esc_html__('Projects','citygov');
					echo '</a>';
				}
			echo '</span>';
			}
			if ('event' == get_post_type()) {
			echo '<span class="crumb">';
				$themnific_redux = get_option( 'themnific_redux' );
				if(empty($themnific_redux['tmnf-events-url'])) {echo esc_html__('Events','citygov');} else {
					echo '<a href="'. esc_url($themnific_redux['tmnf-events-url']).'">';
					echo esc_html__('Events','citygov');
					echo '</a>';
				}
			echo '</span>';
			}
			if (is_category() || is_single()) {
				echo '<span class="crumb">'; the_category(', '); echo '</span>';
				if (is_single()) {
					echo '<span class="crumb">';
					echo the_title().'</span>';
				}
		} elseif (is_page()) {
			global $post;
			if($post->post_parent){
				echo '<span class="crumb"> <a href="'. get_permalink( $post->post_parent ) .'">';
				echo get_the_title($post->post_parent).'</a></span><span class="crumb">';
				echo the_title().'</span>';
			} else {
				echo '<span class="crumb">';
				echo the_title();
				echo '</span>';
			}
		} 
		}
	}
}


// span to default widgets
function citygov_cat_count_span($links) {
  $links = str_replace('</a> (', '</a> <span class="cat_nr">', $links);
  $links = str_replace(')', '</span>', $links);
  return $links;
}
add_filter('wp_list_categories', 'citygov_cat_count_span');



function citygov_archive_count($links) {
    $links = str_replace('</a>&nbsp;(', '</a> <span class="cat_nr">', $links);
    $links = str_replace(')', '</span>', $links);
    return $links;
}
add_filter('get_archives_link', 'citygov_archive_count');

// overrride plugin's thumbnail

if ( class_exists( 'Eleslider' ) ) {
		add_image_size('ele_slider', 1920, 900, true );		//(cropped)
}

// remove default styling Events Manager
add_filter('em_get_template_classes', '__return_empty_array');


// remove SVG from header
remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

?>