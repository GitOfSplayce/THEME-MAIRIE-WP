<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head><meta charset="<?php bloginfo( 'charset' ); ?>">

<!-- Set the viewport width to device width for mobile -->
<meta name="viewport" content="width=device-width, initial-scale=1" />

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_head(); ?>

</head>

     
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="site_wrapper <?php $themnific_redux = get_option( 'themnific_redux' ); 
	if (empty($themnific_redux['tmnf-uppercase'])) {} else {if($themnific_redux['tmnf-uppercase'] == '1') echo 'upper '; }
	if (empty($themnific_redux['tmnf-radius-buttons'])) {} else {if($themnific_redux['tmnf-radius-buttons'] == '1') echo 'tmnf_radius_buttons '; }
    if (!empty($themnific_redux['tmnf-container-width']))  {echo esc_attr($themnific_redux['tmnf-container-width']) . ' ';}
	if (empty($themnific_redux['tmnf-bottombar-dis'])) {} else {if($themnific_redux['tmnf-bottombar-dis'] == '1') echo 'bottombar_dis '; }
	if ( is_active_sidebar( 'tmnf-sidebar' ) ) {echo 'tmnf-sidebar-active ';} else { echo 'postbarNone ';};
	if (empty($themnific_redux['tmnf-header-layout'])) {} else {echo esc_attr($themnific_redux['tmnf-header-layout']);}
?>">
    <header>
    <div class="header_fix"></div>
    <div id="header" class="tranz" itemscope itemtype="https://schema.org/WPHeader">
    
    	<div class="container_head">
            
            <a class="screen-reader-text ribbon skip-link" href="#content_start"><?php esc_html_e('Skip to content','citygov');?></a>
    
            <div class="clearfix"></div>
            
            <div id="titles" class="tranz2">
            
                <?php if(empty($themnific_redux['tmnf-main-logo']['url'])) { ?>
                
                <h1 class="logo"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name');?></a></h1>
                
                <?php } 
                
                else { ?>
                        
                <a class="logo" href="<?php echo esc_url(home_url('/')); ?>">
                
                    <img class="tranz" src="<?php echo esc_url($themnific_redux['tmnf-main-logo']['url']);?>" alt="<?php bloginfo('name'); ?>"/>
                        
                </a>
                
                <?php } ?>
            
            </div><!-- end #titles  -->
            
            <div class="header-right for-menu">
                <input type="checkbox" id="showmenu" aria-label="<?php esc_html_e('Open Menu','citygov');?>">
                <label for="showmenu" class="show-menu ribbon" tabindex="0"><i class="fas fa-bars"></i> <span><?php esc_html_e('Menu','citygov');?></span></label>
               
                <nav id="navigation" class="rad tranz" itemscope itemtype="https://schema.org/SiteNavigationElement" role="navigation" aria-label="<?php esc_html_e( 'Main Menu', 'citygov' ); ?>"> 
                    
                    <?php get_template_part('/includes/navigation'); ?>
                
                </nav>
            
            </div><!-- end .header-right  -->
            
            <div class="clearfix"></div>
            
            <div id="bottombar" class="bottomnav tranz" role="navigation" aria-label="<?php esc_html_e( 'Quick Links', 'citygov' ); ?>">
            
                <?php if(empty($themnific_redux['tmnf-menu-label'])) {} else { ?>
					<p class="menu_label"><?php echo  esc_attr($themnific_redux['tmnf-menu-label']); ?></p>
				<?php }?>
                
                <div class="header-right tranz">
                
                    <?php get_template_part('/includes/add-navigation'); ?>
                    
                    <?php get_template_part('/includes/uni-social' );?>
                
                </div>
            
            </div><!-- end #bottombar  -->
            
            <div class="clearfix"></div>
        
        </div><!-- end .container  -->
    
    </div><!-- end #header  -->

    </header>

<?php  ?>

<div class="wrapper p-border"  role="main">