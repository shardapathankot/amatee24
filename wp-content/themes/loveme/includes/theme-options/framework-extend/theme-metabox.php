<?php
/*
 * All Metabox related options for Loveme theme.
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

function loveme_metabox_options( $options ) {

 $cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
    $contact_forms = array();
    if ( $cf7 ) {
      foreach ( $cf7 as $cform ) {
        $contact_forms[ $cform->ID ] = $cform->post_title;
      }
    } else {
      $contact_forms[ esc_html__( 'No contact forms found', 'loveme' ) ] = 0;
    }
  $options      = array();

  // -----------------------------------------
  // Post Metabox Options                    -
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'post_type_metabox',
    'title'     => esc_html__('Post Options', 'loveme'),
    'post_type' => 'post',
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(

      // All Post Formats
      array(
        'name'   => 'section_post_formats',
        'fields' => array(

          // Standard, Image
          array(
            'title' => 'Standard Image',
            'type'  => 'subheading',
            'content' => esc_html__('There is no Extra Option for this Post Format!', 'loveme'),
            'wrap_class' => 'loveme-minimal-heading hide-title',
          ),
          // Standard, Image

          // Gallery
          array(
            'type'    => 'notice',
            'title'   => 'Gallery Format',
            'wrap_class' => 'hide-title',
            'class'   => 'info cs-loveme-heading',
            'content' => esc_html__('Gallery Format', 'loveme')
          ),
          array(
            'id'          => 'gallery_post_format',
            'type'        => 'gallery',
            'title'       => esc_html__('Add Gallery', 'loveme'),
            'add_title'   => esc_html__('Add Image(s)', 'loveme'),
            'edit_title'  => esc_html__('Edit Image(s)', 'loveme'),
            'clear_title' => esc_html__('Clear Image(s)', 'loveme'),
          ),
          array(
            'type'    => 'text',
            'title'   => esc_html__('Add Video URL', 'loveme' ),
            'id'   => 'video_post_format',
            'desc' => esc_html__('Add youtube or vimeo video link', 'loveme' ),
            'wrap_class' => 'video_post_format',
          ),
          array(
            'type'    => 'icon',
            'title'   => esc_html__('Add Quote Icon', 'loveme' ),
            'id'   => 'quote_post_format',
            'desc' => esc_html__('Add Quote Icon here', 'loveme' ),
            'wrap_class' => 'quote_post_format',
          ),
          // Gallery

        ),
      ),

    ),
  );

  // -----------------------------------------
  // Page Metabox Options                    -
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'page_type_metabox',
    'title'     => esc_html__('Page Custom Options', 'loveme'),
    'post_type' => array('post', 'page'),
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(

      // Title Section
      array(
        'name'  => 'page_topbar_section',
        'title' => esc_html__('Top Bar', 'loveme'),
        'icon'  => 'fa fa-minus',

        // Fields Start
        'fields' => array(

          array(
            'id'           => 'topbar_options',
            'type'         => 'image_select',
            'title'        => esc_html__('Topbar', 'loveme'),
            'options'      => array(
              'default'     => LOVEME_CS_IMAGES .'/topbar-default.png',
              'custom'      => LOVEME_CS_IMAGES .'/topbar-custom.png',
              'hide_topbar' => LOVEME_CS_IMAGES .'/topbar-hide.png',
            ),
            'attributes' => array(
              'data-depend-id' => 'hide_topbar_select',
            ),
            'radio'     => true,
            'default'   => 'default',
          ),
          array(
            'id'          => 'top_left',
            'type'        => 'textarea',
            'title'       => esc_html__('Top Left', 'loveme'),
            'dependency'  => array('hide_topbar_select', '==', 'custom'),
            'shortcode'       => true,
          ),
          array(
            'id'          => 'top_right',
            'type'        => 'textarea',
            'title'       => esc_html__('Top Right', 'loveme'),
            'dependency'  => array('hide_topbar_select', '==', 'custom'),
            'shortcode'       => true,
          ),
          array(
            'id'    => 'topbar_bg',
            'type'  => 'color_picker',
            'title' => esc_html__('Topbar Background Color', 'loveme'),
            'dependency'  => array('hide_topbar_select', '==', 'custom'),
          ),
          array(
            'id'    => 'topbar_border',
            'type'  => 'color_picker',
            'title' => esc_html__('Topbar Border Color', 'loveme'),
            'dependency'  => array('hide_topbar_select', '==', 'custom'),
          ),

        ), // End : Fields

      ), // Title Section

      // Header
      array(
        'name'  => 'header_section',
        'title' => esc_html__('Header', 'loveme'),
        'icon'  => 'fa fa-bars',
        'fields' => array(

          array(
            'id'           => 'select_header_design',
            'type'         => 'image_select',
            'title'        => esc_html__('Select Header Design', 'loveme'),
            'options'      => array(
              'default'     => LOVEME_CS_IMAGES .'/hs-0.png',
              'style_one'   => LOVEME_CS_IMAGES .'/hs-1.png',
              'style_two'   => LOVEME_CS_IMAGES .'/hs-2.png',
              'style_three'   => LOVEME_CS_IMAGES .'/hs-3.png',
            ),
            'attributes' => array(
              'data-depend-id' => 'header_design',
            ),
            'radio'     => true,
            'default'   => 'default',
            'info'      => esc_html__('Select your header design, following options will may differ based on your selection of header design.', 'loveme'),
          ),
          array(
            'id'    => 'transparency_header',
            'type'  => 'switcher',
            'title' => esc_html__('Transparent Header', 'loveme'),
            'info' => esc_html__('Use Transparent Method', 'loveme'),
          ),
          array(
            'id'    => 'transparent_menu_color',
            'type'  => 'color_picker',
            'title' => esc_html__('Menu Color', 'loveme'),
            'info' => esc_html__('Pick your menu color. This color will only apply for non-sticky header mode.', 'loveme'),
            'dependency'   => array('transparency_header', '==', 'true'),
          ),
          array(
            'id'    => 'transparent_menu_hover_color',
            'type'  => 'color_picker',
            'title' => esc_html__('Menu Hover Color', 'loveme'),
            'info' => esc_html__('Pick your menu hover color. This color will only apply for non-sticky header mode.', 'loveme'),
            'dependency'   => array('transparency_header', '==', 'true'),
          ),
          array(
            'id'             => 'choose_menu',
            'type'           => 'select',
            'title'          => esc_html__('Choose Menu', 'loveme'),
            'desc'          => esc_html__('Choose custom menus for this page.', 'loveme'),
            'options'        => 'menus',
            'default_option' => esc_html__('Select your menu', 'loveme'),
          ),

          // Enable & Disable
          array(
            'type'    => 'notice',
            'class'   => 'info cs-loveme-heading',
            'content' => esc_html__('Enable & Disable', 'loveme'),
            'dependency' => array('header_design', '!=', 'default'),
          ),
        ),
      ),
      // Header

      // Banner & Title Area
      array(
        'name'  => 'banner_title_section',
        'title' => esc_html__('Banner & Title Area', 'loveme'),
        'icon'  => 'fa fa-bullhorn',
        'fields' => array(

          array(
            'id'        => 'banner_type',
            'type'      => 'select',
            'title'     => esc_html__('Choose Banner Type', 'loveme'),
            'options'   => array(
              'default-title'    => 'Default Title',
              'revolution-slider' => 'Shortcode [Rev Slider]',
              'hide-title-area'   => 'Hide Title/Banner Area',
            ),
          ),
          array(
            'id'    => 'page_revslider',
            'type'  => 'textarea',
            'title' => esc_html__('Revolution Slider or Any Shortcodes', 'loveme'),
            'desc' => __('Enter any shortcodes that you want to show in this page title area. <br />Eg : Revolution Slider shortcode.', 'loveme'),
            'attributes' => array(
              'placeholder' => esc_html__('Enter your shortcode...', 'loveme'),
            ),
            'dependency'   => array('banner_type', '==', 'revolution-slider'),
          ),
          array(
            'id'    => 'page_custom_title',
            'type'  => 'text',
            'title' => esc_html__('Custom Title', 'loveme'),
            'attributes' => array(
              'placeholder' => esc_html__('Enter your custom title...', 'loveme'),
            ),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),
          array(
            'id'        => 'title_area_spacings',
            'type'      => 'select',
            'title'     => esc_html__('Title Area Spacings', 'loveme'),
            'options'   => array(
              'padding-default' => esc_html__('Default Spacing', 'loveme'),
              'padding-custom' => esc_html__('Custom Padding', 'loveme'),
            ),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),
          array(
            'id'    => 'title_top_spacings',
            'type'  => 'text',
            'title' => esc_html__('Top Spacing', 'loveme'),
            'attributes'  => array( 'placeholder' => '100px' ),
            'dependency'  => array('banner_type|title_area_spacings', '==|==', 'default-title|padding-custom'),
          ),
          array(
            'id'    => 'title_bottom_spacings',
            'type'  => 'text',
            'title' => esc_html__('Bottom Spacing', 'loveme'),
            'attributes'  => array( 'placeholder' => '100px' ),
            'dependency'  => array('banner_type|title_area_spacings', '==|==', 'default-title|padding-custom'),
          ),
          array(
            'id'    => 'title_area_bg',
            'type'  => 'background',
            'title' => esc_html__('Background', 'loveme'),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),
          array(
            'id'    => 'titlebar_bg_overlay_color',
            'type'  => 'color_picker',
            'title' => esc_html__('Overlay Color', 'loveme'),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),
          array(
            'id'    => 'title_color',
            'type'  => 'color_picker',
            'title' => esc_html__('Title Color', 'loveme'),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),

        ),
      ),
      // Banner & Title Area

      // Content Section
      array(
        'name'  => 'page_content_options',
        'title' => esc_html__('Content Options', 'loveme'),
        'icon'  => 'fa fa-file',

        'fields' => array(

          array(
            'id'        => 'content_spacings',
            'type'      => 'select',
            'title'     => esc_html__('Content Spacings', 'loveme'),
            'options'   => array(
              'padding-default' => esc_html__('Default Spacing', 'loveme'),
              'padding-custom' => esc_html__('Custom Padding', 'loveme'),
            ),
            'desc' => esc_html__('Content area top and bottom spacings.', 'loveme'),
          ),
          array(
            'id'    => 'content_top_spacings',
            'type'  => 'text',
            'title' => esc_html__('Top Spacing', 'loveme'),
            'attributes'  => array( 'placeholder' => '100px' ),
            'dependency'  => array('content_spacings', '==', 'padding-custom'),
          ),
          array(
            'id'    => 'content_bottom_spacings',
            'type'  => 'text',
            'title' => esc_html__('Bottom Spacing', 'loveme'),
            'attributes'  => array( 'placeholder' => '100px' ),
            'dependency'  => array('content_spacings', '==', 'padding-custom'),
          ),
          array(
            'id'    => 'box_style',
            'type'  => 'switcher',
            'title' => esc_html__('Content Box Style', 'loveme'),
            'label' => esc_html__('Yes, Please do it.', 'loveme'),
          ),
        ), // End Fields
      ), // Content Section

      // Enable & Disable
      array(
        'name'  => 'hide_show_section',
        'title' => esc_html__('Enable & Disable', 'loveme'),
        'icon'  => 'fa fa-toggle-on',
        'fields' => array(

          array(
            'id'    => 'hide_header',
            'type'  => 'switcher',
            'title' => esc_html__('Hide Header', 'loveme'),
            'label' => esc_html__('Yes, Please do it.', 'loveme'),
          ),
          array(
            'id'    => 'hide_breadcrumbs',
            'type'  => 'switcher',
            'title' => esc_html__('Hide Breadcrumbs', 'loveme'),
            'label' => esc_html__('Yes, Please do it.', 'loveme'),
          ),
          array(
            'id'    => 'hide_footer',
            'type'  => 'switcher',
            'title' => esc_html__('Hide Footer', 'loveme'),
            'label' => esc_html__('Yes, Please do it.', 'loveme'),
          ),
       
        ),
      ),
      // Enable & Disable

    ),
  );

  // -----------------------------------------
  // Page Layout
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'page_layout_options',
    'title'     => esc_html__('Page Layout', 'loveme'),
    'post_type' => 'page',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(

      array(
        'name'   => 'page_layout_section',
        'fields' => array(

          array(
            'id'        => 'page_layout',
            'type'      => 'image_select',
            'options'   => array(
              'full-width'    => LOVEME_CS_IMAGES . '/page-1.png',
              'extra-width'   => LOVEME_CS_IMAGES . '/page-2.png',
              'left-sidebar'  => LOVEME_CS_IMAGES . '/page-3.png',
              'right-sidebar' => LOVEME_CS_IMAGES . '/page-4.png',
            ),
            'attributes' => array(
              'data-depend-id' => 'page_layout',
            ),
            'default'    => 'full-width',
            'radio'      => true,
            'wrap_class' => 'text-center',
          ),
          array(
            'id'            => 'page_sidebar_widget',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Widget', 'loveme'),
            'options'        => loveme_registered_sidebars(),
            'default_option' => esc_html__('Select Widget', 'loveme'),
            'dependency'   => array('page_layout', 'any', 'left-sidebar,right-sidebar'),
          ),

        ),
      ),

    ),
  );

 // -----------------------------------------
  // Team
  // -----------------------------------------

  $options[]    = array(
    'id'        => 'team_options',
    'title'     => esc_html__('Team Meta', 'loveme'),
    'post_type' => 'team',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(
      array(
        'name'   => 'team_infos',
        'fields' => array(
          array(
            'title'   => esc_html__('Team Title', 'loveme'),
            'id'      => 'team_title',
            'type'    => 'text',
            'attributes' => array(
              'placeholder' => esc_html__('Jhon Deno', 'loveme'),
            ),
            'info'    => esc_html__('Write Team Title.', 'loveme'),

          ),
          array(
            'title'   => esc_html__('Team Sub Title', 'loveme'),
            'id'      => 'team_subtitle',
            'type'    => 'text',
             'attributes' => array(
              'placeholder' => esc_html__('Planner', 'loveme'),
            ),
            'info'    => esc_html__('Write Team Sub Title.', 'loveme'),
          ),
          // Start fields
          array(
            'id'                  => 'team_infos',
            'title'   => esc_html__('Team Info', 'loveme'),
            'type'                => 'group',
            'fields'              => array(
              array(
                'id'              => 'info_title',
                'type'            => 'text',
                'title'           => esc_html__('Info Title', 'loveme'),
              ),
              array(
                'id'              => 'info_desc',
                'type'            => 'text',
                'title'           => esc_html__('Info Description', 'loveme'),
              ),
            ),
            'button_title'        => esc_html__('Add Team info', 'loveme'),
            'accordion_title'     => esc_html__('team Info', 'loveme'),
          ),
          array(
            'id'                  => 'team_socials',
            'title'   => esc_html__('Team Social', 'loveme'),
            'type'                => 'group',
            'fields'              => array(
              array(
                'id'              => 'team_social_icon',
                'type'            => 'icon',
                'title'           => esc_html__('Social Icon', 'loveme'),
              ),
              array(
                'id'              => 'team_social_link',
                'type'            => 'text',
                'title'           => esc_html__('URL', 'loveme'),
              ),
            ),
            'button_title'        => esc_html__('Add Social Icon', 'loveme'),
            'accordion_title'     => esc_html__('Social Icons', 'loveme'),
          ),
         array(
            'id'           => 'team_image',
            'type'         => 'image',
            'title'        => esc_html__('Team Grid Image', 'loveme'),
            'add_title' => esc_html__('Team Image', 'loveme'),
            'info'    => esc_html__('Attached Team Grid Image.', 'loveme'),
          ),

        ),
      ),
    ),
  );

// -----------------------------------------
  // Project
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'project_options',
    'title'     => esc_html__('Project Extra Options', 'loveme'),
    'post_type' => 'project',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(

      array(
        'name'   => 'project_option_section',
        'fields' => array(
          array(
            'id'           => 'project_title',
            'type'         => 'text',
            'title'        => esc_html__('Project title', 'loveme'),
            'add_title' => esc_html__('Add Project title', 'loveme'),
            'attributes' => array(
              'placeholder' => esc_html__('Project Title', 'loveme'),
            ),
            'info'    => esc_html__('Write Project Title.', 'loveme'),
          ), 
          array(
            'id'           => 'project_subtitle',
            'type'         => 'text',
            'title'        => esc_html__('Project subtitle', 'loveme'),
            'add_title' => esc_html__('Add Project subtitle', 'loveme'),
            'attributes' => array(
              'placeholder' => esc_html__('Project Sub Title', 'loveme'),
            ),
            'info'    => esc_html__('Write Project Sub Title.', 'loveme'),
          ),   
          array(
            'id'           => 'project_image',
            'type'         => 'image',
            'title'        => esc_html__('Project Image', 'loveme'),
            'add_title' => esc_html__('Add Project Image', 'loveme'),
          ),
           // Start fields
        ),
      ),

    ),
  );



 // -----------------------------------------
  // Service
  // -----------------------------------------

  $options[]    = array(
    'id'        => 'service_options',
    'title'     => esc_html__('Service Meta', 'loveme'),
    'post_type' => 'service',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(
      array(
        'name'   => 'service_infos',
        'fields' => array(
          array(
            'title'   => esc_html__('Service Title', 'loveme'),
            'id'      => 'service_title',
            'type'    => 'text',
            'attributes' => array(
              'placeholder' => esc_html__('Jhon Deno', 'loveme'),
            ),
            'info'    => esc_html__('Write Service Title.', 'loveme'),

          ),
         array(
            'id'           => 'grid_image',
            'type'         => 'image',
            'title'        => esc_html__('Service Image', 'loveme'),
            'add_title' => esc_html__('Service Image', 'loveme'),
            'info'    => esc_html__('Attached Image.', 'loveme'),
          ),
         array(
            'id'           => 'flate_icon',
            'type'         => 'icon',
            'title'        => esc_html__('Service Icon', 'loveme'),
            'add_title' => esc_html__('Service Icon', 'loveme'),
            'info'    => esc_html__('Attached Icon.', 'loveme'),
          ),
         array(
            'id'           => 'service_excerpt',
            'type'         => 'textarea',
            'title'        => esc_html__('Service Excerpt', 'loveme'),
            'add_title' => esc_html__('Service excerpt', 'loveme'),
            'info'    => esc_html__('Attached excerpt.', 'loveme'),
          ),

        ),
      ),
    ),
  );


if (class_exists( 'WooCommerce' )){ 
   // -----------------------------------------
    // Product
    // -----------------------------------------
    $options[]    = array(
      'id'        => 'loveme_woocommerce_section',
      'title'     => esc_html__('Product Custom Options', 'loveme'),
      'post_type' => 'product',
      'context'   => 'normal',
      'priority'  => 'high',
      'sections'  => array(

        // All Post Formats
        array(
          'name'   => 'loveme_single_title',
          'fields' => array(
            array(
              'id'          => 'loveme_product_title',
              'type'        => 'text',
              'title'       => esc_html__('Single Title', 'loveme'),
              'attributes' => array(
                'placeholder' => 'The Title Gose Here'
              ),
            ),
            array(
              'id'           => 'product_carousel',
              'type'         => 'image',
              'title'        => esc_html__('Carousel  Image', 'loveme'),
              'add_title' => esc_html__('Add Carousel  Image', 'loveme'),
            ),
            array(
              'id'           => 'product_grid',
              'type'         => 'image',
              'title'        => esc_html__('Grid  Image', 'loveme'),
              'add_title' => esc_html__('Add Grid  Image', 'loveme'),
            ),

          ),
        ),

      ),
    );
}
// -----------------------------------------
  // Donation Forms
  // -----------------------------------------
  $options[]    = array(
    'id'        => '_donation_form_metabox',
    'title'     => esc_html__('Donation Deadline', 'loveme'),
    'post_type' => 'give_forms',
    'context'   => 'normal',
    'priority'  => 'high',
    'sections'  => array(

      // All Post Formats
      array(
        'name'   => 'section_deadline',
        'fields' => array(
          array(
            'id'          => 'donation_deadline',
            'type'        => 'text',
            'title'       => esc_html__('Deadline Date', 'loveme'),
            'attributes' => array(
              'placeholder' => 'DD/MM/YYYY'
            ),
          ),
          // Gallery

        ),
      ),

    ),
  );
  
  // -----------------------------------------
  // Causes
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'causes_options',
    'title'     => esc_html__('Causes Extra Options', 'loveme'),
    'post_type' => 'give_forms',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(

      array(
        'name'   => 'causes_option_section',
        'fields' => array(
         array(
            'id'           => 'causes_image',
            'type'         => 'image',
            'title'        => esc_html__('Causes Image', 'loveme'),
            'add_title' => esc_html__('Add Causes Image', 'loveme'),
          ),
         array(
            'id'           => 'case_form_title',
            'type'         => 'text',
            'default'    => 'Donate Now',
            'title'        => esc_html__('Form Title', 'loveme'),
            'add_title' => esc_html__('Add Form Title here', 'loveme'),
          ),
        ),
      ),

    ),
  );

  // -----------------------------------------
  // post options
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'post_options',
    'title'     => esc_html__('Grid Image', 'loveme'),
    'post_type' => 'post',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(
      array(
        'name'   => 'post_option_section',
        'fields' => array(
          array(
            'id'           => 'widget_post_title',
            'type'         => 'text',
            'title'        => esc_html__('Widget Post Title', 'loveme'),
            'add_title' => esc_html__('Add Widget Post Title here', 'loveme'),
          ),
          array(
            'id'           => 'grid_image',
            'type'         => 'image',
            'title'        => esc_html__('Post Grid Image', 'loveme'),
            'add_title' => esc_html__('Add Post Grid Image', 'loveme'),
          ),
        ),
      ),

    ),
  );


  return $options;

}
add_filter( 'cs_metabox_options', 'loveme_metabox_options' );