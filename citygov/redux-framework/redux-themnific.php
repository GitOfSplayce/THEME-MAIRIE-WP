<?php

    if ( ! class_exists( 'citygov_redux_config' ) ) {

        class citygov_redux_config {
			
            public $args = array();
            public $sections = array();
            public $theme;
            public $ReduxFramework;

            public function __construct() {

                if ( ! class_exists( 'ReduxFramework' ) ) {
                    return;
                }

                $this->initSettings();

            }

            public function initSettings() {
                $this->theme = wp_get_theme();
                $this->setArguments();
                $this->setHelpTabs();
                $this->setSections();

                if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
                    return;
                }
                add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

                $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
            }
            function compiler_action( $options, $css, $changed_values ) {
                echo esc_html__( 'The compiler hook has run!','citygov' );
                echo "<pre>";
                print_r( esc_html($changed_values )); // Values that have changed since the last save
                echo "</pre>";
            }
            function dynamic_section( $sections ) {
                //$sections = array();
                $sections[] = array(
                    'title'  => esc_html__( 'Section via hook','citygov' ),
                    'desc'   => esc_html__( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>','citygov' ),
                    'icon'   => 'el el-paper-clip',
                    // Leave this as a blank section, no options just some intro text set above.
                    'fields' => array()
                );

                return $sections;
            }

            function change_arguments( $args ) {
                //$args['dev_mode'] = true;

                return $args;
            }
            function change_defaults( $defaults ) {
                $defaults['str_replace'] = 'Testing filter hook!';

                return $defaults;
            }

            function remove_demo() {

                if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                    remove_filter( 'plugin_row_meta', array(
                        ReduxFrameworkPlugin::instance(),
                        'plugin_metalinks'
                    ), null, 2 );
                    remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
                }
            }

            public function setSections() {

                ob_start();

                $ct          = wp_get_theme();
                $this->theme = $ct;
                $item_name   = $this->theme->get( 'Name' );
                $tags        = $this->theme->Tags;
                $screenshot  = $this->theme->get_screenshot();
                $class       = $screenshot ? 'has-screenshot' : '';

                $customize_title = sprintf( esc_html__( 'Customize &#8220;%s&#8221;','citygov' ), $this->theme->display( 'Name' ) );

                ?>
                <div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
                    <?php if ( $screenshot ) : ?>
                        <?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
                            <a href="<?php echo esc_url(wp_customize_url()); ?>" class="load-customize hide-if-no-customize"
                               title="<?php echo esc_attr( $customize_title ); ?>">
                                <img src="<?php echo esc_url( $screenshot ); ?>"
                                     alt="<?php esc_attr_e( 'Current theme preview','citygov' ); ?>"/>
                            </a>
                        <?php endif; ?>
                        <img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>"
                             alt="<?php esc_attr_e( 'Current theme preview','citygov' ); ?>"/>
                    <?php endif; ?>

                    <h4><?php echo esc_html($this->theme->display( 'Name' )); ?></h4>

                    <div>
                        <ul class="theme-info">
                            <li><?php printf( esc_html__( 'By %s','citygov' ), $this->theme->display( 'Author' ) ); ?></li>
                            <li><?php printf( esc_html__( 'Version %s','citygov' ), $this->theme->display( 'Version' ) ); ?></li>
                            <li><?php echo '<strong>' . esc_html__( 'Tags','citygov' ) . ':</strong> '; ?><?php printf( $this->theme->display( 'Tags' ) ); ?></li>
                        </ul>
                        <?php
                            if ( $this->theme->parent() ) {
                                printf( ' <p class="howto">' . esc_html__( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.','citygov' ) . '</p>', esc_html__( 'https://codex.wordpress.org/Child_Themes','citygov' ), $this->theme->parent()->display( 'Name' ) );
                            }
                        ?>

                    </div>
                </div>

                <?php
                $item_info = ob_get_contents();

                ob_end_clean();

                $sampleHTML = '';

                // ACTUAL DECLARATION OF SECTIONS
                $this->sections[] = array(
                    'title'  => esc_html__( 'General Settings','citygov' ),
                    'desc'   => esc_html__( '','citygov' ),
                    'icon'   => 'el el-cogs',
                    'fields' => array( // header end
					

                        array(
                            'id'       => 'tmnf-main-logo',
                            'type'     => 'media',
							'default'  => '',
							'readonly' => false,
                            'preview'  => true,
							'url'      => true,
                            'title'    => esc_html__( 'Main Logo','citygov' ),
                            'desc'     => esc_html__( 'Upload a logo for your theme','citygov' ),
                        ),
												
                      	array(
                            'id'       => 'tmnf-container-width',
                            'type'     => 'radio',
                            'title'    => esc_html__('Container Width Limitation','citygov'),
                            //Must provide key => value pairs for radio options
                            'options'  => array(
                                'tmnf_width_normal' => esc_html__('Normal (1180px)','citygov'),
                                'tmnf_width_wide' => esc_html__('Wide (1440px)','citygov'),
                            ),
                            'default'  => 'tmnf_width_normal'
                        ),
						
						array(
                            'id'       => 'tmnf-header-image',
                            'type'     => 'media',
							'default'  => '',
							'readonly' => false,
                            'preview'  => true,
							'url'      => true,
                            'title'    => esc_html__( 'Header image', 'citygov' ),
                            'subtitle'     => esc_html__( 'Upload a "header" image for blog and archives. Recommended size 1500x650px', 'citygov' ),
                        ),
						
                        array(
                            'id'       => 'tmnf-menu-label',
                            'type'     => 'text',
                            'title'    => esc_html__('Menu Label ', 'citygov' ),
                            'subtitle'     => esc_html__('Write menu label below logo/site title.', 'citygov' ),
                            'default'  => '',
                        ),
						
                        array(
                            'id'       => 'tmnf-blog-label',
                            'type'     => 'text',
                            'title'    => esc_html__('News / Blog Title', 'citygov' ),
                            'subtitle'     => esc_html__('Write any label for blog/news page title.', 'citygov' ),
                            'default'  => esc_html__('City News', 'citygov' ),
                        ),
						
                        array(
                            'id'       => 'tmnf-uppercase',
                            'type'     => 'checkbox',
                            'title'    => esc_html__( 'Enable Uppercase Fonts','citygov' ),
                            'default'  => '1'// 1 = on | 0 = off
                        ),
						
                        array(
                            'id'       => 'tmnf-radius-buttons',
                            'type'     => 'checkbox',
                            'title'    => esc_html__( 'Rounded Buttons','citygov' ),
                            'default'  => '0'// 1 = on | 0 = off
                        ),

                        array(
                            'id'       => 'citygov-site-wrapper',
							'type'      => 'color',
							'title'     => esc_html__('Site Frame: Background Color','citygov'),
							'default'   => '#f7f7f7',
							'output'    => array(
								'background-color' => '.site_wrapper'
							)
						),
						

                        array(
                            'id'       => 'citygov-spacing-site-wrapper',
                            'type'     => 'spacing',
                            'output'   => array( '.site_wrapper' ),
                            'mode'     => 'padding',
                            'all'      => true,   
                            'units'         => 'px',      
                            'title'    => esc_html__( 'Site Frame: Spacing','citygov' ),
                            'subtitle' => esc_html__( 'Site Frame is applied only on large desktop screens','citygov' ),
                            'default'        => array(
                                'padding'  => '0',
                            )
                        ),
						
						
					
					// section end
                    )
                );
				// General Layout THE END
				
				
				




                $this->sections[] = array(
                    'type' => 'divide',
                );




                $this->sections[] = array(
                    'title'  => esc_html__( 'Primary Styling','citygov' ),
                    'desc'   => esc_html__( '','citygov' ),
                    'icon'   => 'el el-tint',
                    'fields' => array( // header end



						array(
                            'id'          => 'citygov-body-typography',
                            'type'        => 'typography',
                            'title'       => esc_html__( 'Typography','citygov' ),
                            'google'      => true,
                            'font-backup' => true,
							'all_styles'  => true,
                            'output'      => array( 'body,input,button,select,#wpmem_reg fieldset,#wpmem_login fieldset,fieldset .give-final-total-amount' ),
                            'units'       => 'px',
                            'line-height' => false,
                            'subtitle'    => esc_html__( 'Select the typography used as general text.','citygov' ),
                            'default'     => array(
                                'color'       => '#232323',
                                'font-style'  => '400',
                                'font-family' => 'Nunito',
                                'google'      => true,
                                'font-size'   => '18px',
                            ),
                        ),

                        array(
                            'id'       => 'citygov-background',
                            'type'     => 'background',
                            'title'    => esc_html__( 'Main Body Background','citygov' ),
                            'subtitle' => esc_html__( 'Body background with image, color, etc.','citygov' ),
                            'output'   => array('.wrapper,.postbar' ),
                            'default'     => array(
                                'background-color'       => '#fff',
                            ),
                        ),
						
						array(
							'id'        => 'citygov-color-ghost',
							'type'      => 'color',
							'title'     => esc_html__('Ghost Background Color','citygov'),
							'subtitle'  => esc_html__('Pick a alternative background color (similar to Main Body Background)','citygov'),
							'default'   => '#f7f7f7',
							'output'    => array(
								'background-color' => '.ghost,.single .give-goal-progress,.sidebar_item,#comments .navigation a,a.page-numbers,.page-numbers.dots'
							)
						),

                        array(
                            'id'       => 'citygov-link-color',
                            'type'     => 'link_color',
                            'title'    => esc_html__( 'Links Color Option','citygov' ),
                            'subtitle' => esc_html__( 'Pick a link color','citygov' ),
							'output'   => array( 'a,.events-table h3 a' ),
                            'default'  => array(
                                'regular' => '#222',
                                'hover'   => '#C95D5D',
                                'active'  => '#000',
                            )
                        ),
						

						
						array(
							'id'        => 'citygov-color-entry-link',
							'type'      => 'color',
							'title'     => esc_html__('Entry Links (in post texts)','citygov'),
							'subtitle'  => esc_html__('Pick a custom color for post links.','citygov'),
							'default'   => '#E8816E',
							'output'    => array(
								'color' => '.entry a,.events-table h3 a:hover',
								'border-color' => '.events-table h3 a:hover',
							)
						),
						

						
						array(
							'id'        => 'citygov-color-entry-link-hover',
							'type'      => 'color',
							'title'     => esc_html__('Entry Links (in post texts): Hover Background Color','citygov'),
							'subtitle'  => esc_html__('Pick a custom color for post links.','citygov'),
							'default'   => '#C95D5D',
							'output'    => array(
								'background-color' => '.entry p a:hover',
							)
						),
						
                        array(
                            'id'       => 'citygov-primary-border',
							'type'      => 'color',
							'title'     => esc_html__('Borders Color','citygov'),
							'subtitle'  => esc_html__('Pick a color for primary borders','citygov'),
							'default'   => '#eaeaea',
							'output'    => array(
								'border-color' => '.p-border,.sidebar_item,.give-goal-progress,.meta,h3#reply-title,.tagcloud a,.taggs a,.page-numbers,input,textarea,select,.nav_item a,.tp_recent_tweets ul li,.page-link a span,.post-pagination>p a',
							)
						),
						
						array(
							'id'        => 'citygov-text-sidebar',
							'type'      => 'color',
							'title'     => esc_html__('Sidebar Text Color','citygov'),
							'subtitle'  => esc_html__('Pick a color for sidebar text.','citygov'),
							'default'   => '#333',
							'output'    => array(
								'color' => '#sidebar,.post-pagination span',
							)
						),
						
						array(
							'id'        => 'citygov-links-sidebar',
							'type'      => 'color',
							'title'     => esc_html__('Sidebar Link Color','citygov'),
							'subtitle'  => esc_html__('Pick a color for sidebar links.','citygov'),
							'default'   => '#000',
							'output'    => array(
								'color' => '.widgetable a',
							)
						),


					// section end
                    )
                );
				// Primary styling THE END
				




                $this->sections[] = array(
                    'title'  => esc_html__( 'Header Styling','citygov' ),
                    'desc'   => esc_html__( '','citygov' ),
                    'icon'   => 'el el-tint',
                    'fields' => array( // header end
										
                      	array(
                            'id'       => 'tmnf-header-layout',
                            'type'     => 'radio',
                            'title'    => esc_html__('Header Layout','citygov'),
                            'subtitle' => esc_html__('Select layout for your header','citygov'),
                            //Must provide key => value pairs for radio options
                            'options'  => array(
                                'header_default' => esc_html__('Default Header','citygov'),
                                'header_fullwidth' => esc_html__('Full Width Header','citygov'),
                                'header_fullwidth_2' => esc_html__('Full Width Header 2','citygov'),
                                'header_fullwidth header_fullwidth_special' => esc_html__('Full Width Header (Special)','citygov'),
                                'header_transparent' => esc_html__('Transparent Header','citygov'),
                            ),
                            'default'  => 'header_default'
                        ),
						
						array(
							'id'        => 'citygov-bg-myheader',
							'type'      => 'color',
							'title'     => esc_html__('Header Background Color','citygov'),
							'subtitle'  => esc_html__('Pick a bg color for header. On mobile devices is transparent header disabled.','citygov'),
							'default'   => '#fff',
							'output'    => array(
								'background-color' => '.container_head,.header_fullwidth #header,.header_transparent #header.scrolled',
							)
						),
						
						array(
							'id'        => 'citygov-bg-navi',
							'type'      => 'color',
							'title'     => esc_html__('Title Background Color','citygov'),
							'subtitle'  => esc_html__('Pick a bg color for header. On mobile devices is transparent header disabled.','citygov'),
							'default'   => '#082C45',
							'output'    => array(
								'background-color' => '#titles,.header_fullwidth #titles::before,#bottombar .social-menu a:hover',
							)
						),
						
						array(
							'id'        => 'citygov-link-title',
							'type'      => 'color',
							'title'     => esc_html__('Title Link Color','citygov'),
							'subtitle'  => esc_html__('Pick a color for header links.','citygov'),
							'default'   => '#fff',
							'output'    => array(
								'color' => '#header h1 a,#bottombar .social-menu a:hover',
							)
						),

						array(
                            'id'          => 'citygov-header-typography',
                            'type'        => 'typography',
                            'title'       => esc_html__( 'Navigation Typography','citygov' ),
                            'google'      => true,
                            'font-backup' => true,
                            'output'      => array( '.nav>li>a,.bottomnav p' ),
                            'units'       => 'px',
                            'line-height' => false,
                            'subtitle'    => esc_html__( 'Select the typography used as navigation text.','citygov' ),
                            'default'     => array(
                                'color'       => '#000',
                                'font-weight'  => '600',
                                'font-family' => 'Poppins',
                                'google'      => true,
                                'font-size'   => '15px',
                            ),
                        ),
						
						array(
							'id'        => 'citygov-hover-myheader',
							'type'      => 'color',
							'title'     => esc_html__('Navigation Links: Hover Color','citygov'),
							'subtitle'  => esc_html__('Pick a hover color for header links.','citygov'),
							'default'   => '#E8816E',
							'output'    => array(
								'border-color' => '.nav li.current-menu-item>a,.nav >li>a:hover',
							)
						),
						

					
						array(
							'id'   => 'info_normal',
							'type' => 'info',
							'title' => esc_html__('Sub-menu + Special menu button','citygov'),
							'style' => 'success',
						),
						
						
						
						array(
							'id'        => 'citygov-sub-bg-myheader',
							'type'      => 'color',
							'title'     => esc_html__('Sub-menu Background Color','citygov'),
							'subtitle'  => esc_html__('Pick a color for header text.','citygov'),
							'default'   => '#222933',
							'output'    => array(
								'background-color' => '.nav li ul',
								'border-left-color' => '.nav>li>ul:after,.nav > li.mega:hover::after',
								'border-right-color' => 'body.rtl .nav>li>ul:after,body.rtl .nav > li.mega:hover::after',
							)
						),


						array(
                            'id'          => 'citygov-sub-header-typography',
                            'type'        => 'typography',
                            'title'       => esc_html__( 'Sub-menu Typography','citygov' ),
                            'google'      => true,
                            'font-backup' => true,
                            'output'      => array( '.nav ul li>a,.topnav .menu_label,.topnav .social-menu span' ),
                            'units'       => 'px',
                            'line-height' => false,
                            'subtitle'    => esc_html__( 'Select the typography used as navigation text.','citygov' ),
                            'default'     => array(
                                'color'       => '#fff',
                                'font-weight'  => '400',
                                'font-family' => 'Poppins',
                                'google'      => true,
                                'font-size'   => '14px',
                            ),
                        ),
						

						
						
						array(
							'id'        => 'citygov-special-bg',
							'type'      => 'color',
							'title'     => esc_html__('Menu Button: Background Color','citygov'),
							'subtitle'  => esc_html__('Pick a color for header text.','citygov'),
							'default'   => '#E8816E',
							'output'    => array(
								'background-color' => '#main-nav>li.special>a',
							)
						),
						
						
						array(
							'id'        => 'citygov-special-text',
							'type'      => 'color',
							'title'     => esc_html__('Menu Button: Text Color','citygov'),
							'subtitle'  => esc_html__('Pick a color for header text.','citygov'),
							'default'   => '#fff',
							'output'    => array(
								'color' => '#main-nav>li.special>a,#main-nav .special a i',
							)
						),
						
						array(
							'id'   => 'info_normal',
							'type' => 'info',
							'title' => esc_html__('Bottombar','citygov'),
							'style' => 'success',
						),	
						
						
                        array(
                            'id'       => 'tmnf-bottombar-dis',
                            'type'     => 'checkbox',
                            'title'    => esc_html__( 'Disable Bottombar','citygov' ),
                            'default'  => '0'// 1 = on | 0 = off
                        ),	
						
						array(
							'id'        => 'citygov-bottombar-bg',
							'type'      => 'color',
							'title'     => esc_html__('Bottombar Background Color','citygov'),
							'default'   => '#f9f9f9',
							'output'    => array(
								'background-color' => '#bottombar,#bottombar::after',
							)
						),	
						
						array(
							'id'        => 'citygov-bottombar-text',
							'type'      => 'color',
							'title'     => esc_html__('Bottombar Links/Text Color','citygov'),
							'default'   => '#222',
							'output'    => array(
								'color' => '#bottombar p,#bottombar a,#bottombar span,#bottombar a:hover',
							)
						),


						array(
							'id'   => 'info_normal',
							'type' => 'info',
							'title' => esc_html__('Spacing of the Header','citygov'),
							'style' => 'success',
						),

                        array(
                            'id'             => 'citygov-width-header',
                            'type'           => 'dimensions',
                            'output'   => array( '#titles,p.menu_label' ),
                            'units'          => 'px', 
                            'units_extended' => 'true',  
                            'height'          => false, 
                            'title'          => esc_html__( 'Header Title/Logo Width Option','citygov' ),
                            'subtitle'       => esc_html__( 'Choose the width limitation for header logo.','citygov' ),
                            'default'        => array(
                                'width'  => '220px',
                            )
                        ),

                        array(
                            'id'       => 'citygov-spacing-header',
                            'type'     => 'spacing',
                            'output'   => array( '#titles .logo,.header_fix' ),
                            'mode'     => 'margin',
                            'all'      => false,
                            'right'         => false,    
                            'left'          => false,     
                            'units'         => 'px',      
                            'title'    => esc_html__( 'Header Title/Logo Spacing','citygov' ),
                            'subtitle' => esc_html__( 'Choose the margin for header logo.','citygov' ),
                            'default'  => array(
                                'margin-top'    => '46px',
                                'margin-bottom' => '46px',
                            )
                        ),
						

                        array(
                            'id'       => 'citygov-spacing-nav',
                            'type'     => 'spacing',
                            'output'   => array( '#navigation' ),
                            'mode'     => 'padding',
                            'all'      => false,
                            'right'         => false,    
                            'left'          => false,     
                            'units'         => 'px',      
                            'title'    => esc_html__( 'Header Navigation Spacing','citygov' ),
                            'subtitle' => esc_html__( 'Choose the margin for header navigation.','citygov' ),
                            'default'  => array(
                                'padding-top'    => '20px',
                                'padding-bottom' => '20px',
                            )
                        ),


					// section end
                    )
                );
				// header styling THE END






                $this->sections[] = array(
                    'title'  => esc_html__( 'Footer Styling','citygov' ),
                    'desc'   => esc_html__( '','citygov' ),
                    'icon'   => 'el el-tint',
                    'fields' => array( // header end
						
						
						
					    array(
                            'id'       => 'tmnf-footer-logo',
                            'type'     => 'media',
							'default'  => '',
							'readonly' => false,
                            'preview'  => true,
                            'title'    => esc_html__( 'Footer Logo','citygov' ),
                            'desc'     => esc_html__( 'Upload a footer logo for your theme.','citygov' ),
                        ),
						
						array(
							'id'        => 'citygov-color-myfooter',
							'type'      => 'background',
							'title'     => esc_html__('Footer Background Color','citygov'),
							'subtitle'  => esc_html__('Pick a background color for footer.','citygov'),
							
                            'output'   => array('#footer,#footer .searchform input.s,.footop-right' ),
                            'default'     => array(
                                'background-color'       => '#222933',
                            ),
						),
						
						array(
							'id'        => 'citygov-text-myfooter',
							'type'      => 'color',
							'title'     => esc_html__('Footer Text - Color','citygov'),
							'subtitle'  => esc_html__('Pick a color for footer links.','citygov'),
							'default'   => '#a8bbc4',
							'output'    => array(
								'color' => '#footer p,#footer',
							)
						),
						
						array(
							'id'        => 'citygov-links-myfooter',
							'type'      => 'color',
							'title'     => esc_html__('Footer Links - Color','citygov'),
							'subtitle'  => esc_html__('Pick a color for footer links.','citygov'),
							'default'   => '#cedcdd',
							'output'    => array(
								'color' => '#footer a,#footer h2,#footer h3,#footer h4,#footer .meta,#footer .meta a,#footer .searchform input.s',
							)
						),
						
						array(
							'id'        => 'citygov-hover-myfooter',
							'type'      => 'color',
							'title'     => esc_html__('Footer Links - Hover Color','citygov'),
							'subtitle'  => esc_html__('Pick a hover color for footer links.','citygov'),
							'default'   => '#e8816e',
							'output'    => array(
								'color' => '#footer a:hover',
							)
						),
						
						
                        array(
                            'id'       => 'citygov-footer-border',
							'type'      => 'color',
							'title'     => esc_html__('Footer Borders','citygov'),
							'subtitle'  => esc_html__('Pick a color for footer borders.','citygov'),
							'default'   => '#40535b',
							'output'    => array(
								'border-color' => '#footer li.cat-item,.footer-logo,#copyright,#footer .tagcloud a,#footer .tp_recent_tweets ul li,#footer .p-border,#footer .searchform input.s,#footer input,#footer .landing-section',
							)
						), 
						
						array(
							'id'   => 'info_normal',
							'type' => 'info',
							'title' => esc_html__('Special Footer Section (above the footer)','citygov'),
							'style' => 'success',
						),	
						
						
						array(
							'id'        => 'citygov-bg-color-abovefooter',
							'type'      => 'color',
							'title'     => esc_html__('Special Footer Background Color','citygov'),
							'subtitle'  => esc_html__('Pick a background color for Special Footer.','citygov'),
							'default'   => '#e8816e',
							'output'    => array(
								'background-color' => '.footop',
							)
						),
						
						
						array(
							'id'        => 'citygov-text-color-abovefooter',
							'type'      => 'color',
							'title'     => esc_html__('Special Footer Text / links Color','citygov'),
							'subtitle'  => esc_html__('Pick a text color for Special Footer.','citygov'),
							'default'   => '#fff',
							'output'    => array(
								'color' => '#footop h2,#footop a,#foo-spec',
							)
						),


			
						array(
                            'id'       => 'tmnf-footer-editor',
                            'type'     => 'textarea',
                            'title'    => esc_html__( 'Footer Text','citygov' ),
                            'subtitle' => esc_html__( 'Just like a text box widget.','citygov' ),
                            'desc'     => esc_html__( 'This field is HTML validated!','citygov' ),
							'default'  => '',
                            'validate' => 'html',
						),
						
						array(
                            'id'       => 'tmnf-footer-credits',
                            'type'     => 'textarea',
                            'title'    => esc_html__( 'Footer Credits Text','citygov' ),
                            'subtitle' => esc_html__( 'Just like a text box widget.','citygov' ),
                            'desc'     => esc_html__( 'This field is HTML validated!','citygov' ),
							'default'  => 'Copyright © 2020 - CityGov Theme',
                            'validate' => 'html',
						),

					// section end
                    )
                );
				// footer styling THE END









                $this->sections[] = array(
                    'title'  => esc_html__( 'Typography','citygov' ),
                    'desc'   => esc_html__( '','citygov' ),
                    'icon'   => 'el el-bold',
                    'fields' => array( // header end


                        array(
							'id'   => 'info_titles',
							'type' => 'info',
							'title' => esc_html__('Titles','citygov'),
							'style' => 'success',
						),	


						
						array(
                            'id'          => 'citygov-h2-large',
                            'type'        => 'typography',
                            'title'       => esc_html__( 'Post Titles','citygov' ),
                            'google'      => true,
                            'font-backup' => true,
                            'output'      => array( 'h1.entry-title,h1.archiv,.eleslideinside h1,.eleslideinside h2' ),
                            'units'       => 'px',
                            'line-height' => false,
                            'subtitle'    => esc_html__( 'Select the typography for heading H2.','citygov' ),
                            'default'     => array(
                                'color'       => '#222',
                                'font-weight'  => '700',
                                'font-family' => 'Poppins',
                                'google'      => true,
                                'font-size'   => '60px',
                            ),
                        ),
						
						array(
                            'id'          => 'citygov-h2-list',
                            'type'        => 'typography',
                            'title'       => esc_html__( 'Lists: Post Titles','citygov' ),
                            'google'      => true,
                            'font-backup' => true,
                            'output'      => array( 'h2.posttitle' ),
                            'units'       => 'px',
                            'line-height' => false,
                            'subtitle'    => esc_html__( 'Select the typography for heading H2.','citygov' ),
                            'default'     => array(
                                'color'       => '#222',
                                'font-weight'  => '700',
                                'font-family' => 'Poppins',
                                'google'      => true,
                                'font-size'   => '40px',
                            ),
                        ),

						array(
                            'id'          => 'citygov-small-titles',
                            'type'        => 'typography',
                            'title'       => esc_html__( 'Small Titles','citygov' ),
                            'google'      => true,
                            'font-backup' => true,
                            'output'      => array( '.tptn_posts_widget li::before,.sidebar_item .menu>li>a' ),
                            'units'       => 'px',
                            'line-height' => false,
                            'subtitle'    => esc_html__( 'Select the typography for heading H4.','citygov' ),
                            'default'     => array(
                                'color'       => '#222',
                                'font-weight'  => '700',
                                'font-family' => 'Poppins',
                                'google'      => true,
                                'font-size'   => '17px',
                            ),
                        ),


                        
						
						array(
                            'id'          => 'citygov-buttons',
                            'type'        => 'typography',
                            'title'       => esc_html__( 'Buttons','citygov' ),
                            'google'      => true,
                            'font-backup' => true,
                            'output'      => array( 'a.mainbutton,.comment-author cite,.tab-post h4,.tptn_title,.submit,.nav-previous a,#comments .reply a,.post-pagination,.mc4wp-form input,.woocommerce #respond input#submit, .woocommerce a.button,.woocommerce button.button, .woocommerce input.button,.tmnf_events_widget a,.post-nav-text,a.event_button,.give-btn' ),
                            'units'       => 'px',
                            'line-height' => false,
                            'subtitle'    => esc_html__( 'Select the typography for heading H5.','citygov' ),
                            'default'     => array(
                                'color'       => '#000',
                                'font-weight'  => '600',
                                'font-family' => 'Poppins',
                                'google'      => true,
                                'font-size'   => '15px',
                            ),
                        ),	

						array(
							'id'   => 'info_headings',
							'type' => 'info',
							'title' => esc_html__('Basic (in a post) Headings','citygov'),
							'style' => 'success',
						),


                        array(
                            'id'          => 'citygov-h1',
                            'type'        => 'typography',
                            'title'       => esc_html__( 'H1 Font Style','citygov' ),
                            'google'      => true,
                            'font-backup' => true,
                            'output'      => array( 'h1' ),
                            'units'       => 'px',
                            'line-height' => false,
                            'subtitle'    => esc_html__( 'Select the typography for heading H1.','citygov' ),
                            'default'     => array(
                                'color'       => '#000',
                                'font-weight'  => '700',
                                'font-family' => 'Poppins',
                                'google'      => true,
                                'font-size'   => '24px',
                            ),
                        ),
						
						array(
                            'id'          => 'citygov-h2',
                            'type'        => 'typography',
                            'title'       => esc_html__( 'H2 Font Style','citygov' ),
                            'google'      => true,
                            'font-backup' => true,
                            'output'      => array( 'h2' ),
                            'units'       => 'px',
                            'line-height' => false,
                            'subtitle'    => esc_html__( 'Select the typography for heading H2.','citygov' ),
                            'default'     => array(
                                'color'       => '#222',
                                'font-weight'  => '700',
                                'font-family' => 'Poppins',
                                'google'      => true,
                                'font-size'   => '22px',
                            ),
                        ),
						
						array(
                            'id'          => 'citygov-h3',
                            'type'        => 'typography',
                            'title'       => esc_html__( 'H3 Font Style','citygov' ),
                            'google'      => true,
                            'font-backup' => true,
                            'output'      => array( 'h3,.format-quote .teaser,#wpmem_reg legend, #wpmem_login legend,.give-goal-progress' ),
                            'units'       => 'px',
                            'line-height' => false,
                            'subtitle'    => esc_html__( 'Select the typography for heading H3.','citygov' ),
                            'default'     => array(
                                'color'       => '#222',
                                'font-weight'  => '700',
                                'font-family' => 'Poppins',
                                'google'      => true,
                                'font-size'   => '22px',
                            ),
                        ),
						
						array(
                            'id'          => 'citygov-h4',
                            'type'        => 'typography',
                            'title'       => esc_html__( 'H4 Font Style','citygov' ),
                            'google'      => true,
                            'font-backup' => true,
                            'output'      => array( 'h4' ),
                            'units'       => 'px',
                            'line-height' => false,
                            'subtitle'    => esc_html__( 'Select the typography for heading H4.','citygov' ),
                            'default'     => array(
                                'color'       => '#222',
                                'font-weight'  => '700',
                                'font-family' => 'Poppins',
                                'google'      => true,
                                'font-size'   => '17px',
                            ),
                        ),
						
						array(
                            'id'          => 'citygov-h5',
                            'type'        => 'typography',
                            'title'       => esc_html__( 'H5 Font Style','citygov' ),
                            'google'      => true,
                            'font-backup' => true,
                            'output'      => array( 'h5' ),
                            'units'       => 'px',
                            'line-height' => false,
                            'subtitle'    => esc_html__( 'Select the typography for heading H5.','citygov' ),
                            'default'     => array(
                                'color'       => '#000',
                                'font-weight'  => '600',
                                'font-family' => 'Poppins',
                                'google'      => true,
                                'font-size'   => '15px',
                            ),
                        ),	
						
						array(
                            'id'          => 'citygov-h6',
                            'type'        => 'typography',
                            'title'       => esc_html__( 'H6 Font Style','citygov' ),
                            'google'      => true,
                            'font-backup' => true,
                            'output'      => array( 'h6,.su-button span,.owl-nav>div,.awesome-weather-wrap' ),
                            'units'       => 'px',
                            'line-height' => false,
                            'subtitle'    => esc_html__( 'Select the typography for heading H6.','citygov' ),
                            'default'     => array(
                                'color'       => '#000',
                                'font-weight'  => '500',
                                'font-family' => 'Poppins',
                                'google'      => true,
                                'font-size'   => '11px',
                            ),
                        ),
						


					// section end
                    )
                );
				// typography styling THE END










                $this->sections[] = array(
                    'title'  => esc_html__( 'Other Styling','citygov' ),
                    'desc'   => esc_html__( '','citygov' ),
                    'icon'   => 'el el-tint',
                    'fields' => array( // header end
						
	
						
						array(
                            'id'          => 'citygov-meta',
                            'type'        => 'typography',
                            'title'       => esc_html__( 'Meta Sections - Font Style','citygov' ),
                            'google'      => true,
                            'font-backup' => true,
                            'output'      => array( '.meta,.meta a,.crumb' ),
                            'units'       => 'px',
                            'line-height' => false,
                            'subtitle'    => esc_html__( 'Select the typography for meta sections.','citygov' ),
                            'default'     => array(
                                'color'       => '#686868',
                                'font-weight'  => '500',
                                'font-family' => 'Poppins',
                                'google'      => true,
                                'font-size'   => '11px',
                            ),
                        ),

						array(
							'id'        => 'citygov-color-dividers',
							'type'      => 'color',
							'title'     => esc_html__('Dividers + Special Sections: Background Color','citygov'),
							'subtitle'  => esc_html__('Pick a custom background color for main buttons, special sections etc.','citygov'),
							'default'   => '#f93822',
							'output'    => array(
								'background-color' => 'a.mainbutton.inv',
								
							)
						),
						
						array(
							'id'        => 'citygov-text-dividers',
							'type'      => 'color',
							'title'     => esc_html__('Dividers + Special Sections: Links/Texts - Color','citygov'),
							'subtitle'  => esc_html__('Pick a custom text color for main buttons, special sections etc.','citygov'),
							'default'   => '#fff',
							'output'    => array(
								'color' => 'a.mainbutton.inv',
							)
						),
						
						array(
							'id'        => 'citygov-color-elements',
							'type'      => 'color',
							'title'     => esc_html__('Elements Background Color','citygov'),
							'subtitle'  => esc_html__('Pick a custom background color for main buttons, special sections etc.','citygov'),
							'default'   => '#e8816e',
							'output'    => array(
								'background-color' => 'a.searchSubmit,.ribbon,.cat_nr,.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button.alt,.woocommerce input.button.alt,.woocommerce a.button.alt,.woocommerce button.button, .woocommerce input.button,#respond #submit,.page-numbers.current,a.mainbutton,#submit,#comments .navigation a,.tagssingle a,.contact-form .submit,a.comment-reply-link,.dekoline:before,.eleslideinside h2:before,.item_inn:before,.meta_more a,.owl-nav > div,.page-link>span,.button_div input,button.give-btn-reveal,.give-btn-modal,.give-submit.give-btn,.give-progress-bar > span',
								'border-color' => 'input.button,button.submit,#sidebar ul.menu a:hover,#sidebar ul.menu .current-menu-item>a,.page-link>span',
								'color' => '.main-breadcrumbs span:after',
								
							)
						),
						
						array(
							'id'        => 'citygov-text-elements',
							'type'      => 'color',
							'title'     => esc_html__('Elements Links/Texts - Color','citygov'),
							'subtitle'  => esc_html__('Pick a custom text color for main buttons, special sections etc.','citygov'),
							'default'   => '#fff',
							'output'    => array(
								'color' => 'a.searchSubmit,.ribbon,.ribbon a,.ribbon p,#footer .ribbon,.cat_nr,.woocommerce #respond input#submit,.woocommerce a.button.alt,.woocommerce input.button.alt,.woocommerce a.button,.woocommerce button.button.alt, .woocommerce button.button, .woocommerce input.button,#comments .reply a,#respond #submit,#footer a.mainbutton,.tmnf_icon,a.mainbutton,#submit,#comments .navigation a,.tagssingle a,.mc4wp-form input[type="submit"],a.comment-reply-link,.page-numbers.current,.meta_more a,.owl-next:before,.owl-prev:before,.page-link>span,.button_div input,button.give-btn-reveal,.give-btn-modal,.give-submit.give-btn',
							)
						),
						
						array(
							'id'        => 'citygov-hover-color-elements',
							'type'      => 'color',
							'title'     => esc_html__('Elements Background Hover Color','citygov'),
							'subtitle'  => esc_html__('Pick a custom background color for main buttons, special sections etc.','citygov'),
							'default'   => '#003356',
							'output'    => array(
								'background-color' => 'a.searchSubmit:hover,.ribbon:hover,a.mainbutton:hover,.entry a.ribbon:hover,.woocommerce #respond input#submit:hover,.woocommerce a.button.alt:hover,.woocommerce a.button:hover, .woocommerce button.button:hover,.woocommerce input.button.alt:hover,.woocommerce input.button:hover,.meta_more a:hover,.owl-nav>div:hover,#main-nav>li.special>a:hover,button.give-btn-reveal:hover,.give-btn-modal:hover,.give-submit.give-btn:hover,.wpcf7-submit,.give-btn.give-default-level',
								'border-color' => 'input.button:hover,button.submit:hover'
							)
						),
						
						array(
							'id'        => 'citygov-hover-text-elements',
							'type'      => 'color',
							'title'     => esc_html__('Elements Links/Texts - Hover Color','citygov'),
							'subtitle'  => esc_html__('Pick a custom text color for main buttons, special sections etc.','citygov'),
							'default'   => '#fff',
							'output'    => array(
								'color' => '#footer a.mainbutton:hover,.ribbon:hover,.ribbon:hover a,.ribbon a:hover,.entry a.ribbon:hover,a.mainbutton:hover,.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,.meta_more a:hover,.owl-next:hover:before,.owl-prev:hover:before,#main-nav>li.special>a:hover,button.give-btn-reveal:hover,.give-btn-modal:hover,.give-submit.give-btn:hover,.wpcf7-submit,.give-btn.give-default-level',
							)
						),
						
						
						array(
							'id'        => 'citygov-images-bg',
							'type'      => 'color',
							'title'     => esc_html__('Images Background Color','citygov'),
							'subtitle'  => esc_html__('Pick a custom background color for theme images.','citygov'),
							'default'   => '#1E1E1E',
							'output'    => array(
								'background-color' => '.imgwrap,.post-nav-image,.page-header',
							)
						),
						
						
						
						array(
							'id'        => 'citygov-images-text',
							'type'      => 'color',
							'title'     => esc_html__('Images Text/Link Color','citygov'),
							'subtitle'  => esc_html__('Pick a custom text color for image texts (overlay)','citygov'),
							'default'   => '#fff',
							'output'    => array(
								'color' => '.page-header,.page-header a,.page-header h1,.page-header h2,.main-breadcrumbs span',
							)
						),




					// section end
                    )
                );
				// other styling THE END









                $this->sections[] = array(
                    'type' => 'divide',
                );	



                
                $this->sections[] = array(
                    'title'  => esc_html__( 'Post Settings','citygov' ),
                    'desc'   => esc_html__( '','citygov' ),
                    'icon'   => 'el el-edit',
                    'fields' => array( // header end

						
                        array(
                            'id'       => 'tmnf-post-meta-dis',
                            'type'     => 'checkbox',
                            'title'    => esc_html__( 'Disable "Meta" sections','citygov' ),
                            'subtitle' => esc_html__( 'Tick to disable post "inforamtions" - date, category etc. below post titles','citygov' ),
                            'desc'     => esc_html__( '','citygov' ),
                            'default'  => '0'// 1 = on | 0 = off
                        ),
						
						array(
                            'id'       => 'tmnf-post-likes-dis',
                            'type'     => 'checkbox',
                            'title'    => esc_html__( 'Enable Tags Section','citygov' ),
                            'subtitle' => esc_html__( 'Tick to disable likes/tags section in single post page.','citygov' ),
                            'desc'     => esc_html__( '','citygov' ),
                            'default'  => '1'// 1 = on | 0 = off
                        ),
						
						array(
                            'id'       => 'tmnf-post-nextprev-dis',
                            'type'     => 'checkbox',
                            'title'    => esc_html__( 'Enable Next/Previous Post Section','citygov' ),
                            'subtitle' => esc_html__( 'Tick to disable Next/Previous section in single post page.','citygov' ),
                            'desc'     => esc_html__( '','citygov' ),
                            'default'  => '1'// 1 = on | 0 = off
                        ),
						
					
					
					// section end
                    )
                );
				// post settings THE END





                
          $this->sections[] = array(
                    'title'  => esc_html__( 'Social Networks','citygov'),
                    'icon'   => 'el el-share',
                    'fields' => array( // header end
				
					
                        array(
                            'id'       => 'tmnf-social-rss',
                            'type'     => 'text',
                            'title'    => esc_html__( 'Rss Feed','citygov'),
                            'subtitle' => esc_html__( 'Enter full URL','citygov'),
                            'validate' => 'url',
                        ),
						
                        array(
                            'id'       => 'tmnf-social-facebook',
                            'type'     => 'text',
                            'title'    => esc_html__( 'Facebook','citygov'),
                            'subtitle' => esc_html__( 'Enter full URL','citygov'),
                            'validate' => 'url',
                        ),
						
						
                        array(
                            'id'       => 'tmnf-social-twitter',
                            'type'     => 'text',
                            'title'    => esc_html__( 'Twitter','citygov'),
                            'subtitle' => esc_html__( 'Enter full URL','citygov'),
                            'validate' => 'url',
                        ),
						
						
                        array(
                            'id'       => 'tmnf-social-pinterest',
                            'type'     => 'text',
                            'title'    => esc_html__( 'Pinterest','citygov'),
                            'subtitle' => esc_html__( 'Enter full URL','citygov'),
                            'validate' => 'url',
                        ),
						
						
                        array(
                            'id'       => 'tmnf-social-instagram',
                            'type'     => 'text',
                            'title'    => esc_html__( 'Instagram','citygov'),
                            'subtitle' => esc_html__( 'Enter full URL','citygov'),
                            'validate' => 'url',
                        ),
						
						
                        array(
                            'id'       => 'tmnf-social-threads',
                            'type'     => 'text',
                            'title'    => esc_html__( 'Threads','citygov'),
                            'subtitle' => esc_html__( 'Enter full URL','citygov'),
                            'validate' => 'url',
                        ),
						
						
                        array(
                            'id'       => 'tmnf-social-youtube',
                            'type'     => 'text',
                            'title'    => esc_html__( 'YouTube','citygov'),
                            'subtitle' => esc_html__( 'Enter full URL','citygov'),
                            'validate' => 'url',
                        ),
						
						
                        array(
                            'id'       => 'tmnf-social-vimeo',
                            'type'     => 'text',
                            'title'    => esc_html__( 'Vimeo','citygov'),
                            'subtitle' => esc_html__( 'Enter full URL','citygov'),
                            'validate' => 'url',
                        ),
						
						
                        array(
                            'id'       => 'tmnf-social-tumblr',
                            'type'     => 'text',
                            'title'    => esc_html__( 'Tumblr','citygov'),
                            'subtitle' => esc_html__( 'Enter full URL','citygov'),
                            'validate' => 'url',
                        ),
						
						
                        array(
                            'id'       => 'tmnf-social-500',
                            'type'     => 'text',
                            'title'    => esc_html__( '500px','citygov'),
                            'subtitle' => esc_html__( 'Enter full URL','citygov'),
                            'validate' => 'url',
                        ),
						
						
                        array(
                            'id'       => 'tmnf-social-flickr',
                            'type'     => 'text',
                            'title'    => esc_html__( 'Flickr','citygov'),
                            'subtitle' => esc_html__( 'Enter full URL','citygov'),
                            'validate' => 'url',
                        ),
						
						
                        array(
                            'id'       => 'tmnf-social-linkedin',
                            'type'     => 'text',
                            'title'    => esc_html__( 'LinkedIn','citygov'),
                            'subtitle' => esc_html__( 'Enter full URL','citygov'),
                            'validate' => 'url',
                        ),
						
						
                        array(
                            'id'       => 'tmnf-social-tripadvisor',
                            'type'     => 'text',
                            'title'    => esc_html__( 'TripAdvisor','citygov'),
                            'subtitle' => esc_html__( 'Enter full URL','citygov'),
                            'validate' => 'url',
                        ),
						
						
                        array(
                            'id'       => 'tmnf-social-foursquare',
                            'type'     => 'text',
                            'title'    => esc_html__( 'Foursquare','citygov'),
                            'subtitle' => esc_html__( 'Enter full URL','citygov'),
                            'validate' => 'url',
                        ),
						
												
                        array(
                            'id'       => 'tmnf-social-dribbble',
                            'type'     => 'text',
                            'title'    => esc_html__( 'Dribbble','citygov'),
                            'subtitle' => esc_html__( 'Enter full URL','citygov'),
                            'validate' => 'url',
                        ),
						
												
                        array(
                            'id'       => 'tmnf-social-skype',
                            'type'     => 'text',
                            'title'    => esc_html__( 'Skype','citygov'),
                            'subtitle' => esc_html__( 'Enter skype URL','citygov'),
                        ),
						
												
                        array(
                            'id'       => 'tmnf-social-stumbleupon',
                            'type'     => 'text',
                            'title'    => esc_html__( 'Stumbleupon','citygov'),
                            'subtitle' => esc_html__( 'Enter full URL','citygov'),
                            'validate' => 'url',
                        ),
						
												
                        array(
                            'id'       => 'tmnf-social-github',
                            'type'     => 'text',
                            'title'    => esc_html__( 'Github','citygov'),
                            'subtitle' => esc_html__( 'Enter full URL','citygov'),
                            'validate' => 'url',
                        ),
												
                        array(
                            'id'       => 'tmnf-social-soundcloud',
                            'type'     => 'text',
                            'title'    => esc_html__( 'SoundCloud','citygov'),
                            'subtitle' => esc_html__( 'Enter full URL','citygov'),
                            'validate' => 'url',
                        ),
												
                        array(
                            'id'       => 'tmnf-social-spotify',
                            'type'     => 'text',
                            'title'    => esc_html__( 'Spotify','citygov'),
                            'subtitle' => esc_html__( 'Enter full URL','citygov'),
                            'validate' => 'url',
                        ),
						
												
                        array(
                            'id'       => 'tmnf-social-xing',
                            'type'     => 'text',
                            'title'    => esc_html__( 'Xing','citygov'),
                            'subtitle' => esc_html__( 'Enter full URL','citygov'),
                            'validate' => 'url',
                        ),
						
												
                        array(
                            'id'       => 'tmnf-social-whatsapp',
                            'type'     => 'text',
                            'title'    => esc_html__( 'WhatsApp','citygov'),
                            'subtitle' => esc_html__( 'Enter full URL','citygov'),
                            'validate' => 'url',
                        ),
						
												
                        array(
                            'id'       => 'tmnf-social-vk',
                            'type'     => 'text',
                            'title'    => esc_html__( 'VK','citygov'),
                            'subtitle' => esc_html__( 'Enter full URL','citygov'),
                            'validate' => 'url',
                        ),
						
												
                        array(
                            'id'       => 'tmnf-social-snapchat',
                            'type'     => 'text',
                            'title'    => esc_html__( 'Snapchat','citygov'),
                            'subtitle' => esc_html__( 'Enter full URL','citygov'),
                            'validate' => 'url',
                        ),
						
												
                        array(
                            'id'       => 'tmnf-social-telegram',
                            'type'     => 'text',
                            'title'    => esc_html__( 'Telegram','citygov'),
                            'subtitle' => esc_html__( 'Enter full URL','citygov'),
                            'validate' => 'url',
                        ),
						
												
                        array(
                            'id'       => 'tmnf-social-tiktok',
                            'type'     => 'text',
                            'title'    => esc_html__( 'TikTok','citygov'),
                            'subtitle' => esc_html__( 'Enter full URL','citygov'),
                            'validate' => 'url',
                        ),
						

					// section end
                    )
                );
				// social networks THE END	

			

                $this->sections[] = array(
                    'type' => 'divide',
                );		

                

                $this->sections[] = array(
                    'title'  => esc_html__( 'Import / Export','citygov' ),
                    'desc'   => esc_html__( 'Import and Export your Redux Framework settings from file, text or URL.','citygov' ),
                    'icon'   => 'el el-refresh',
                    'fields' => array(
                        array(
                            'id'         => 'opt-import-export',
                            'type'       => 'import_export',
                            'title'      => 'Import Export',
                            'subtitle'   => 'Save and restore your Redux options',
                            'full_width' => false,
                        ),
                    ),
                );


            }
			
			

            public function setHelpTabs() {

                // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-1',
                    'title'   => esc_html__( 'Theme Information 1','citygov' ),
                    'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>','citygov' )
                );

                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-2',
                    'title'   => esc_html__( 'Theme Information 2','citygov' ),
                    'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>','citygov' )
                );

                // Set the help sidebar
                $this->args['help_sidebar'] = esc_html__( '<p>This is the sidebar content, HTML is allowed.</p>','citygov' );
            }

            public function setArguments() {

                $theme = wp_get_theme(); // For use with some settings. Not necessary.

                $this->args = array(
                    // TYPICAL -> Change these values as you need/desire
                    'opt_name'             => 'themnific_redux',
                    'display_name'         => $theme->get( 'Name' ),
                    'display_version'      => $theme->get( 'Version' ),
                    'menu_type'            => 'menu',
                    'allow_sub_menu'       => true,
                    'menu_title'           => esc_html__( 'CityGov - admin panel','citygov' ),
                    'page_title'           => esc_html__( 'CityGov admin panel','citygov' ),
                    'google_api_key'       => '',
                    'google_update_weekly' => false,
                    'async_typography'     => false,
                    'disable_google_fonts_link' => false,                    // Disable this in case you want to create your own google fonts loader
                    'admin_bar'            => true,
                    'admin_bar_icon'     => 'dashicons-portfolio',
                    'admin_bar_priority' => 50,
                    'global_variable'      => '',
                    'dev_mode'             => false,
					
					'forced_dev_mode_off' => false,
                    'update_notice'        => false,
                    'customizer'           => true,

                    // OPTIONAL -> Give you extra features
                    'page_priority'        => null,
                    'page_parent'          => 'themes.php',
                    'page_permissions'     => 'manage_options',
                    'menu_icon'            => '',
                    'last_tab'             => '',
                    'page_icon'            => 'icon-themes',
                    'page_slug'            => 'themnific-options',
                    'save_defaults'        => true,
                    'default_show'         => false,
                    'default_mark'         => '',
                    'show_import_export'   => true,

                    // CAREFUL -> These options are for advanced use only
                    'transient_time'       => 60 * MINUTE_IN_SECONDS,
                    'output'               => true,
                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                    'output_tag'           => true,
                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                    'database'             => '',
                    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                    'system_info'          => false,
                    // REMOVE

                    // HINTS
                    'hints'                => array(
                        'icon'          => 'el el-question-sign',
                        'icon_position' => 'right',
                        'icon_color'    => 'lightgray',
                        'icon_size'     => 'normal',
                        'tip_style'     => array(
                            'color'   => 'light',
                            'shadow'  => true,
                            'rounded' => false,
                            'style'   => '',
                        ),
                        'tip_position'  => array(
                            'my' => 'top left',
                            'at' => 'bottom right',
                        ),
                        'tip_effect'    => array(
                            'show' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'mouseover',
                            ),
                            'hide' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'click mouseleave',
                            ),
                        ),
                    )
                );

                // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.



                $this->args['admin_bar_links'][] = array(
                    //'id'    => 'redux-support',
                    'href'   => 'https://themnific.com/docs/citygov/',
					'target'   => '_blank',
                    'title' => esc_html__( 'Documentation', 'citygov' ),
                );

                // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
                $this->args['share_icons'][] = array(
                    'url'   => 'https://themnific.com/docs/citygov/',
					'target'   => '_blank',
                    'title' => esc_html__( 'Documentation', 'citygov' ),
                    'icon'  => 'el el-wrench-alt'
                    //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
                );


                

                // Panel Intro text -> before the form
                if ( ! isset( $this->args['global_variable'] ) || $this->args['global_variable'] !== false ) {
                    if ( ! empty( $this->args['global_variable'] ) ) {
                        $v = $this->args['global_variable'];
                    } else {
                        $v = str_replace( '-', '_', $this->args['opt_name'] );
                    }
                    $this->args['intro_text'] = sprintf( esc_html__( 'Hello in theme admin panel','citygov' ), $v );
                } else {
                    $this->args['intro_text'] = esc_html__( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>','citygov' );
                }

                // Add content after the form.
                $this->args['footer_text'] = esc_html__( 'Redux & Vergo & Themnific','citygov' );
            }

            public function validate_callback_function( $field, $value, $existing_value ) {
                $error = true;
                $value = 'just testing';


                $return['value'] = $value;
                $field['msg']    = 'your custom error message';
                if ( $error == true ) {
                    $return['error'] = $field;
                }

                return $return;
            }

            public static function class_field_callback( $field, $value ) {
                print_r( $field );
                echo '<br/>';
                print_r( $value );
            }

        }

        global $reduxConfig;
        $reduxConfig = new citygov_redux_config();
    } else {
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ):
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    endif;

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ):
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error = true;
            $value = 'just testing';

            /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            
          }
         */

            $return['value'] = $value;
            $field['msg']    = 'your custom error message';
            if ( $error == true ) {
                $return['error'] = $field;
            }

            $return['warning'] = $field;

            return $return;
        }
    endif;


// TMNF admin panel styling	
function citygov__add_css() {
    wp_register_style(
        'redux-tmnf-css',
        get_template_directory_uri() .'/redux-framework/assets/redux-themnific.css',
        array( 'redux-admin-css' ),
        time(),
        'all'
    ); 
    wp_enqueue_style('redux-tmnf-css');
}
add_action( 'redux/page/themnific_redux/enqueue', 'citygov__add_css' );