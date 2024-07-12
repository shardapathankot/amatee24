<?php
namespace Elementor;

defined( 'ABSPATH' ) || die();

class Loveme_Icons_Manager {

    public static function init() {
        add_filter( 'elementor/icons_manager/additional_tabs', [ __CLASS__, 'add_loveme_icons_tab' ] );
    }

    public static function add_loveme_icons_tab( $tabs ) {
        $tabs['loveme-icons'] = [
            'name' => 'loveme-icons',
            'label' => __( 'Loveme Icons', 'loveme-elementor-addons' ),
            'url' => LOVEME_PLUGIN_URL . 'elementor/assets/css/flaticon.css',
            'enqueue' => [ LOVEME_PLUGIN_URL . 'elementor/assets/css/flaticon.css' ],
            'prefix' => 'flaticon-',
            'displayPrefix' => 'fi',
            'labelIcon' => 'flaticon-wedding',
            'ver' => '1.0.0',
            'fetchJson' => LOVEME_PLUGIN_URL . 'elementor/assets/js/loveme-icons.js?v=1.0.0',
            'native' => false,
        ];
        return $tabs;
    }

    /**
     * Get a list of loveme icons
     *
     * @return array
     */
    public static function get_loveme_icons() {
        return [
            'flaticon-email' => 'email',
            'flaticon-phone-call'  => 'phone-call',
            'flaticon-maps-and-flags'  => 'maps-and-flags',
            'flaticon-instagram' => 'instagram',
            'flaticon-gallery' => 'gallery',
            'flaticon-serving-dish' => 'serving-dish',
            'flaticon-edit' => 'edit',
            'flaticon-left-arrow' => 'left-arrow',
            'flaticon-wedding' => 'wedding',
            'flaticon-cake' => 'cake',
            'flaticon-wedding-rings' => 'wedding-rings',
            'flaticon-play' => 'play',
            'flaticon-quotation' => 'quotation',
            'flaticon-dove' => 'dove',
            'flaticon-calendar' => 'calendar',
            'flaticon-heart' => 'heart',
            'flaticon-pinterest' => 'pinterest',
            'flaticon-facebook-app-symbol' => 'facebook-app-symbol',
            'flaticon-twitter' => 'twitter',
            'flaticon-instagram-1' => 'instagram-1',
            'flaticon-linkedin' => 'linkedin',
            'flaticon-youtube' => 'youtube',
            'flaticon-search' => 'search',
            'flaticon-shopping-cart' => 'shopping-cart',
            'flaticon-left-arrow-1' => 'left-arrow-1',
            'flaticon-user' => 'user',
            'flaticon-comment-white-oval-bubble' => 'comment-white-oval-bubble',
            'flaticon-calendar-1' => 'calendar-1',
            'flaticon-right-arrow' => 'right-arrow',
            'flaticon-play-1' => 'play-1',
            'flaticon-left-quote' => 'left-quote',
            'flaticon-right-arrow-1' => 'right-arrow-1',
            'flaticon-left-arrow-2' => 'left-arrow-2',
            'flaticon-next' => 'next',
        ];
    }
}

Loveme_Icons_Manager::init();