<?php
if ( function_exists('has_nav_menu') && has_nav_menu('main-menu') ) { 
	wp_nav_menu( array( 
		'depth' => 6,
		'sort_column' => 'menu_order',
		'container' => 'ul',
		'menu_class' => 'nav',
		'menu_id'	=> 'main-nav' ,
		'walker'	=> new Aria_Walker_Nav_Menu(),
		'items_wrap'     => '<ul id="%1$s" class="%2$s" role="menubar">%3$s</ul>',
		'theme_location' => 'main-menu',
	) );
}
?>