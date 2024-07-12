<?php
/*
 * All Custom Shortcode for [theme_name] theme.
 * Author & Copyright: wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

if( ! function_exists( 'loveme_shortcodes' ) ) {
  function loveme_shortcodes( $options ) {

    $options       = array();

    /* Topbar Shortcodes */
    $options[]     = array(
      'title'      => esc_html__('Topbar Shortcodes', 'loveme'),
      'shortcodes' => array(

        // Topbar item
        array(
          'name'          => 'loveme_widget_topbars',
          'title'         => esc_html__('Topbar info', 'loveme'),
          'view'          => 'clone',
          'clone_id'      => 'loveme_widget_topbar',
          'clone_title'   => esc_html__('Add New', 'loveme'),
          'fields'        => array(

            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'loveme'),
            ),
            
          ),
          'clone_fields'  => array(

            array(
              'id'        => 'info_icon',
              'type'      => 'icon',
              'title'     => esc_html__('Icon', 'loveme'),
            ),
            array(
              'id'        => 'title',
              'type'      => 'text',
              'title'     => esc_html__('Title', 'loveme'),
            ),
            array(
              'id'        => 'link',
              'type'      => 'text',
              'title'     => esc_html__('Link', 'loveme'),
            ),
            array(
              'id'        => 'open_tab',
              'type'      => 'switcher',
              'title'     => esc_html__('Open New Tab?', 'loveme'),
              'yes'     => esc_html__('Yes', 'loveme'),
              'no'     => esc_html__('No', 'loveme'),
            ),

          ),

        ),
       

      ),
    );

    /* Header Shortcodes */
    $options[]     = array(
      'title'      => esc_html__('Header Shortcodes', 'loveme'),
      'shortcodes' => array(

        // header Social
        array(
          'name'          => 'loveme_header_socials',
          'title'         => esc_html__('Header Social', 'loveme'),
          'view'          => 'clone',
          'clone_id'      => 'loveme_header_social',
          'clone_title'   => esc_html__('Add New Social', 'loveme'),
          'fields'        => array(

            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'loveme'),
            ),
          ),
          'clone_fields'  => array(
            array(
              'id'        => 'social_icon',
              'type'      => 'icon',
              'title'     => esc_html__('Social Icon', 'loveme')
            ),
            array(
              'id'        => 'social_icon_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Icon Color', 'loveme'),
            ),
            array(
              'id'        => 'social_link',
              'type'      => 'text',
              'title'     => esc_html__('Social Link', 'loveme')
            ),
            array(
              'id'        => 'target_tab',
              'type'      => 'switcher',
              'title'     => esc_html__('Open New Tab?', 'loveme'),
              'yes'     => esc_html__('Yes', 'loveme'),
              'no'     => esc_html__('No', 'loveme'),
            ),

          ),

        ),
        // header Social End

        // header Middle Infos
        array(
          'name'          => 'loveme_header_middle_infos',
          'title'         => esc_html__('Header Middle Info', 'loveme'),
          'view'          => 'clone',
          'clone_id'      => 'loveme_header_middle_info',
          'clone_title'   => esc_html__('Add New Info', 'loveme'),
          'fields'        => array(

            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'loveme'),
            ),

          ),
          'clone_fields'  => array(
            array(
              'id'        => 'social_icon',
              'type'      => 'icon',
              'title'     => esc_html__('Social Icon', 'loveme')
            ),
            array(
              'id'        => 'social_icon_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Icon Color', 'loveme'),
            ),
            array(
              'id'        => 'address_text',
              'type'      => 'text',
              'title'     => esc_html__('Address Text', 'loveme')
            ),
            array(
              'id'        => 'address_desc',
              'type'      => 'text',
              'title'     => esc_html__('Address Details', 'loveme')
            ),
          ),

        ),
        // header Middle Infos End



      ),
    );

    /* Content Shortcodes */
    $options[]     = array(
      'title'      => esc_html__('Content Shortcodes', 'loveme'),
      'shortcodes' => array(

        // Spacer
        array(
          'name'          => 'vc_empty_space',
          'title'         => esc_html__('Spacer', 'loveme'),
          'fields'        => array(

            array(
              'id'        => 'height',
              'type'      => 'text',
              'title'     => esc_html__('Height', 'loveme'),
              'attributes' => array(
                'placeholder'     => '20px',
              ),
            ),

          ),
        ),
        // Spacer

        // Social Icons
        array(
          'name'          => 'loveme_socials',
          'title'         => esc_html__('Social Icons', 'loveme'),
          'view'          => 'clone',
          'clone_id'      => 'loveme_social',
          'clone_title'   => esc_html__('Add New', 'loveme'),
          'fields'        => array(
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'loveme'),
            ),  
            array(
              'id'        => 'section_title',
              'type'      => 'text',
              'title'     => esc_html__('Title', 'loveme'),
            ),

            // Colors
            array(
              'type'    => 'notice',
              'class'   => 'info',
              'content' => esc_html__('Colors', 'loveme')
            ),
            array(
              'id'        => 'icon_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Icon Color', 'loveme'),
              'wrap_class' => 'column_third',
            ),
            array(
              'id'        => 'icon_hover_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Icon Hover Color', 'loveme'),
              'wrap_class' => 'column_third',
              'dependency'  => array('social_select', '!=', 'style-three'),
            ),
            array(
              'id'        => 'bg_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Backrgound Color', 'loveme'),
              'wrap_class' => 'column_third',
              'dependency'  => array('social_select', '!=', 'style-one'),
            ),
            array(
              'id'        => 'bg_hover_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Backrgound Hover Color', 'loveme'),
              'wrap_class' => 'column_third',
              'dependency'  => array('social_select', '==', 'style-two'),
            ),
            array(
              'id'        => 'border_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Border Color', 'loveme'),
              'wrap_class' => 'column_third',
              'dependency'  => array('social_select', '==', 'style-three'),
            ),

            // Icon Size
            array(
              'id'        => 'icon_size',
              'type'      => 'text',
              'title'     => esc_html__('Icon Size', 'loveme'),
              'wrap_class' => 'column_full',
            ),

          ),
          'clone_fields'  => array(

            array(
              'id'        => 'social_link',
              'type'      => 'text',
              'attributes' => array(
                'placeholder'     => 'http://',
              ),
              'title'     => esc_html__('Link', 'loveme')
            ),
            array(
              'id'        => 'social_icon',
              'type'      => 'icon',
              'title'     => esc_html__('Social Icon', 'loveme')
            ),
            array(
              'id'        => 'target_tab',
              'type'      => 'switcher',
              'title'     => esc_html__('Open New Tab?', 'loveme'),
              'on_text'     => esc_html__('Yes', 'loveme'),
              'off_text'     => esc_html__('No', 'loveme'),
            ),

          ),

        ),
        // Social Icons

        // Useful Links
        array(
          'name'          => 'loveme_useful_links',
          'title'         => esc_html__('Useful Links', 'loveme'),
          'view'          => 'clone',
          'clone_id'      => 'loveme_useful_link',
          'clone_title'   => esc_html__('Add New', 'loveme'),
          'fields'        => array(

            array(
              'id'        => 'column_width',
              'type'      => 'select',
              'title'     => esc_html__('Column Width', 'loveme'),
              'options'        => array(
                'full-width' => esc_html__('One Column', 'loveme'),
                'half-width' => esc_html__('Two Column', 'loveme'),
                'third-width' => esc_html__('Three Column', 'loveme'),
              ),
            ),
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'loveme'),
            ),

          ),
          'clone_fields'  => array(

            array(
              'id'        => 'title_link',
              'type'      => 'text',
              'title'     => esc_html__('Link', 'loveme')
            ),
            array(
              'id'        => 'target_tab',
              'type'      => 'switcher',
              'title'     => esc_html__('Open New Tab?', 'loveme'),
              'on_text'     => esc_html__('Yes', 'loveme'),
              'off_text'     => esc_html__('No', 'loveme'),
            ),
            array(
              'id'        => 'link_title',
              'type'      => 'text',
              'title'     => esc_html__('Title', 'loveme')
            ),

          ),

        ),
        // Useful Links

        // Simple Image List
        array(
          'name'          => 'loveme_image_lists',
          'title'         => esc_html__('Simple Image List', 'loveme'),
          'view'          => 'clone',
          'clone_id'      => 'loveme_image_list',
          'clone_title'   => esc_html__('Add New', 'loveme'),
          'fields'        => array(

            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'loveme'),
            ),

          ),
          'clone_fields'  => array(

            array(
              'id'        => 'get_image',
              'type'      => 'upload',
              'title'     => esc_html__('Image', 'loveme')
            ),
            array(
              'id'        => 'link',
              'type'      => 'text',
              'attributes' => array(
                'placeholder'     => 'http://',
              ),
              'title'     => esc_html__('Link', 'loveme')
            ),
            array(
              'id'    => 'open_tab',
              'type'  => 'switcher',
              'std'   => false,
              'title' => esc_html__('Open link to new tab?', 'loveme')
            ),

          ),

        ),
        // Simple Image List

        // Simple Link
        array(
          'name'          => 'loveme_simple_link',
          'title'         => esc_html__('Simple Link', 'loveme'),
          'fields'        => array(

            array(
              'id'        => 'link_style',
              'type'      => 'select',
              'title'     => esc_html__('Link Style', 'loveme'),
              'options'        => array(
                'link-underline' => esc_html__('Link Underline', 'loveme'),
                'link-arrow-right' => esc_html__('Link Arrow (Right)', 'loveme'),
                'link-arrow-left' => esc_html__('Link Arrow (Left)', 'loveme'),
              ),
            ),
            array(
              'id'        => 'link_icon',
              'type'      => 'icon',
              'title'     => esc_html__('Icon', 'loveme'),
              'value'      => 'fa fa-caret-right',
              'dependency'  => array('link_style', '!=', 'link-underline'),
            ),
            array(
              'id'        => 'link_text',
              'type'      => 'text',
              'title'     => esc_html__('Link Text', 'loveme'),
            ),
            array(
              'id'        => 'link',
              'type'      => 'text',
              'title'     => esc_html__('Link', 'loveme'),
              'attributes' => array(
                'placeholder'     => 'http://',
              ),
            ),
            array(
              'id'        => 'target_tab',
              'type'      => 'switcher',
              'title'     => esc_html__('Open New Tab?', 'loveme'),
              'on_text'     => esc_html__('Yes', 'loveme'),
              'off_text'     => esc_html__('No', 'loveme'),
            ),
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'loveme'),
            ),

            // Normal Mode
            array(
              'type'    => 'notice',
              'class'   => 'info',
              'content' => esc_html__('Normal Mode', 'loveme')
            ),
            array(
              'id'        => 'text_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Text Color', 'loveme'),
              'wrap_class' => 'column_half el-hav-border',
            ),
            array(
              'id'        => 'border_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Border Color', 'loveme'),
              'wrap_class' => 'column_half el-hav-border',
              'dependency'  => array('link_style', '==', 'link-underline'),
            ),
            // Hover Mode
            array(
              'type'    => 'notice',
              'class'   => 'info',
              'content' => esc_html__('Hover Mode', 'loveme')
            ),
            array(
              'id'        => 'text_hover_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Text Hover Color', 'loveme'),
              'wrap_class' => 'column_half el-hav-border',
            ),
            array(
              'id'        => 'border_hover_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Border Hover Color', 'loveme'),
              'wrap_class' => 'column_half el-hav-border',
              'dependency'  => array('link_style', '==', 'link-underline'),
            ),

            // Size
            array(
              'type'    => 'notice',
              'class'   => 'info',
              'content' => esc_html__('Font Sizes', 'loveme')
            ),
            array(
              'id'        => 'text_size',
              'type'      => 'text',
              'title'     => esc_html__('Text Size', 'loveme'),
              'attributes' => array(
                'placeholder'     => 'Eg: 14px',
              ),
            ),

          ),
        ),
        // Simple Link

        // Blockquotes
        array(
          'name'          => 'loveme_blockquote',
          'title'         => esc_html__('Blockquote', 'loveme'),
          'fields'        => array(

            array(
              'id'        => 'blockquote_style',
              'type'      => 'select',
              'title'     => esc_html__('Blockquote Style', 'loveme'),
              'options'        => array(
                '' => esc_html__('Select Blockquote Style', 'loveme'),
                'style-one' => esc_html__('Style One', 'loveme'),
                'style-two' => esc_html__('Style Two', 'loveme'),
              ),
            ),
            array(
              'id'        => 'text_size',
              'type'      => 'text',
              'title'     => esc_html__('Text Size', 'loveme'),
            ),
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'loveme'),
            ),
            array(
              'id'        => 'content_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Content Color', 'loveme'),
            ),
            array(
              'id'        => 'left_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Left Border Color', 'loveme'),
            ),
            array(
              'id'        => 'border_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Border Color', 'loveme'),
            ),
            array(
              'id'        => 'bg_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Background Color', 'loveme'),
            ),
            // Content
            array(
              'id'        => 'content',
              'type'      => 'textarea',
              'title'     => esc_html__('Content', 'loveme'),
            ),

          ),

        ),
        // Blockquotes

      ),
    );

    /* Widget Shortcodes */
    $options[]     = array(
      'title'      => esc_html__('Widget Shortcodes', 'loveme'),
      'shortcodes' => array(

        // widget Contact info
        array(
          'name'          => 'loveme_widget_contact_info',
          'title'         => esc_html__('Contact info', 'loveme'),
          'fields'        => array(
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'loveme'),
            ),
             array(
              'id'        => 'image_url',
              'type'      => 'image',
              'title'     => esc_html__('Image background', 'loveme'),
            ),
            array(
              'id'        => 'title',
              'type'      => 'text',
              'title'     => esc_html__('Title', 'loveme'),
            ),
            array(
              'id'        => 'desc',
              'type'      => 'textarea',
              'title'     => esc_html__('Description', 'loveme'),
            ),
            array(
              'id'        => 'link_text',
              'type'      => 'text',
              'title'     => esc_html__('Link text', 'loveme'),
            ),
            array(
              'id'        => 'link',
              'type'      => 'text',
              'title'     => esc_html__('Link', 'loveme'),
            ),

          ),
        ),

        // widget Testimonials
        array(
          'name'          => 'loveme_widget_testimonial',
          'title'         => esc_html__('Testimonial', 'loveme'),
          'fields'        => array(
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'loveme'),
            ),
             array(
              'id'        => 'image_url',
              'type'      => 'image',
              'title'     => esc_html__('Image background', 'loveme'),
            ),
            array(
              'id'        => 'subtitle',
              'type'      => 'text',
              'title'     => esc_html__('Sub Title', 'loveme'),
            ),
            array(
              'id'        => 'title',
              'type'      => 'text',
              'title'     => esc_html__('Title', 'loveme'),
            ),
            array(
              'id'        => 'desc',
              'type'      => 'textarea',
              'title'     => esc_html__('Description', 'loveme'),
            ),

          ),
        ),

       // About widget Block
        array(
          'name'          => 'loveme_about_widget',
          'title'         => esc_html__('About Widget Block', 'loveme'),
          'fields'        => array(
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'loveme'),
            ),
            array(
              'id'        => 'title',
              'type'      => 'text',
              'title'     => esc_html__('Title', 'loveme'),
            ),
            array(
              'id'        => 'image_url',
              'type'      => 'image',
              'title'     => esc_html__('About Block Image', 'loveme'),
            ),
            array(
              'id'        => 'desc',
              'type'      => 'textarea',
              'title'     => esc_html__('Description', 'loveme'),
            ),
            array(
              'id'        => 'link_text',
              'type'      => 'text',
              'title'     => esc_html__('Link text', 'loveme'),
            ),
            array(
              'id'        => 'link',
              'type'      => 'text',
              'title'     => esc_html__('Link', 'loveme'),
            ),

          ),
        ),


      // Service Contact Widget
        array(
          'name'          => 'loveme_service_widget_contacts',
          'title'         => esc_html__('Service Feature Widget', 'loveme'),
          'view'          => 'clone',
          'clone_id'      => 'loveme_service_widget_contact',
          'clone_title'   => esc_html__('Add New', 'loveme'),
          'fields'        => array(

            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'loveme'),
            ),
            array(
              'id'        => 'contact_title',
              'type'      => 'text',
              'title'     => esc_html__('Title', 'loveme')
            ),
          ),
          'clone_fields'  => array(
           
             array(
              'id'        => 'info',
              'type'      => 'text',
              'title'     => esc_html__('Contact Info', 'loveme')
            ),

          ),

        ),
      // Service Contact Widget End
        // widget download-widget
        array(
          'name'          => 'loveme_download_widgets',
          'title'         => esc_html__('Download Widget', 'loveme'),
          'view'          => 'clone',
          'clone_id'      => 'loveme_download_widget',
          'clone_title'   => esc_html__('Add New', 'loveme'),
          'fields'        => array(

            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'loveme'),
            ),
          ),
          'clone_fields'  => array(

            array(
              'id'        => 'download_icon',
              'type'      => 'icon',
              'title'     => esc_html__('Download Icon', 'loveme')
            ),
            array(
              'id'        => 'title',
              'type'      => 'text',
              'title'     => esc_html__('Download Title', 'loveme')
            ),
            array(
              'id'        => 'link',
              'type'      => 'text',
              'title'     => esc_html__('Download Link', 'loveme')
            ),

          ),

        ),

      ),
    );

    /* Footer Shortcodes */
    $options[]     = array(
      'title'      => esc_html__('Footer Shortcodes', 'loveme'),
      'shortcodes' => array(

        // Footer Menus
        array(
          'name'          => 'loveme_footer_menus',
          'title'         => esc_html__('Footer Menu Links', 'loveme'),
          'view'          => 'clone',
          'clone_id'      => 'loveme_footer_menu',
          'clone_title'   => esc_html__('Add New', 'loveme'),
          'fields'        => array(

            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'loveme'),
            ),

          ),
          'clone_fields'  => array(

            array(
              'id'        => 'menu_title',
              'type'      => 'text',
              'title'     => esc_html__('Menu Title', 'loveme')
            ),
            array(
              'id'        => 'menu_link',
              'type'      => 'text',
              'title'     => esc_html__('Menu Link', 'loveme')
            ),
            array(
              'id'        => 'target_tab',
              'type'      => 'switcher',
              'title'     => esc_html__('Open New Tab?', 'loveme'),
              'on_text'     => esc_html__('Yes', 'loveme'),
              'off_text'     => esc_html__('No', 'loveme'),
            ),

          ),

        ),
        // Footer Menus
        array(
          'name'          => 'footer_infos',
          'title'         => esc_html__('footer logo and Text', 'loveme'),
          'view'          => 'clone',
          'clone_id'      => 'footer_info',
          'clone_title'   => esc_html__('Add New', 'loveme'),
          'fields'        => array(
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'loveme'),
            ),
            array(
              'id'        => 'footer_logo',
              'type'      => 'image',
              'title'     => esc_html__('Footer logo', 'loveme'),
            ),
            array(
              'id'        => 'desc',
              'type'      => 'textarea',
              'title'     => esc_html__('Description', 'loveme'),
            ),
            
          ),
          'clone_fields'  => array(
            array(
              'id'        => 'social_icon',
              'type'      => 'icon',
              'title'     => esc_html__('Social Icon', 'loveme')
            ),
            array(
              'id'        => 'social_link',
              'type'      => 'text',
              'title'     => esc_html__('Social Link', 'loveme')
            ),
          ),

        ),

      // footer contact info
      array(
        'name'          => 'loveme_footer_contact_infos',
        'title'         => esc_html__('Contact info', 'loveme'),
        'view'          => 'clone',
        'clone_id'      => 'loveme_footer_contact_info',
        'clone_title'   => esc_html__('Add New', 'loveme'),
        'fields'        => array(

          array(
            'id'        => 'custom_class',
            'type'      => 'text',
            'title'     => esc_html__('Custom Class', 'loveme'),
          ),
          array(
            'id'        => 'item_desc',
            'type'      => 'text',
            'title'     => esc_html__('Contact Description', 'loveme')
          ),
        ),
        'clone_fields'  => array(

          array(
            'id'        => 'Icon',
            'type'      => 'icon',
            'title'     => esc_html__('Contact info icon', 'loveme')
          ),
          array(
            'id'        => 'item_title',
            'type'      => 'text',
            'title'     => esc_html__('Contact info title', 'loveme')
          ),
        ),

      ),

      // footer Social info
      array(
        'name'          => 'loveme_footer_social_infos',
        'title'         => esc_html__('Social', 'loveme'),
        'view'          => 'clone',
        'clone_id'      => 'loveme_footer_social_info',
        'clone_title'   => esc_html__('Add New', 'loveme'),
        'fields'        => array(

          array(
            'id'        => 'custom_class',
            'type'      => 'text',
            'title'     => esc_html__('Custom Class', 'loveme'),
          ),
        ),
        'clone_fields'  => array(

          array(
            'id'        => 'icon_url',
            'type'      => 'image',
            'title'     => esc_html__('Social icon', 'loveme')
          ),
          array(
            'id'        => 'item_title',
            'type'      => 'text',
            'title'     => esc_html__('Social title', 'loveme')
          ),
          array(
            'id'        => 'item_link',
            'type'      => 'text',
            'title'     => esc_html__('Social title', 'loveme')
          ),
        ),

      ),

      // footer Address
       array(
          'name'          => 'loveme_footer_address_item',
          'title'         => esc_html__('Address', 'loveme'),
          'view'          => 'clone',
          'clone_id'      => 'loveme_footer_address_items',
          'clone_title'   => esc_html__('Add New', 'loveme'),
          'fields'        => array(

            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'loveme'),
            ),

          ),
          'clone_fields'  => array(
            array(
              'id'        => 'item',
              'type'      => 'text',
              'title'     => esc_html__('Address item', 'loveme')
            ),
          ),
        ),

      ),
    );

  return $options;

  }
  add_filter( 'cs_shortcode_options', 'loveme_shortcodes' );
}