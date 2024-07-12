<?php
/*
 * All Theme Options for Loveme theme.
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

function loveme_settings( $settings ) {

  $settings           = array(
    'menu_title'      => LOVEME_NAME . esc_html__(' Options', 'loveme'),
    'menu_slug'       => sanitize_title(LOVEME_NAME) . '_options',
    'menu_type'       => 'theme',
    'menu_icon'       => 'dashicons-awards',
    'menu_position'   => '4',
    'ajax_save'       => false,
    'show_reset_all'  => true,
    'framework_title' => LOVEME_NAME .' <small>V-'. LOVEME_VERSION .' by <a href="'. LOVEME_BRAND_URL .'" target="_blank">'. LOVEME_BRAND_NAME .'</a></small>',
  );

  return $settings;

}
add_filter( 'cs_framework_settings', 'loveme_settings' );

// Theme Framework Options
function loveme_options( $options ) {

  $options      = array(); // remove old options

  // ------------------------------
  // Branding
  // ------------------------------
  $options[]   = array(
    'name'     => 'loveme_theme_branding',
    'title'    => esc_html__('Brand Settings', 'loveme'),
    'icon'     => 'fa fa-address-book-o',
    'sections' => array(

      // brand logo tab
      array(
        'name'     => 'brand_logo',
        'title'    => esc_html__('Logo', 'loveme'),
        'icon'     => 'fa fa-picture-o',
        'fields'   => array(

          // Site Logo
          array(
            'type'    => 'notice',
            'class'   => 'info cs-loveme-heading',
            'content' => esc_html__('Site Logo', 'loveme')
          ),
          array(
            'id'    => 'loveme_logo',
            'type'  => 'image',
            'title' => esc_html__('Default Logo', 'loveme'),
            'info'  => esc_html__('Upload your default logo here. If you not upload, then site title will load in this logo location.', 'loveme'),
            'add_title' => esc_html__('Add Logo', 'loveme'),
          ),
          array(
            'id'    => 'loveme_trlogo',
            'type'  => 'image',
            'title' => esc_html__('Transparent Logo', 'loveme'),
            'info'  => esc_html__('Upload your Transparent logo here. If you not upload, then site title will load in this logo location.', 'loveme'),
            'add_title' => esc_html__('Add Logo', 'loveme'),
          ),
          array(
            'id'          => 'loveme_logo_width',
            'type'        => 'number',
            'title'       => esc_html__('Logo Max Width', 'loveme'),
            'attributes'  => array( 'Max Width' => 250 ),
            'unit'        => 'px',
          ),
          array(
            'id'          => 'loveme_logo_top',
            'type'        => 'number',
            'title'       => esc_html__('Logo Top Space', 'loveme'),
            'attributes'  => array( 'placeholder' => 5 ),
            'unit'        => 'px',
          ),
          array(
            'id'          => 'loveme_logo_bottom',
            'type'        => 'number',
            'title'       => esc_html__('Logo Bottom Space', 'loveme'),
            'attributes'  => array( 'placeholder' => 5 ),
            'unit'        => 'px',
          ),
          // WordPress Admin Logo
          array(
            'type'    => 'notice',
            'class'   => 'info cs-loveme-heading',
            'content' => esc_html__('WordPress Admin Logo', 'loveme')
          ),
          array(
            'id'    => 'brand_logo_wp',
            'type'  => 'image',
            'title' => esc_html__('Login logo', 'loveme'),
            'info'  => esc_html__('Upload your WordPress login page logo here.', 'loveme'),
            'add_title' => esc_html__('Add Login Logo', 'loveme'),
          ),
        ) // end: fields
      ), // end: section
    ),
  );

  // ------------------------------
  // Layout
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_layout',
    'title'  => esc_html__('Layout', 'loveme'),
    'icon'   => 'fa fa-file-text'
  );

  $options[]      = array(
    'name'        => 'theme_general',
    'title'       => esc_html__('General Settings', 'loveme'),
    'icon'        => 'fa fa-cog',

    // begin: fields
    'fields'      => array(

      // -----------------------------
      // Begin: Responsive
      // -----------------------------
       array(
        'id'    => 'theme_responsive',
        'off_text'  => 'No',
        'on_text'  => 'Yes',
        'type'  => 'switcher',
        'title' => esc_html__('Responsive', 'loveme'),
        'info' => esc_html__('Turn on if you don\'t want your site to be responsive.', 'loveme'),
        'default' => false,
      ),
      array(
        'id'    => 'theme_preloder',
        'off_text'  => 'No',
        'on_text'  => 'Yes',
        'type'  => 'switcher',
        'title' => esc_html__('Preloder', 'loveme'),
        'info' => esc_html__('Turn off if you don\'t want your site to be Preloder.', 'loveme'),
        'default' => true,
      ),
      array(
        'id'    => 'preloader_image',
        'type'  => 'image',
        'title' => esc_html__('Preloader Logo', 'loveme'),
        'info'  => esc_html__('Upload your preoader logo here. If you not upload, then site preoader will load in this preloader location.', 'loveme'),
        'add_title' => esc_html__('Add Logo', 'loveme'),
        'dependency' => array( 'theme_preloder', '==', 'true' ),
      ),
      array(
        'id'    => 'theme_layout_width',
        'type'  => 'image_select',
        'title' => esc_html__('Full Width & Extra Width', 'loveme'),
        'info' => esc_html__('Boxed or Fullwidth? Choose your site layout width. Default : Full Width', 'loveme'),
        'options'      => array(
          'container'    => LOVEME_CS_IMAGES .'/boxed-width.jpg',
          'container-fluid'    => LOVEME_CS_IMAGES .'/full-width.jpg',
        ),
        'default'      => 'container-fluid',
        'radio'      => true,
      ),
       array(
        'id'    => 'theme_page_comments',
        'type'  => 'switcher',
        'title' => esc_html__('Hide Page Comments?', 'loveme'),
        'label' => esc_html__('Yes! Hide Page Comments.', 'loveme'),
        'on_text' => esc_html__('Yes', 'loveme'),
        'off_text' => esc_html__('No', 'loveme'),
        'default' => false,
      ),
      array(
        'type'    => 'notice',
        'class'   => 'info cs-loveme-heading',
        'content' => esc_html__('Background Options', 'loveme'),
        'dependency' => array( 'theme_layout_width_container', '==', 'true' ),
      ),
      array(
        'id'             => 'theme_layout_bg_type',
        'type'           => 'select',
        'title'          => esc_html__('Background Type', 'loveme'),
        'options'        => array(
          'bg-image' => esc_html__('Image', 'loveme'),
          'bg-pattern' => esc_html__('Pattern', 'loveme'),
        ),
        'dependency' => array( 'theme_layout_width_container', '==', 'true' ),
      ),
      array(
        'id'    => 'theme_layout_bg_pattern',
        'type'  => 'image_select',
        'title' => esc_html__('Background Pattern', 'loveme'),
        'info' => esc_html__('Select background pattern', 'loveme'),
        'options'      => array(
          'pattern-1'    => LOVEME_CS_IMAGES . '/pattern-1.png',
          'pattern-2'    => LOVEME_CS_IMAGES . '/pattern-2.png',
          'pattern-3'    => LOVEME_CS_IMAGES . '/pattern-3.png',
          'pattern-4'    => LOVEME_CS_IMAGES . '/pattern-4.png',
          'custom-pattern'  => LOVEME_CS_IMAGES . '/pattern-5.png',
        ),
        'default'      => 'pattern-1',
        'radio'      => true,
        'dependency' => array( 'theme_layout_width_container|theme_layout_bg_type', '==|==', 'true|bg-pattern' ),
      ),
      array(
        'id'      => 'custom_bg_pattern',
        'type'    => 'upload',
        'title'   => esc_html__('Custom Pattern', 'loveme'),
        'dependency' => array( 'theme_layout_width_container|theme_layout_bg_type|theme_layout_bg_pattern_custom-pattern', '==|==|==', 'true|bg-pattern|true' ),
        'info' => __('Select your custom background pattern. <br />Note, background pattern image will be repeat in all x and y axis. So, please consider all repeatable area will perfectly fit your custom patterns.', 'loveme'),
      ),
      array(
        'id'      => 'theme_layout_bg',
        'type'    => 'background',
        'title'   => esc_html__('Background', 'loveme'),
        'dependency' => array( 'theme_layout_width_container|theme_layout_bg_type', '==|==', 'true|bg-image' ),
      ),

    ), // end: fields

  );

  // ------------------------------
  // Header Sections
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_header_tab',
    'title'    => esc_html__('Header Settings', 'loveme'),
    'icon'     => 'fa fa-sliders',
    'sections' => array(

      // header design tab
      array(
        'name'     => 'header_design_tab',
        'title'    => esc_html__('Design', 'loveme'),
        'icon'     => 'fa fa-magic',
        'fields'   => array(

          // Header Select
          array(
            'id'           => 'select_header_design',
            'type'         => 'image_select',
            'title'        => esc_html__('Select Header Design', 'loveme'),
            'options'      => array(
              'style_one'    => LOVEME_CS_IMAGES .'/hs-1.png',
              'style_two'    => LOVEME_CS_IMAGES .'/hs-2.png',
              'style_three'    => LOVEME_CS_IMAGES .'/hs-3.png',
            ),
            'attributes' => array(
              'data-depend-id' => 'header_design',
            ),
            'radio'        => true,
            'default'   => 'style_one',
            'info' => esc_html__('Select your header design, following options will may differ based on your selection of header design.', 'loveme'),
          ),
          // Header Select

          // Extra's
          array(
            'type'    => 'notice',
            'class'   => 'info cs-loveme-heading',
            'content' => esc_html__('Extra\'s', 'loveme'),
          ),
          array(
            'id'    => 'sticky_header',
            'type'  => 'switcher',
            'title' => esc_html__('Sticky Header', 'loveme'),
            'info' => esc_html__('Turn On if you want your naviagtion bar on sticky.', 'loveme'),
            'default' => true,
          ),
          array(
            'id'    => 'loveme_cart_widget',
            'type'  => 'switcher',
            'title' => esc_html__('Header Cart', 'loveme'),
            'info' => esc_html__('Turn On if you want to Show Header Cart .', 'loveme'),
            'default' => false,
          ),
          array(
            'id'    => 'loveme_header_search',
            'type'  => 'switcher',
            'title' => esc_html__('Header Search', 'loveme'),
            'info' => esc_html__('Turn On if you want to Hide Header Search .', 'loveme'),
            'default' => false,
          ),
        )
      ),

      // header top bar
      array(
        'name'     => 'header_top_bar_tab',
        'title'    => esc_html__('Top Bar', 'loveme'),
        'icon'     => 'fa fa-minus',
        'fields'   => array(

          array(
            'id'          => 'top_bar',
            'type'        => 'switcher',
            'title'       => esc_html__('Hide Top Bar', 'loveme'),
            'on_text'     => esc_html__('Yes', 'loveme'),
            'off_text'    => esc_html__('No', 'loveme'),
            'default'     => true,
          ),
          array(
            'id'          => 'top_left',
            'title'       => esc_html__('Top left Block', 'loveme'),
            'desc'        => esc_html__('Top bar left block.', 'loveme'),
            'type'        => 'textarea',
            'shortcode'   => true,
            'dependency'  => array('top_bar', '==', false),
          ),
          array(
            'id'          => 'top_right',
            'title'       => esc_html__('Top Right Block', 'loveme'),
            'desc'        => esc_html__('Top bar right block.', 'loveme'),
            'type'        => 'textarea',
            'shortcode'   => true,
            'dependency'  => array('top_bar', '==', false),
          ),
        )
      ),

      // header banner
      array(
        'name'     => 'header_banner_tab',
        'title'    => esc_html__('Title Bar (or) Banner', 'loveme'),
        'icon'     => 'fa fa-bullhorn',
        'fields'   => array(

          // Title Area
          array(
            'type'    => 'notice',
            'class'   => 'info cs-loveme-heading',
            'content' => esc_html__('Title Area', 'loveme')
          ),
          array(
            'id'      => 'need_title_bar',
            'type'    => 'switcher',
            'title'   => esc_html__('Title Bar ?', 'loveme'),
            'label'   => esc_html__('If you want to Hide title bar in your sub-pages, please turn this ON.', 'loveme'),
            'default'    => false,
          ),
          array(
            'id'             => 'title_bar_padding',
            'type'           => 'select',
            'title'          => esc_html__('Padding Spaces Top & Bottom', 'loveme'),
            'options'        => array(
              'padding-default' => esc_html__('Default Spacing', 'loveme'),
              'padding-custom' => esc_html__('Custom Padding', 'loveme'),
            ),
            'dependency'   => array( 'need_title_bar', '==', 'false' ),
          ),
          array(
            'id'             => 'titlebar_top_padding',
            'type'           => 'text',
            'title'          => esc_html__('Padding Top', 'loveme'),
            'attributes' => array(
              'placeholder'     => '100px',
            ),
            'dependency'   => array( 'title_bar_padding', '==', 'padding-custom' ),
          ),
          array(
            'id'             => 'titlebar_bottom_padding',
            'type'           => 'text',
            'title'          => esc_html__('Padding Bottom', 'loveme'),
            'attributes' => array(
              'placeholder'     => '100px',
            ),
            'dependency'   => array( 'title_bar_padding', '==', 'padding-custom' ),
          ),

          array(
            'type'    => 'notice',
            'class'   => 'info cs-loveme-heading',
            'content' => esc_html__('Background Options', 'loveme'),
            'dependency' => array( 'need_title_bar', '==', 'false' ),
          ),
          array(
            'id'      => 'titlebar_bg_overlay_color',
            'type'    => 'color_picker',
            'title'   => esc_html__('Overlay Color', 'loveme'),
            'dependency' => array( 'need_title_bar', '==', 'false' ),
          ),
          array(
            'id'    => 'title_color',
            'type'  => 'color_picker',
            'title' => esc_html__('Title Color', 'loveme'),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),

          array(
            'type'    => 'notice',
            'class'   => 'info cs-loveme-heading',
            'content' => esc_html__('Breadcrumbs', 'loveme'),
          ),
         array(
            'id'      => 'need_breadcrumbs',
            'type'    => 'switcher',
            'title'   => esc_html__('Hide Breadcrumbs', 'loveme'),
            'label'   => esc_html__('If you want to hide breadcrumbs in your banner, please turn this ON.', 'loveme'),
            'default'    => false,
          ),
        )
      ),

    ),
  );

  // ------------------------------
  // Footer Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'footer_section',
    'title'    => esc_html__('Footer Settings', 'loveme'),
    'icon'     => 'fa fa-cogs',
    'sections' => array(

      // footer widgets
      array(
        'name'     => 'footer_widgets_tab',
        'title'    => esc_html__('Widget Area', 'loveme'),
        'icon'     => 'fa fa-th',
        'fields'   => array(

          // Footer Widget Block
          array(
            'type'    => 'notice',
            'class'   => 'info cs-loveme-heading',
            'content' => esc_html__('Footer Widget Block', 'loveme')
          ),
          array(
            'id'    => 'footer_widget_block',
            'type'  => 'switcher',
            'title' => esc_html__('Enable Widget Block', 'loveme'),
            'info' => __('If you turn this ON, then Goto : Appearance > Widgets. There you can see <strong>Footer Widget 1,2,3 or 4</strong> Widget Area, add your widgets there.', 'loveme'),
            'default' => true,
          ),
          array(
            'id'    => 'footer_widget_layout',
            'type'  => 'image_select',
            'title' => esc_html__('Widget Layouts', 'loveme'),
            'info' => esc_html__('Choose your footer widget theme-layouts.', 'loveme'),
            'default' => 4,
            'options' => array(
              1   => LOVEME_CS_IMAGES . '/footer/footer-1.png',
              2   => LOVEME_CS_IMAGES . '/footer/footer-2.png',
              3   => LOVEME_CS_IMAGES . '/footer/footer-3.png',
              4   => LOVEME_CS_IMAGES . '/footer/footer-4.png',
              5   => LOVEME_CS_IMAGES . '/footer/footer-5.png',
              6   => LOVEME_CS_IMAGES . '/footer/footer-6.png',
              7   => LOVEME_CS_IMAGES . '/footer/footer-7.png',
              8   => LOVEME_CS_IMAGES . '/footer/footer-8.png',
              9   => LOVEME_CS_IMAGES . '/footer/footer-9.png',
            ),
            'radio'       => true,
            'dependency'  => array('footer_widget_block', '==', true),
          ),
           array(
            'id'    => 'loveme_ft_bg',
            'type'  => 'image',
            'title' => esc_html__('Footer Background', 'loveme'),
            'info'  => esc_html__('Upload your footer background.', 'loveme'),
            'add_title' => esc_html__('footer background', 'loveme'),
            'dependency'  => array('footer_widget_block', '==', true),
          ),

        )
      ),

      // footer copyright
      array(
        'name'     => 'footer_copyright_tab',
        'title'    => esc_html__('Copyright Bar', 'loveme'),
        'icon'     => 'fa fa-copyright',
        'fields'   => array(

          // Copyright
          array(
            'type'    => 'notice',
            'class'   => 'info cs-loveme-heading',
            'content' => esc_html__('Copyright Layout', 'loveme'),
          ),
         array(
            'id'    => 'hide_copyright',
            'type'  => 'switcher',
            'title' => esc_html__('Hide Copyright?', 'loveme'),
            'default' => false,
            'on_text' => esc_html__('Yes', 'loveme'),
            'off_text' => esc_html__('No', 'loveme'),
            'label' => esc_html__('Yes, do it!', 'loveme'),
          ),
          array(
            'id'    => 'footer_copyright_layout',
            'type'  => 'image_select',
            'title' => esc_html__('Select Copyright Layout', 'loveme'),
            'info' => esc_html__('In above image, blue box is copyright text and yellow box is secondary text.', 'loveme'),
            'default'      => 'copyright-3',
            'options'      => array(
              'copyright-1'    => LOVEME_CS_IMAGES .'/footer/copyright-1.png',
              ),
            'radio'        => true,
            'dependency'     => array('hide_copyright', '!=', true),
          ),
          array(
            'id'    => 'copyright_text',
            'type'  => 'textarea',
            'title' => esc_html__('Copyright Text', 'loveme'),
            'shortcode' => true,
            'dependency' => array('hide_copyright', '!=', true),
            'after'       => 'Helpful shortcodes: [current_year] [home_url] or any shortcode.',
          ),

          // Copyright Another Text
          array(
            'type'    => 'notice',
            'class'   => 'warning cs-loveme-heading',
            'content' => esc_html__('Copyright Secondary Text', 'loveme'),
             'dependency'     => array('hide_copyright', '!=', true),
          ),
          array(
            'id'    => 'secondary_text',
            'type'  => 'textarea',
            'title' => esc_html__('Secondary Text', 'loveme'),
            'shortcode' => true,
            'dependency'     => array('hide_copyright', '!=', true),
          ),

        )
      ),

    ),
  );

  // ------------------------------
  // Design
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_design',
    'title'  => esc_html__('Design', 'loveme'),
    'icon'   => 'fa fa-paint-brush'
  );

  // ------------------------------
  // color section
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_color_section',
    'title'    => esc_html__('Colors Settings', 'loveme'),
    'icon'     => 'fa fa-eyedropper',
    'fields' => array(

      array(
        'type'    => 'heading',
        'content' => esc_html__('Color Options', 'loveme'),
      ),
      array(
        'type'    => 'subheading',
        'wrap_class' => 'color-tab-content',
        'content' => esc_html__('All color options are available in our theme customizer. The reason of we used customizer options for color section is because, you can choose each part of color from there and see the changes instantly using customizer. Highly customizable colors are in Appearance > Customize', 'loveme'),
      ),

    ),
  );

  // ------------------------------
  // Typography section
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_typo_section',
    'title'    => esc_html__('Typography', 'loveme'),
    'icon'     => 'fa fa-header',
    'fields' => array(

      // Start fields
      array(
        'id'                  => 'typography',
        'type'                => 'group',
        'fields'              => array(
          array(
            'id'              => 'title',
            'type'            => 'text',
            'title'           => esc_html__('Title', 'loveme'),
          ),
          array(
            'id'              => 'selector',
            'type'            => 'textarea',
            'title'           => esc_html__('Selector', 'loveme'),
            'info'           => wp_kses( __('Enter css selectors like : <strong>body, .custom-class</strong>', 'loveme'), array( 'strong' => array() ) ),
          ),
          array(
            'id'              => 'font',
            'type'            => 'typography',
            'title'           => esc_html__('Font Family', 'loveme'),
          ),
          array(
            'id'              => 'size',
            'type'            => 'text',
            'title'           => esc_html__('Font Size', 'loveme'),
          ),
          array(
            'id'              => 'line_height',
            'type'            => 'text',
            'title'           => esc_html__('Line-Height', 'loveme'),
          ),
          array(
            'id'              => 'css',
            'type'            => 'textarea',
            'title'           => esc_html__('Custom CSS', 'loveme'),
          ),
        ),
        'button_title'        => esc_html__('Add New Typography', 'loveme'),
        'accordion_title'     => esc_html__('New Typography', 'loveme'),
      ),

      // Subset
      array(
        'id'                  => 'subsets',
        'type'                => 'select',
        'title'               => esc_html__('Subsets', 'loveme'),
        'class'               => 'chosen',
        'options'             => array(
          'latin'             => 'latin',
          'latin-ext'         => 'latin-ext',
          'cyrillic'          => 'cyrillic',
          'cyrillic-ext'      => 'cyrillic-ext',
          'greek'             => 'greek',
          'greek-ext'         => 'greek-ext',
          'vietnamese'        => 'vietnamese',
          'devanagari'        => 'devanagari',
          'khmer'             => 'khmer',
        ),
        'attributes'         => array(
          'data-placeholder' => 'Subsets',
          'multiple'         => 'multiple',
          'style'            => 'width: 200px;'
        ),
        'default'             => array( 'latin' ),
      ),

      array(
        'id'                  => 'font_weight',
        'type'                => 'select',
        'title'               => esc_html__('Font Weights', 'loveme'),
        'class'               => 'chosen',
        'options'             => array(
          '100'   => esc_html__('Thin 100', 'loveme'),
          '100i'  => esc_html__('Thin 100 Italic', 'loveme'),
          '200'   => esc_html__('Extra Light 200', 'loveme'),
          '200i'  => esc_html__('Extra Light 200 Italic', 'loveme'),
          '300'   => esc_html__('Light 300', 'loveme'),
          '300i'  => esc_html__('Light 300 Italic', 'loveme'),
          '400'   => esc_html__('Regular 400', 'loveme'),
          '400i'  => esc_html__('Regular 400 Italic', 'loveme'),
          '500'   => esc_html__('Medium 500', 'loveme'),
          '500i'  => esc_html__('Medium 500 Italic', 'loveme'),
          '600'   => esc_html__('Semi Bold 600', 'loveme'),
          '600i'  => esc_html__('Semi Bold 600 Italic', 'loveme'),
          '700'   => esc_html__('Bold 700', 'loveme'),
          '700i'  => esc_html__('Bold 700 Italic', 'loveme'),
          '800'   => esc_html__('Extra Bold 800', 'loveme'),
          '800i'  => esc_html__('Extra Bold 800 Italic', 'loveme'),
          '900'   => esc_html__('Black 900', 'loveme'),
          '900i'  => esc_html__('Black 900 Italic', 'loveme'),
        ),
        'attributes'         => array(
          'data-placeholder' => esc_html__('Font Weight', 'loveme'),
          'multiple'         => 'multiple',
          'style'            => 'width: 200px;'
        ),
        'default'             => array( '400' ),
      ),

      // Custom Fonts Upload
      array(
        'id'                 => 'font_family',
        'type'               => 'group',
        'title'              => esc_html__('Upload Custom Fonts', 'loveme'),
        'button_title'       => esc_html__('Add New Custom Font', 'loveme'),
        'accordion_title'    => esc_html__('Adding New Font', 'loveme'),
        'accordion'          => true,
        'desc'               => esc_html__('It is simple. Only add your custom fonts and click to save. After you can check "Font Family" selector. Do not forget to Save!', 'loveme'),
        'fields'             => array(

          array(
            'id'             => 'name',
            'type'           => 'text',
            'title'          => esc_html__('Font-Family Name', 'loveme'),
            'attributes'     => array(
              'placeholder'  => esc_html__('for eg. Arial', 'loveme')
            ),
          ),

          array(
            'id'             => 'ttf',
            'type'           => 'upload',
            'title'          => wp_kses(__('Upload .ttf <small><i>(optional)</i></small>', 'loveme'), array( 'small' => array(), 'i' => array() )),
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => esc_html__('Use this Font-Format', 'loveme'),
              'button_title' => wp_kses(__('Upload <i>.ttf</i>', 'loveme'), array( 'i' => array() )),
            ),
          ),

          array(
            'id'             => 'eot',
            'type'           => 'upload',
            'title'          => wp_kses(__('Upload .eot <small><i>(optional)</i></small>', 'loveme'), array( 'small' => array(), 'i' => array() )),
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => esc_html__('Use this Font-Format', 'loveme'),
              'button_title' => wp_kses(__('Upload <i>.eot</i>', 'loveme'), array( 'i' => array() )),
            ),
          ),

          array(
            'id'             => 'otf',
            'type'           => 'upload',
            'title'          => wp_kses(__('Upload .otf <small><i>(optional)</i></small>', 'loveme'), array( 'small' => array(), 'i' => array() )),
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => esc_html__('Use this Font-Format', 'loveme'),
              'button_title' => wp_kses(__('Upload <i>.otf</i>', 'loveme'), array( 'i' => array() )),
            ),
          ),

          array(
            'id'             => 'woff',
            'type'           => 'upload',
            'title'          => wp_kses(__('Upload .woff <small><i>(optional)</i></small>', 'loveme'), array( 'small' => array(), 'i' => array() )),
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => esc_html__('Use this Font-Format', 'loveme'),
              'button_title' =>wp_kses(__('Upload <i>.woff</i>', 'loveme'), array( 'i' => array() )),
            ),
          ),

          array(
            'id'             => 'css',
            'type'           => 'textarea',
            'title'          => wp_kses(__('Extra CSS Style <small><i>(optional)</i></small>', 'loveme'), array( 'small' => array(), 'i' => array() )),
            'attributes'     => array(
              'placeholder'  => esc_html__('for eg. font-weight: normal;', 'loveme'),
            ),
          ),

        ),
      ),
      // End All field

    ),
  );

  // ------------------------------
  // Pages
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_pages',
    'title'  => esc_html__('Pages', 'loveme'),
    'icon'   => 'fa fa-files-o'
  );

  
  // ------------------------------
  // Team Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'team_section',
    'title'    => esc_html__('Team', 'loveme'),
    'icon'     => 'fa fa-address-book-o',
    'fields' => array(

      // team name change
      array(
        'type'    => 'notice',
        'class'   => 'info cs-tmx-heading',
        'content' => esc_html__('Name Change', 'loveme')
      ),
      array(
        'id'      => 'theme_team_name',
        'type'    => 'text',
        'title'   => esc_html__('Team Name', 'loveme'),
        'attributes'     => array(
          'placeholder'  => 'Team'
        ),
      ),
      array(
        'id'      => 'theme_team_slug',
        'type'    => 'text',
        'title'   => esc_html__('Team Slug', 'loveme'),
        'attributes'     => array(
          'placeholder'  => 'team-item'
        ),
      ),
      array(
        'id'      => 'theme_team_cat_slug',
        'type'    => 'text',
        'title'   => esc_html__('Team Category Slug', 'loveme'),
        'attributes'     => array(
          'placeholder'  => 'team-category'
        ),
      ),
      array(
        'type'    => 'notice',
        'class'   => 'danger',
        'content' => __('<strong>Important</strong>: Please do not set team slug and page slug as same. It\'ll not work.', 'loveme')
      ),
      // Team Start
      array(
        'type'    => 'notice',
        'class'   => 'info cs-loveme-heading',
        'content' => esc_html__('Team Single', 'loveme')
      ),
      array(
          'id'             => 'team_sidebar_position',
          'type'           => 'select',
          'title'          => esc_html__('Sidebar Position', 'loveme'),
          'options'        => array(
            'sidebar-right' => esc_html__('Right', 'loveme'),
            'sidebar-left' => esc_html__('Left', 'loveme'),
            'sidebar-hide' => esc_html__('Hide', 'loveme'),
          ),
          'default_option' => 'Select sidebar position',
          'info'          => esc_html__('Default option : Right', 'loveme'),
        ),
        array(
          'id'             => 'single_team_widget',
          'type'           => 'select',
          'title'          => esc_html__('Sidebar Widget', 'loveme'),
          'options'        => loveme_registered_sidebars(),
          'default_option' => esc_html__('Select Widget', 'loveme'),
          'dependency'     => array('team_sidebar_position', '!=', 'sidebar-hide'),
          'info'          => esc_html__('Default option : Main Widget Area', 'loveme'),
        ),
        array(
          'id'    => 'team_comment_form',
          'type'  => 'switcher',
          'title' => esc_html__('Comment Area/Form', 'loveme'),
          'info' => esc_html__('If need to hide comment area and that form on single blog page, please turn this OFF.', 'loveme'),
          'default' => true,
        ),
    ),
  );


  // ------------------------------
  // Service Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'service_section',
    'title'    => esc_html__('Service', 'loveme'),
    'icon'     => 'fa fa-newspaper-o',
    'fields' => array(

      // service name change
      array(
        'type'    => 'notice',
        'class'   => 'info cs-tmx-heading',
        'content' => esc_html__('Name Change', 'loveme')
      ),
      array(
        'id'      => 'theme_service_name',
        'type'    => 'text',
        'title'   => esc_html__('Service Name', 'loveme'),
        'attributes'     => array(
          'placeholder'  => 'Service'
        ),
      ),
      array(
        'id'      => 'theme_service_slug',
        'type'    => 'text',
        'title'   => esc_html__('Service Slug', 'loveme'),
        'attributes'     => array(
          'placeholder'  => 'service-item'
        ),
      ),
      array(
        'id'      => 'theme_service_cat_slug',
        'type'    => 'text',
        'title'   => esc_html__('Service Category Slug', 'loveme'),
        'attributes'     => array(
          'placeholder'  => 'service-category'
        ),
      ),
      array(
        'type'    => 'notice',
        'class'   => 'danger',
        'content' => __('<strong>Important</strong>: Please do not set service slug and page slug as same. It\'ll not work.', 'loveme')
      ),
      // Service Start
      array(
        'type'    => 'notice',
        'class'   => 'info cs-loveme-heading',
        'content' => esc_html__('Service Single', 'loveme')
      ),
      array(
          'id'             => 'service_sidebar_position',
          'type'           => 'select',
          'title'          => esc_html__('Sidebar Position', 'loveme'),
          'options'        => array(
            'sidebar-right' => esc_html__('Right', 'loveme'),
            'sidebar-left' => esc_html__('Left', 'loveme'),
            'sidebar-hide' => esc_html__('Hide', 'loveme'),
          ),
          'default_option' => 'Select sidebar position',
          'info'          => esc_html__('Default option : Right', 'loveme'),
        ),
        array(
          'id'             => 'single_service_widget',
          'type'           => 'select',
          'title'          => esc_html__('Sidebar Widget', 'loveme'),
          'options'        => loveme_registered_sidebars(),
          'default_option' => esc_html__('Select Widget', 'loveme'),
          'dependency'     => array('service_sidebar_position', '!=', 'sidebar-hide'),
          'info'          => esc_html__('Default option : Main Widget Area', 'loveme'),
        ),
        array(
          'id'    => 'service_comment_form',
          'type'  => 'switcher',
          'title' => esc_html__('Comment Area/Form', 'loveme'),
          'info' => esc_html__('If need to hide comment area and that form on single blog page, please turn this OFF.', 'loveme'),
          'default' => true,
        ),
    ),
  );

  
  // ------------------------------
  // Project Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'project_section',
    'title'    => esc_html__('Project', 'loveme'),
    'icon'     => 'fa fa-medkit',
    'fields' => array(

      // project name change
      array(
        'type'    => 'notice',
        'class'   => 'info cs-tmx-heading',
        'content' => esc_html__('Name Change', 'loveme')
      ),
      array(
        'id'      => 'theme_project_name',
        'type'    => 'text',
        'title'   => esc_html__('Project Name', 'loveme'),
        'attributes'     => array(
          'placeholder'  => 'Project'
        ),
      ),
      array(
        'id'      => 'theme_project_slug',
        'type'    => 'text',
        'title'   => esc_html__('Project Slug', 'loveme'),
        'attributes'     => array(
          'placeholder'  => 'project-item'
        ),
      ),
      array(
        'id'      => 'theme_project_cat_slug',
        'type'    => 'text',
        'title'   => esc_html__('Project Category Slug', 'loveme'),
        'attributes'     => array(
          'placeholder'  => 'project-category'
        ),
      ),
      array(
        'type'    => 'notice',
        'class'   => 'danger',
        'content' => __('<strong>Important</strong>: Please do not set project slug and page slug as same. It\'ll not work.', 'loveme')
      ),

      // Project Start
      array(
        'type'    => 'notice',
        'class'   => 'info cs-loveme-heading',
        'content' => esc_html__('Project Single', 'loveme')
      ),
      array(
          'id'             => 'project_sidebar_position',
          'type'           => 'select',
          'title'          => esc_html__('Sidebar Position', 'loveme'),
          'options'        => array(
            'sidebar-right' => esc_html__('Right', 'loveme'),
            'sidebar-left' => esc_html__('Left', 'loveme'),
            'sidebar-hide' => esc_html__('Hide', 'loveme'),
          ),
          'default_option' => 'Select sidebar position',
          'info'          => esc_html__('Default option : Right', 'loveme'),
        ),
        array(
          'id'             => 'single_project_widget',
          'type'           => 'select',
          'title'          => esc_html__('Sidebar Widget', 'loveme'),
          'options'        => loveme_registered_sidebars(),
          'default_option' => esc_html__('Select Widget', 'loveme'),
          'dependency'     => array('project_sidebar_position', '!=', 'sidebar-hide'),
          'info'          => esc_html__('Default option : Main Widget Area', 'loveme'),
        ),
        array(
          'id'    => 'project_comment_form',
          'type'  => 'switcher',
          'title' => esc_html__('Comment Area/Form', 'loveme'),
          'info' => esc_html__('If need to hide comment area and that form on single blog page, please turn this OFF.', 'loveme'),
          'default' => true,
        ),
    ),
  );

  // ------------------------------
  // Blog Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'blog_section',
    'title'    => esc_html__('Blog', 'loveme'),
    'icon'     => 'fa fa-edit',
    'sections' => array(

      // blog general section
      array(
        'name'     => 'blog_general_tab',
        'title'    => esc_html__('General', 'loveme'),
        'icon'     => 'fa fa-cog',
        'fields'   => array(

          // Layout
          array(
            'type'    => 'notice',
            'class'   => 'info cs-loveme-heading',
            'content' => esc_html__('Layout', 'loveme')
          ),
          array(
            'id'             => 'blog_sidebar_position',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Position', 'loveme'),
            'options'        => array(
              'sidebar-right' => esc_html__('Right', 'loveme'),
              'sidebar-left' => esc_html__('Left', 'loveme'),
              'sidebar-hide' => esc_html__('Hide', 'loveme'),
            ),
            'default_option' => 'Select sidebar position',
            'help'          => esc_html__('This style will apply, default blog pages - Like : Archive, Category, Tags, Search & Author.', 'loveme'),
            'info'          => esc_html__('Default option : Right', 'loveme'),
          ),
          array(
            'id'             => 'blog_widget',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Widget', 'loveme'),
            'options'        => loveme_registered_sidebars(),
            'default_option' => esc_html__('Select Widget', 'loveme'),
            'dependency'     => array('blog_sidebar_position', '!=', 'sidebar-hide'),
            'info'          => esc_html__('Default option : Main Widget Area', 'loveme'),
          ),
          // Layout
          // Global Options
          array(
            'type'    => 'notice',
            'class'   => 'info cs-loveme-heading',
            'content' => esc_html__('Global Options', 'loveme')
          ),
          array(
            'id'         => 'theme_exclude_categories',
            'type'       => 'checkbox',
            'title'      => esc_html__('Exclude Categories', 'loveme'),
            'info'      => esc_html__('Select categories you want to exclude from blog page.', 'loveme'),
            'options'    => 'categories',
          ),
          array(
            'id'      => 'theme_blog_excerpt',
            'type'    => 'text',
            'title'   => esc_html__('Excerpt Length', 'loveme'),
            'info'   => esc_html__('Blog short content length, in blog listing pages.', 'loveme'),
            'default' => '55',
          ),
          array(
            'id'      => 'theme_metas_hide',
            'type'    => 'checkbox',
            'title'   => esc_html__('Meta\'s to hide', 'loveme'),
            'info'    => esc_html__('Check items you want to hide from blog/post meta field.', 'loveme'),
            'class'      => 'horizontal',
            'options'    => array(
              'category'   => esc_html__('Category', 'loveme'),
              'date'    => esc_html__('Date', 'loveme'),
              'author'     => esc_html__('Author', 'loveme'),
              'comments'      => esc_html__('Comments', 'loveme'),
              'Tag'      => esc_html__('Tag', 'loveme'),
            ),
            // 'default' => '30',
          ),
          // End fields

        )
      ),

      // blog single section
      array(
        'name'     => 'blog_single_tab',
        'title'    => esc_html__('Single', 'loveme'),
        'icon'     => 'fa fa-sticky-note',
        'fields'   => array(

          // Start fields
          array(
            'type'    => 'notice',
            'class'   => 'info cs-loveme-heading',
            'content' => esc_html__('Enable / Disable', 'loveme')
          ),
          array(
            'id'    => 'single_featured_image',
            'type'  => 'switcher',
            'title' => esc_html__('Featured Image', 'loveme'),
            'info' => esc_html__('If need to hide featured image from single blog post page, please turn this OFF.', 'loveme'),
            'default' => true,
          ),
           array(
            'id'    => 'single_author_info',
            'type'  => 'switcher',
            'title' => esc_html__('Author Info', 'loveme'),
            'info' => esc_html__('If need to hide author info on single blog page, please turn this On.', 'loveme'),
            'default' => false,
          ),
          array(
            'id'    => 'single_share_option',
            'type'  => 'switcher',
            'title' => esc_html__('Share Option', 'loveme'),
            'info' => esc_html__('If need to hide share option on single blog page, please turn this OFF.', 'loveme'),
            'default' => true,
          ),
          array(
            'id'    => 'single_comment_form',
            'type'  => 'switcher',
            'title' => esc_html__('Comment Area/Form ?', 'loveme'),
            'info' => esc_html__('If need to hide comment area and that form on single blog page, please turn this On.', 'loveme'),
            'default' => false,
          ),
          array(
            'type'    => 'notice',
            'class'   => 'info cs-loveme-heading',
            'content' => esc_html__('Sidebar', 'loveme')
          ),
          array(
            'id'             => 'single_sidebar_position',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Position', 'loveme'),
            'options'        => array(
              'sidebar-right' => esc_html__('Right', 'loveme'),
              'sidebar-left' => esc_html__('Left', 'loveme'),
              'sidebar-hide' => esc_html__('Hide', 'loveme'),
            ),
            'default_option' => 'Select sidebar position',
            'info'          => esc_html__('Default option : Right', 'loveme'),
          ),
          array(
            'id'             => 'single_blog_widget',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Widget', 'loveme'),
            'options'        => loveme_registered_sidebars(),
            'default_option' => esc_html__('Select Widget', 'loveme'),
            'dependency'     => array('single_sidebar_position', '!=', 'sidebar-hide'),
            'info'          => esc_html__('Default option : Main Widget Area', 'loveme'),
          ),
          // End fields

        )
      ),

    ),
  );

if (class_exists( 'WooCommerce' )){
  // ------------------------------
  // WooCommerce Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'woocommerce_section',
    'title'    => esc_html__('WooCommerce', 'loveme'),
    'icon'     => 'fa fa-shopping-basket',
    'fields' => array(

      // Start fields
      array(
        'type'    => 'notice',
        'class'   => 'info cs-loveme-heading',
        'content' => esc_html__('Layout', 'loveme')
      ),
     array(
        'id'             => 'woo_product_columns',
        'type'           => 'select',
        'title'          => esc_html__('Product Column', 'loveme'),
        'options'        => array(
          2 => esc_html__('Two Column', 'loveme'),
          3 => esc_html__('Three Column', 'loveme'),
          4 => esc_html__('Four Column', 'loveme'),
        ),
        'default_option' => esc_html__('Select Product Columns', 'loveme'),
        'help'          => esc_html__('This style will apply, default woocommerce shop and archive pages.', 'loveme'),
      ),
      array(
        'id'             => 'woo_sidebar_position',
        'type'           => 'select',
        'title'          => esc_html__('Sidebar Position', 'loveme'),
        'options'        => array(
          'right-sidebar' => esc_html__('Right', 'loveme'),
          'left-sidebar' => esc_html__('Left', 'loveme'),
          'sidebar-hide' => esc_html__('Hide', 'loveme'),
        ),
        'default_option' => esc_html__('Select sidebar position', 'loveme'),
        'info'          => esc_html__('Default option : Right', 'loveme'),
      ),
      array(
        'id'             => 'woo_widget',
        'type'           => 'select',
        'title'          => esc_html__('Sidebar Widget', 'loveme'),
        'options'        => loveme_registered_sidebars(),
        'default_option' => esc_html__('Select Widget', 'loveme'),
        'dependency'     => array('woo_sidebar_position', '!=', 'sidebar-hide'),
        'info'          => esc_html__('Default option : Shop Page', 'loveme'),
      ),

      array(
        'type'    => 'notice',
        'class'   => 'info cs-loveme-heading',
        'content' => esc_html__('Listing', 'loveme')
      ),
      array(
        'id'      => 'theme_woo_limit',
        'type'    => 'text',
        'title'   => esc_html__('Product Limit', 'loveme'),
        'info'   => esc_html__('Enter the number value for per page products limit.', 'loveme'),
      ),
      // End fields

      // Start fields
      array(
        'type'    => 'notice',
        'class'   => 'info cs-loveme-heading',
        'content' => esc_html__('Single Product', 'loveme')
      ),
      array(
        'id'             => 'woo_related_limit',
        'type'           => 'text',
        'title'          => esc_html__('Related Products Limit', 'loveme'),
      ),
      array(
        'id'    => 'woo_single_upsell',
        'type'  => 'switcher',
        'title' => esc_html__('You May Also Like', 'loveme'),
        'info' => esc_html__('If you don\'t want \'You May Also Like\' products in single product page, please turn this ON.', 'loveme'),
        'default' => false,
      ),
      array(
        'id'    => 'woo_single_related',
        'type'  => 'switcher',
        'title' => esc_html__('Related Products', 'loveme'),
        'info' => esc_html__('If you don\'t want \'Related Products\' in single product page, please turn this ON.', 'loveme'),
        'default' => false,
      ),
      // End fields

    ),
  );
}

  // ------------------------------
  // Extra Pages
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_extra_pages',
    'title'    => esc_html__('Extra Pages', 'loveme'),
    'icon'     => 'fa fa-clone',
    'sections' => array(

      // error 404 page
      array(
        'name'     => 'error_page_section',
        'title'    => esc_html__('404 Page', 'loveme'),
        'icon'     => 'fa fa-exclamation-triangle',
        'fields'   => array(

          // Start 404 Page
          array(
            'id'    => 'error_heading',
            'type'  => 'text',
            'title' => esc_html__('404 Page Heading', 'loveme'),
            'info'  => esc_html__('Enter 404 page heading.', 'loveme'),
          ),
          array(
            'id'    => 'error_subheading',
            'type'  => 'textarea',
            'title' => esc_html__('404 Page Sub Heading', 'loveme'),
            'info'  => esc_html__('Enter 404 page Sub heading.', 'loveme'),
          ),
          array(
            'id'    => 'error_page_content',
            'type'  => 'textarea',
            'title' => esc_html__('404 Page Content', 'loveme'),
            'info'  => esc_html__('Enter 404 page content.', 'loveme'),
            'shortcode' => true,
          ),
          array(
            'id'    => 'error_btn_text',
            'type'  => 'text',
            'title' => esc_html__('Button Text', 'loveme'),
            'info'  => esc_html__('Enter BACK TO HOME button text. If you want to change it.', 'loveme'),
          ),
          // End 404 Page

        ) // end: fields
      ), // end: fields section

      // maintenance mode page
      array(
        'name'     => 'maintenance_mode_section',
        'title'    => esc_html__('Maintenance Mode', 'loveme'),
        'icon'     => 'fa fa-hourglass-half',
        'fields'   => array(

          // Start Maintenance Mode
          array(
            'type'    => 'notice',
            'class'   => 'info cs-loveme-heading',
            'content' => esc_html__('If you turn this ON : Only Logged in users will see your pages. All other visiters will see, selected page of : <strong>Maintenance Mode Page</strong>', 'loveme')
          ),
          array(
            'id'             => 'enable_maintenance_mode',
            'type'           => 'switcher',
            'title'          => esc_html__('Maintenance Mode', 'loveme'),
            'default'        => false,
          ),
          array(
            'id'             => 'maintenance_mode_page',
            'type'           => 'select',
            'title'          => esc_html__('Maintenance Mode Page', 'loveme'),
            'options'        => 'pages',
            'default_option' => esc_html__('Select a page', 'loveme'),
            'dependency'   => array( 'enable_maintenance_mode', '==', 'true' ),
          ),
          array(
            'id'             => 'maintenance_mode_title',
            'type'           => 'text',
            'title'          => esc_html__('Maintenance Mode Text', 'loveme'),
            'dependency'   => array( 'enable_maintenance_mode', '==', 'true' ),
          ),
          array(
            'id'             => 'maintenance_mode_text',
            'type'           => 'textarea',
            'title'          => esc_html__('Maintenance Mode Text', 'loveme'),
            'dependency'   => array( 'enable_maintenance_mode', '==', 'true' ),
          ),
          array(
            'id'             => 'maintenance_mode_bg',
            'type'           => 'background',
            'title'          => esc_html__('Page Background', 'loveme'),
            'dependency'   => array( 'enable_maintenance_mode', '==', 'true' ),
          ),
          // End Maintenance Mode

        ) // end: fields
      ), // end: fields section

    )
  );

  // ------------------------------
  // Advanced
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_advanced',
    'title'  => esc_html__('Advanced', 'loveme'),
    'icon'   => 'fa fa-cog'
  );

  // ------------------------------
  // Misc Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'misc_section',
    'title'    => esc_html__('Advance Settings', 'loveme'),
    'icon'     => 'fa fa-cogs',
    'sections' => array(

      // custom sidebar section
      array(
        'name'     => 'custom_sidebar_section',
        'title'    => esc_html__('Custom Sidebar', 'loveme'),
        'icon'     => 'fa fa-reorder',
        'fields'   => array(

          // start fields
          array(
            'id'              => 'custom_sidebar',
            'title'           => esc_html__('Sidebars', 'loveme'),
            'desc'            => esc_html__('Go to Appearance -> Widgets after create sidebars', 'loveme'),
            'type'            => 'group',
            'fields'          => array(
              array(
                'id'          => 'sidebar_name',
                'type'        => 'text',
                'title'       => esc_html__('Sidebar Name', 'loveme'),
              ),
              array(
                'id'          => 'sidebar_desc',
                'type'        => 'text',
                'title'       => esc_html__('Custom Description', 'loveme'),
              )
            ),
            'accordion'       => true,
            'button_title'    => esc_html__('Add New Sidebar', 'loveme'),
            'accordion_title' => esc_html__('New Sidebar', 'loveme'),
          ),
          // end fields

        )
      ),
      // custom sidebar section

      // Custom CSS/JS
      array(
        'name'        => 'custom_css_js_section',
        'title'       => esc_html__('Custom Codes', 'loveme'),
        'icon'        => 'fa fa-code',

        // begin: fields
        'fields'      => array(
          // Start Custom CSS/JS
          array(
            'type'    => 'notice',
            'class'   => 'info cs-loveme-heading',
            'content' => esc_html__('Custom JS', 'loveme')
          ),
          array(
            'id'             => 'theme_custom_js',
            'type'           => 'textarea',
            'attributes' => array(
              'rows'     => 10,
              'placeholder'     => esc_html__('Enter your JS code here...', 'loveme'),
            ),
          ),
          // End Custom CSS/JS

        ) // end: fields
      ),

      // Translation
      array(
        'name'        => 'theme_translation_section',
        'title'       => esc_html__('Translation', 'loveme'),
        'icon'        => 'fa fa-language',

        // begin: fields
        'fields'      => array(

          // Start Translation
          array(
            'type'    => 'notice',
            'class'   => 'info cs-loveme-heading',
            'content' => esc_html__('Common Texts', 'loveme')
          ),
          array(
            'id'          => 'read_more_text',
            'type'        => 'text',
            'title'       => esc_html__('Read More Text', 'loveme'),
          ),
          array(
            'id'          => 'view_more_text',
            'type'        => 'text',
            'title'       => esc_html__('View More Text', 'loveme'),
          ),
          array(
            'id'          => 'share_text',
            'type'        => 'text',
            'title'       => esc_html__('Share Text', 'loveme'),
          ),
          array(
            'id'          => 'share_on_text',
            'type'        => 'text',
            'title'       => esc_html__('Share On Tooltip Text', 'loveme'),
          ),
          array(
            'id'          => 'author_text',
            'type'        => 'text',
            'title'       => esc_html__('Author Text', 'loveme'),
          ),
          array(
            'id'          => 'post_comment_text',
            'type'        => 'text',
            'title'       => esc_html__('Post Comment Text [Submit Button]', 'loveme'),
          ),
          array(
            'type'    => 'notice',
            'class'   => 'info cs-loveme-heading',
            'content' => esc_html__('WooCommerce', 'loveme')
          ),
          array(
            'id'          => 'add_to_cart_text',
            'type'        => 'text',
            'title'       => esc_html__('Add to Cart Text', 'loveme'),
          ),
          array(
            'id'          => 'details_text',
            'type'        => 'text',
            'title'       => esc_html__('Details Text', 'loveme'),
          ),

          array(
            'type'    => 'notice',
            'class'   => 'info cs-loveme-heading',
            'content' => esc_html__('Pagination', 'loveme')
          ),
          array(
            'id'          => 'older_post',
            'type'        => 'text',
            'title'       => esc_html__('Older Posts Text', 'loveme'),
          ),
          array(
            'id'          => 'newer_post',
            'type'        => 'text',
            'title'       => esc_html__('Newer Posts Text', 'loveme'),
          ),

          array(
            'type'    => 'notice',
            'class'   => 'info cs-loveme-heading',
            'content' => esc_html__('Single Portfolio Pagination', 'loveme')
          ),
          array(
            'id'          => 'prev_port',
            'type'        => 'text',
            'title'       => esc_html__('Prev Case Text', 'loveme'),
          ),
          array(
            'id'          => 'next_port',
            'type'        => 'text',
            'title'       => esc_html__('Next Case Text', 'loveme'),
          ),
          // End Translation

        ) // end: fields
      ),

    ),
  );

  
  // ------------------------------
  // backup                       -
  // ------------------------------
  $options[]   = array(
    'name'     => 'backup_section',
    'title'    => 'Backup',
    'icon'     => 'fa fa-shield',
    'fields'   => array(

      array(
        'type'    => 'notice',
        'class'   => 'warning',
        'content' => esc_html__('You can save your current options. Download a Backup and Import.', 'loveme'),
      ),

      array(
        'type'    => 'backup',
      ),

    )
  );

  return $options;

}
add_filter( 'cs_framework_options', 'loveme_options' );