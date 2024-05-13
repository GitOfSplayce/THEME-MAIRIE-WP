<?php
if ( function_exists('has_nav_menu') && has_nav_menu('add-menu') ) { 
	wp_nav_menu( array( 'depth' => 1, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_class' => 'nav tranz', 'menu_id' => 'add-nav' , 'theme_location' => 'add-menu',) );
} ?>