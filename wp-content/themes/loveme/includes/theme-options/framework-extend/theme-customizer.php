<?php
/*
 * All customizer related options for Loveme theme.
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

if( ! function_exists( 'loveme_customizer' ) ) {
  function loveme_customizer( $options ) {

	$options        = array(); // remove old options

	// Primary Color
	$options[]      = array(
	  'name'        => 'elemets_color_section',
	  'title'       => esc_html__('Primary Color', 'loveme'),
	  'settings'    => array(

	    // Fields Start
			array(
				'name'      => 'all_element_colors',
				'default'   => '#835845',
				'control'   => array(
					'type'    => 'cs_field',
					'options' => array(
						'type'  => 'color_picker',
						'title' => esc_html__('Elements Color', 'loveme'),
						'info'    => esc_html__('This is theme primary color, means it\'ll affect all elements that have default color of our theme primary color.', 'loveme'),
					),
				),
			),
			array(
				'name'      => 'all_element_bg_colors',
				'default'   => '#835845',
				'control'   => array(
					'type'    => 'cs_field',
					'options' => array(
						'type'  => 'color_picker',
						'title' => esc_html__('Elements Background Color', 'loveme'),
						'info'    => esc_html__('This is theme primary Hover color, means it\'ll affect all elements that have default color of our theme primary color.', 'loveme'),
					),
				),
			),
	    // Fields End

	  )
	);
	// Primary Color

	// Preloader Color
	$options[]      = array(
	  'name'        => 'preloader_color_section',
	  'title'       => esc_html__('Preloader Color', 'loveme'),
	  'settings'    => array(

	    // Fields Start
			array(
				'name'      => 'preloader_bg_colors',
				'default'   => '#86a0b6',
				'control'   => array(
					'type'    => 'cs_field',
					'options' => array(
						'type'  => 'color_picker',
						'title' => esc_html__('Preloader Color', 'loveme'),
						'info'    => esc_html__('This is theme Preloader Background color, means it\'ll Preloader Background Color that have default color of our theme primary color.', 'loveme'),
					),
				),
			),
	    // Fields End

	  )
	);
	// Primary Color

	// header Color
	$options[]      = array(
	  'name'        => 'topbar_color_section',
	  'title'       => esc_html__('01. Header Topbar Colors', 'loveme'),
	  'settings'    => array(

	    // Fields Start
	    array(
				'name'          => 'topbar_bg_heading',
				'control'       => array(
					'type'        => 'cs_field',
					'options'     => array(
						'type'      => 'notice',
						'class'     => 'info',
						'content'   => esc_html__('header Color', 'loveme'),
					),
				),
			),
			array(
				'name'      => 'topbar_bg_color',
				'control'   => array(
					'type'    => 'cs_field',
					'options' => array(
						'type'  => 'color_picker',
						'title' => esc_html__('Background Color', 'loveme'),
					),
				),
			),
			array(
				'name'          => 'topbar_text_heading',
				'control'       => array(
					'type'        => 'cs_field',
					'options'     => array(
						'type'      => 'notice',
						'class'     => 'info',
						'content'   => esc_html__('Common Color', 'loveme'),
					),
				),
			),
			array(
				'name'      => 'topbar_text_color',
				'control'   => array(
					'type'    => 'cs_field',
					'options' => array(
						'type'  => 'color_picker',
						'title' => esc_html__('Header Topbar Text Color', 'loveme'),
					),
				),
			),
			array(
				'name'      => 'topbar_icon_color',
				'control'   => array(
					'type'    => 'cs_field',
					'options' => array(
						'type'  => 'color_picker',
						'title' => esc_html__('header Topbar Icon Color', 'loveme'),
					),
				),
			),

	  )
	);
	// Header topbar Color

	// Menu Color
	$options[]      = array(
	  'name'        => 'header_color_section',
	  'title'       => esc_html__('02. Menu Colors', 'loveme'),
	  'settings'    => array(

	    // Fields Start
			array(
				'name'          => 'header_main_menu_heading',
				'control'       => array(
					'type'        => 'cs_field',
					'options'     => array(
						'type'      => 'notice',
						'class'     => 'info',
						'content'   => esc_html__('Main Menu Colors', 'loveme'),
					),
				),
			),
			array(
				'name'      => 'menu_bg_color',
				'control'   => array(
					'type'    => 'cs_field',
					'options' => array(
						'type'  => 'color_picker',
						'title' => esc_html__('Background Color', 'loveme'),
					),
				),
			),
			array(
				'name'      => 'menu_link_color',
				'control'   => array(
					'type'    => 'cs_field',
					'options' => array(
						'type'  => 'color_picker',
						'title' => esc_html__('Link Color', 'loveme'),
					),
				),
			),
			array(
				'name'      => 'menu_link_hover_color',
				'control'   => array(
					'type'    => 'cs_field',
					'options' => array(
						'type'  => 'color_picker',
						'title' => esc_html__('Link Hover Color', 'loveme'),
					),
				),
			),

			// Sub Menu Color
			array(
				'name'          => 'header_submenu_heading',
				'control'       => array(
					'type'        => 'cs_field',
					'options'     => array(
						'type'      => 'notice',
						'class'     => 'info',
						'content'   => esc_html__('Sub-Menu Colors', 'loveme'),
					),
				),
			),
			array(
				'name'      => 'submenu_bg_color',
				'control'   => array(
					'type'    => 'cs_field',
					'options' => array(
						'type'  => 'color_picker',
						'title' => esc_html__('Background Color', 'loveme'),
					),
				),
			),
			array(
				'name'      => 'submenu_bg_hover_color',
				'control'   => array(
					'type'    => 'cs_field',
					'options' => array(
						'type'  => 'color_picker',
						'title' => esc_html__('Background Hover Color', 'loveme'),
					),
				),
			),
			array(
				'name'      => 'submenu_link_color',
				'control'   => array(
					'type'    => 'cs_field',
					'options' => array(
						'type'  => 'color_picker',
						'title' => esc_html__('Link Color', 'loveme'),
					),
				),
			),
			array(
				'name'      => 'submenu_link_hover_color',
				'control'   => array(
					'type'    => 'cs_field',
					'options' => array(
						'type'  => 'color_picker',
						'title' => esc_html__('Link Hover Color', 'loveme'),
					),
				),
			),
	    // Fields End

			// Responsive Menu Color
			array(
				'name'          => 'header_responsive_menu_heading',
				'control'       => array(
					'type'        => 'cs_field',
					'options'     => array(
						'type'      => 'notice',
						'class'     => 'info',
						'content'   => esc_html__('Responsive Menu Colors', 'loveme'),
					),
				),
			),
			array(
				'name'      => 'menu_responsive_menu_color',
				'control'   => array(
					'type'    => 'cs_field',
					'options' => array(
						'type'  => 'color_picker',
						'title' => esc_html__('Responsive Menu Color', 'loveme'),
					),
				),
			),
			array(
				'name'      => 'menu_responsive_menu_bg_color',
				'control'   => array(
					'type'    => 'cs_field',
					'options' => array(
						'type'  => 'color_picker',
						'title' => esc_html__('Responsive Menu Background', 'loveme'),
					),
				),
			),
			array(
				'name'      => 'responsive_menu_hover_color',
				'control'   => array(
					'type'    => 'cs_field',
					'options' => array(
						'type'  => 'color_picker',
						'title' => esc_html__('Responsive Menu Hover Color', 'loveme'),
					),
				),
			),
	    // Fields End

			//Menu Button Color
			array(
				'name'          => 'header_button_heading',
				'control'       => array(
					'type'        => 'cs_field',
					'options'     => array(
						'type'      => 'notice',
						'class'     => 'info',
						'content'   => esc_html__('Menu Button Colors', 'loveme'),
					),
				),
			),
			array(
				'name'      => 'menu_button_color',
				'control'   => array(
					'type'    => 'cs_field',
					'options' => array(
						'type'  => 'color_picker',
						'title' => esc_html__('Button Color', 'loveme'),
					),
				),
			),
			array(
				'name'      => 'menu_button_bg_color',
				'control'   => array(
					'type'    => 'cs_field',
					'options' => array(
						'type'  => 'color_picker',
						'title' => esc_html__('Button Background Color', 'loveme'),
					),
				),
			),
	    // Fields End

	  )
	);
	// Header Color

	// Title Bar Color
	$options[]      = array(
	  'name'        => 'titlebar_section',
	  'title'       => esc_html__('03. Title Bar Colors', 'loveme'),
    'settings'      => array(

    	// Fields Start
    	array(
				'name'          => 'titlebar_colors_heading',
				'control'       => array(
					'type'        => 'cs_field',
					'options'     => array(
						'type'      => 'notice',
						'class'     => 'info',
						'content'   => __('<h2 style="margin: 0;text-align: center;">Title Colors</h2> <br /> This is common settings, if this settings not affect in your page. Please check your page metabox. You may set default settings there.', 'loveme'),
					),
				),
			),
    	array(
				'name'      => 'titlebar_bg_color',
				'control'   => array(
					'type'    => 'cs_field',
					'options' => array(
						'type'  => 'color_picker',
						'title' => esc_html__('Title Bar Background Color', 'loveme'),
					),
				),
			),
    	array(
				'name'      => 'titlebar_bg_color',
				'control'   => array(
					'type'    => 'cs_field',
					'options' => array(
						'type'  => 'color_picker',
						'title' => esc_html__('Title Bar Background Color', 'loveme'),
					),
				),
			),
    	array(
				'name'      => 'titlebar_title_color',
				'control'   => array(
					'type'    => 'cs_field',
					'options' => array(
						'type'  => 'color_picker',
						'title' => esc_html__('Title Color', 'loveme'),
					),
				),
			),

			array(
				'name'          => 'titlebar_breadcrumbs_heading',
				'control'       => array(
					'type'        => 'cs_field',
					'options'     => array(
						'type'      => 'notice',
						'class'     => 'info',
						'content'   => esc_html__('Breadcrumbs Colors', 'loveme'),
					),
				),
			),
    	array(
				'name'      => 'breadcrumbs_text_color',
				'control'   => array(
					'type'    => 'cs_field',
					'options' => array(
						'type'  => 'color_picker',
						'title' => esc_html__('Text Color', 'loveme'),
					),
				),
			),
			array(
				'name'      => 'breadcrumbs_link_color',
				'control'   => array(
					'type'    => 'cs_field',
					'options' => array(
						'type'  => 'color_picker',
						'title' => esc_html__('Link Color', 'loveme'),
					),
				),
			),
			array(
				'name'      => 'breadcrumbs_link_hover_color',
				'control'   => array(
					'type'    => 'cs_field',
					'options' => array(
						'type'  => 'color_picker',
						'title' => esc_html__('Link Hover Color', 'loveme'),
					),
				),
			),
	    // Fields End

	  )
	);
	// Title Bar Color

	// Content Color
	$options[]      = array(
	  'name'        => 'content_section',
	  'title'       => esc_html__('04. Content Colors', 'loveme'),
	  'description' => esc_html__('This is all about content area text and heading colors.', 'loveme'),
	  'sections'    => array(

	  	array(
	      'name'          => 'content_text_section',
	      'title'         => esc_html__('Content Text', 'loveme'),
	      'settings'      => array(

			    // Fields Start
			    array(
						'name'      => 'body_color',
						'control'   => array(
							'type'    => 'cs_field',
							'options' => array(
								'type'  => 'color_picker',
								'title' => esc_html__('Body & Content Color', 'loveme'),
							),
						),
					),
					array(
						'name'      => 'body_links_color',
						'control'   => array(
							'type'    => 'cs_field',
							'options' => array(
								'type'  => 'color_picker',
								'title' => esc_html__('Body Links Color', 'loveme'),
							),
						),
					),
					array(
						'name'      => 'body_link_hover_color',
						'control'   => array(
							'type'    => 'cs_field',
							'options' => array(
								'type'  => 'color_picker',
								'title' => esc_html__('Body Links Hover Color', 'loveme'),
							),
						),
					),
					array(
						'name'      => 'sidebar_content_color',
						'control'   => array(
							'type'    => 'cs_field',
							'options' => array(
								'type'  => 'color_picker',
								'title' => esc_html__('Sidebar Content Color', 'loveme'),
							),
						),
					),
			    // Fields End
			  )
			),

			// Text Colors Section
			array(
	      'name'          => 'content_heading_section',
	      'title'         => esc_html__('Headings', 'loveme'),
	      'settings'      => array(

	      	// Fields Start
					array(
						'name'      => 'content_heading_color',
						'control'   => array(
							'type'    => 'cs_field',
							'options' => array(
								'type'  => 'color_picker',
								'title' => esc_html__('Content Heading Color', 'loveme'),
							),
						),
					),
	      	array(
						'name'      => 'sidebar_heading_color',
						'control'   => array(
							'type'    => 'cs_field',
							'options' => array(
								'type'  => 'color_picker',
								'title' => esc_html__('Sidebar Heading Color', 'loveme'),
							),
						),
					),
			    // Fields End

      	)
      ),

	  )
	);
	// Content Color

	// Footer Color
	$options[]      = array(
	  'name'        => 'footer_section',
	  'title'       => esc_html__('05. Footer Colors', 'loveme'),
	  'description' => esc_html__('This is all about footer settings. Make sure you\'ve enabled your needed section at : Loveme > Theme Options > Footer ', 'loveme'),
	  'sections'    => array(

			// Footer Widgets Block
	  	array(
	      'name'          => 'footer_widget_section',
	      'title'         => esc_html__('Widget Block', 'loveme'),
	      'settings'      => array(

			    // Fields Start
					array(
			      'name'          => 'footer_widget_color_notice',
			      'control'       => array(
			        'type'        => 'cs_field',
			        'options'     => array(
			          'type'      => 'notice',
			          'class'     => 'info',
			          'content'   => esc_html__('Content Colors', 'loveme'),
			        ),
			      ),
			    ),
					array(
						'name'      => 'footer_heading_color',
						'control'   => array(
							'type'    => 'cs_field',
							'options' => array(
								'type'  => 'color_picker',
								'title' => esc_html__('Widget Heading Color', 'loveme'),
							),
						),
					),
					array(
						'name'      => 'footer_text_color',
						'control'   => array(
							'type'    => 'cs_field',
							'options' => array(
								'type'  => 'color_picker',
								'title' => esc_html__('Widget Text Color', 'loveme'),
							),
						),
					),
					array(
						'name'      => 'footer_link_color',
						'control'   => array(
							'type'    => 'cs_field',
							'options' => array(
								'type'  => 'color_picker',
								'title' => esc_html__('Widget Link Color', 'loveme'),
							),
						),
					),
					array(
						'name'      => 'footer_link_hover_color',
						'control'   => array(
							'type'    => 'cs_field',
							'options' => array(
								'type'  => 'color_picker',
								'title' => esc_html__('Widget Link Hover Color', 'loveme'),
							),
						),
					),
					array(
						'name'      => 'footer_bg_color',
						'default'   => '#0a172b',
						'control'   => array(
							'type'    => 'cs_field',
							'options' => array(
								'type'  => 'color_picker',
								'title' => esc_html__('Background Color', 'loveme'),
							),
						),
					),
			    // Fields End
			  )
			),
			// Footer Widgets Block

			// Footer Copyright Block
	  	array(
	      'name'          => 'footer_copyright_section',
	      'title'         => esc_html__('Copyright Block', 'loveme'),
	      'settings'      => array(

			    // Fields Start
			    array(
			      'name'          => 'footer_copyright_active',
			      'control'       => array(
			        'type'        => 'cs_field',
			        'options'     => array(
			          'type'      => 'notice',
			          'class'     => 'info',
			          'content'   => esc_html__('Make sure you\'ve enabled copyright block in : <br /> <strong>Loveme > Theme Options > Footer > Copyright Bar : Enable Copyright Block</strong>', 'loveme'),
			        ),
			      ),
			    ),
					array(
						'name'      => 'copyright_text_color',
						'control'   => array(
							'type'    => 'cs_field',
							'options' => array(
								'type'  => 'color_picker',
								'title' => esc_html__('Text Color', 'loveme'),
							),
						),
					),
					array(
						'name'      => 'copyright_link_color',
						'control'   => array(
							'type'    => 'cs_field',
							'options' => array(
								'type'  => 'color_picker',
								'title' => esc_html__('Link Color', 'loveme'),
							),
						),
					),
					array(
						'name'      => 'copyright_link_hover_color',
						'control'   => array(
							'type'    => 'cs_field',
							'options' => array(
								'type'  => 'color_picker',
								'title' => esc_html__('Link Hover Color', 'loveme'),
							),
						),
					),
					array(
						'name'      => 'copyright_bg_color',
						'control'   => array(
							'type'    => 'cs_field',
							'options' => array(
								'type'  => 'color_picker',
								'title' => esc_html__('Background Color', 'loveme'),
							),
						),
					),
					array(
						'name'      => 'copyright_border_color',
						'default'   => 'rgba(255, 255, 255, 0.07)',
						'control'   => array(
							'type'    => 'cs_field',
							'options' => array(
								'type'  => 'color_picker',
								'title' => esc_html__('Border Color', 'loveme'),
							),
						),
					),

			  )
			),
			// Footer Copyright Block

	  )
	);
	// Footer Color

	return $options;

  }
  add_filter( 'cs_customize_options', 'loveme_customizer' );
}